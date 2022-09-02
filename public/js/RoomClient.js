const mediaType = {
  audio: 'audioType',
  video: 'videoType',
  screen: 'screenType'
}
const _EVENTS = {
  exitRoom: 'exitRoom',
  openRoom: 'openRoom',
  startVideo: 'startVideo',
  stopVideo: 'stopVideo',
  startAudio: 'startAudio',
  stopAudio: 'stopAudio',
  startScreen: 'startScreen',
  stopScreen: 'stopScreen',
  room_data: 'room_data',
  message: 'message'
}

class RoomClient {
  constructor(localMediaEl, remoteVideoEl, remoteAudioEl, mediasoupClient, socket, room_id, name, successCallback, isMobile, conference_id, conference_date, user_id, host_id, conf_duration) {
    this.name = name
    this.localMediaEl = localMediaEl
    this.remoteVideoEl = remoteVideoEl
    this.remoteAudioEl = remoteAudioEl
    this.mediasoupClient = mediasoupClient
    this.isMobile = isMobile
    this.socket = socket
    this.producerTransport = null
    this.consumerTransport = null
    this.device = null
    this.room_id = room_id
    this.conference_id = conference_id
    this.conference_date = conference_date
    this.user_id = user_id
    this.host_id = host_id
    this.conf_duration = conf_duration
    this.isVideoOnFullScreen = false
    this.isDevicesVisible = false

    this.consumers = new Map()
    this.producers = new Map()
    this.room_data = []

    /**
     * map that contains a mediatype as key and producer_id as value
     */
    this.producerLabel = new Map()

    this._isOpen = false
    this.eventListeners = new Map()
    var now_time = new Date().getTime();
    if ((this.conference_date.getTime() <= now_time)) {
      Object.keys(_EVENTS).forEach(
        function (evt) {
          this.eventListeners.set(evt, [])
        }.bind(this)
      )

      this.createRoom(room_id).then(
        async function () {
          await this.join(name, room_id)
          this.initSockets()
          this._isOpen = true
          successCallback()
        }.bind(this)
      )
    } else {
      window.location.href = window.location.origin + "/conference_error/" + this.conference_id;
    }
  }

  ////////// INIT /////////

  async createRoom(room_id) {
    await this.socket
      .request('createRoom', {
        room_id
      })
      .catch((err) => {
        console.log('Create room error:', err)
      })
  }

  async join(name, room_id) {
    socket
      .request('join', {
        name,
        room_id
      })
      .then(
        async function (e) {
          console.log('Joined to room', e)
          const data = await this.socket.request('getRouterRtpCapabilities')
          let device = await this.loadDevice(data)
          this.device = device
          await this.initTransports(device)
          this.socket.emit('getProducers')
          this.socket.emit('getRoomData')
        }.bind(this)
      )
      .catch((err) => {
        console.log('Join error:', err)
      })
  }

  async loadDevice(routerRtpCapabilities) {
    let device
    try {
      device = new this.mediasoupClient.Device()
    } catch (error) {
      if (error.name === 'UnsupportedError') {
        console.error('Browser not supported')
        alert('Browser not supported')
      }
      console.error(error)
    }
    await device.load({
      routerRtpCapabilities
    })
    return device
  }

  async initTransports(device) {
    // init producerTransport
    {
      const data = await this.socket.request('createWebRtcTransport', {
        forceTcp: false,
        rtpCapabilities: device.rtpCapabilities
      })

      if (data.error) {
        console.error(data.error)
        return
      }

      this.producerTransport = device.createSendTransport(data)

      this.producerTransport.on(
        'connect',
        async function ({ dtlsParameters }, callback, errback) {
          this.socket
            .request('connectTransport', {
              dtlsParameters,
              transport_id: data.id
            })
            .then(callback)
            .catch(errback)
        }.bind(this)
      )

      this.producerTransport.on(
        'produce',
        async function ({ kind, rtpParameters }, callback, errback) {
          try {
            const { producer_id } = await this.socket.request('produce', {
              producerTransportId: this.producerTransport.id,
              kind,
              rtpParameters
            })
            callback({
              id: producer_id
            })
          } catch (err) {
            errback(err)
          }
        }.bind(this)
      )

      this.producerTransport.on(
        'connectionstatechange',
        function (state) {
          switch (state) {
            case 'connecting':
              break

            case 'connected':
              //localVideo.srcObject = stream
              break

            case 'failed':
              this.producerTransport.close()
              break

            default:
              break
          }
        }.bind(this)
      )
    }

    // init consumerTransport
    {
      const data = await this.socket.request('createWebRtcTransport', {
        forceTcp: false
      })

      if (data.error) {
        console.error(data.error)
        return
      }

      // only one needed
      this.consumerTransport = device.createRecvTransport(data)
      this.consumerTransport.on(
        'connect',
        function ({ dtlsParameters }, callback, errback) {
          this.socket
            .request('connectTransport', {
              transport_id: this.consumerTransport.id,
              dtlsParameters
            })
            .then(callback)
            .catch(errback)
        }.bind(this)
      )

      this.consumerTransport.on(
        'connectionstatechange',
        async function (state) {
          switch (state) {
            case 'connecting':
              break

            case 'connected':
              //remoteVideo.srcObject = await stream;
              //await socket.request('resume');
              break

            case 'failed':
              this.consumerTransport.close()
              break

            default:
              break
          }
        }.bind(this)
      )
    }
  }

  initSockets() {
    this.socket.on(
      'consumerClosed',
      function ({ consumer_id }) {
        console.log('Closing consumer:', consumer_id)
        this.removeConsumer(consumer_id)
      }.bind(this)
    )

    /**
     * data: [ {
     *  producer_id:
     *  producer_socket_id:
     * }]
     */
    this.socket.on(
      'newProducers',
      async function (data) {
        console.log('New producers', data)
        for (let { producer_id, producer_socket_id } of data) {
          await this.consume(producer_id, producer_socket_id)
        }
      }.bind(this)
    )

    this.socket.on(
      'disconnect',
      function () {
        this.exit(true)
      }.bind(this)
    )
    this.socket.on("room_data", async function (room_data) {
      this.room_data = room_data
      if (this.room_data.length == 2) {
        var countDownDate = new Date().getTime() + this.conf_duration * 60 * 1000;
        var extend = 1;
        var x = setInterval(function () {
          var now = new Date().getTime();
          var distance = countDownDate - now;
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          if (distance < 0) {
            if (this.user_id == this.host_id) {
              if (extend) {
                sweetAlert.fire({
                  title: 'Exit Conference!!',
                  text: 'Your time has expired. You may be granted extra time do you wish to continue ? ',
                  showDenyButton: false,
                  showCancelButton: true,
                  confirmButtonText: 'Yes',
                  customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                  }
                }).then((result) => {
                  if (result.isConfirmed) {
                    countDownDate = countDownDate + 5 * 60 * 1000
                    extend = 0
                  } else {
                    clearInterval(x);
                    const url = "/endSession"
                    $.post(url, {
                      id: this.conference_id
                    },
                      function (data, status) {
                        if (status = 200) {
                          rc.exit();
                          window.location.href = window.location.origin + "/conferences";
                        }
                      });
                  }
                })
              } else {
                clearInterval(x);
                sweetAlert.fire({
                  title: 'Session Ended',
                  text: 'Your session has ended',
                  showDenyButton: false,
                  confirmButtonText: 'OK',
                  customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                  }
                }).then((result) => {
                  if (result.isConfirmed) {
                    const url = "/endSession"
                    $.post(url, {
                      id: this.conference_id
                    },
                      function (data, status) {
                        if (status = 200) {
                          rc.exit();
                          window.location.href = window.location.origin + "/conferences";
                        }
                      });
                  }
                })
              }

            } else {
              sweetAlert.fire({
                title: 'Session Ended',
                text: 'Your session has ended',
                showDenyButton: false,
                confirmButtonText: 'OK',
                customClass: {
                  actions: 'my-actions',
                  cancelButton: 'order-1 right-gap',
                  confirmButton: 'order-2',
                  denyButton: 'order-3',
                }
              }).then((result) => {
                if (result.isConfirmed) {

                  rc.exit();
                  window.location.href = "/conferences";

                }
              })
            }
          }
          document.getElementById("timer").innerHTML = hours + "h - " +
            minutes + "m - " + seconds + "s ";
        },
          1000);
      } else {
        console.log("waiting for client");
      }

    }.bind(this)
    )
    function endSession() {

      if (this.user_id == this.host_id) {
        sweetAlert.fire({
          title: 'Exit Conference!!',
          text: 'If you exit, this conference will no longer be active. Do you want to exit conference ?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes',
          customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
          }
        }).then((result) => {
          if (result.isConfirmed) {
            let postObj = {
              id: conference_id
            }
            let post = JSON.stringify(postObj)

            const url = "/endSession"
            $.post(url, {
              id: this.conference_id
            },
              function (data, status) {
                if (status = 200) {
                  rc.exit();
                  window.location.href = "/conferences";
                }
              });
          }
        })

      } else {
        rc.exit();
        window.location.href = "/conferences";
      }

    }
    this.socket.on("message", async function (msg, socket__id) {
      this.updateMsgList(msg, socket__id)
    }.bind(this)
    )
  }

  //////// MAIN FUNCTIONS /////////////


  async produce(type, deviceId = null, host = null) {
    let mediaConstraints = {}
    let audio = false
    let screen = false
    switch (type) {
      case mediaType.audio:
        mediaConstraints = {
          audio: {
            deviceId: deviceId
          },
          video: false
        }
        audio = true
        break
      case mediaType.video:

        if (this.isMobile) {
          mediaConstraints = {
            audio: false,
            video: {
              width: {
                min: 640,
                ideal: 1920
              },
              height: {
                min: 400,
                ideal: 1080
              },
              deviceId: deviceId
              /*aspectRatio: {
                              ideal: 1.7777777778
                          }*/
            }
          }
        } else {
          mediaConstraints = {
            audio: false,
            video: {
              width: {
                min: 640,
                ideal: 1920
              },
              height: {
                min: 400,
                ideal: 1080
              },
              deviceId: deviceId
              /*aspectRatio: {
                              ideal: 1.7777777778
                          }*/
            }
          }
        }


        break
      case mediaType.screen:
        mediaConstraints = false
        screen = true
        break
      default:
        return
    }
    if (!this.device.canProduce('video') && !audio) {
      console.error('Cannot produce video')
      return
    }
    if (this.producerLabel.has(type)) {
      console.log('Producer already exists for this type ' + type)
      return
    }
    console.log('Mediacontraints:', mediaConstraints)
    let stream
    try {
      stream = screen
        ? await navigator.mediaDevices.getDisplayMedia()
        : await navigator.mediaDevices.getUserMedia(mediaConstraints)
      console.log(navigator.mediaDevices.getSupportedConstraints())

      const track = audio ? stream.getAudioTracks()[0] : stream.getVideoTracks()[0]
      const params = {
        track
      }
      if (!audio && !screen) {
        params.encodings = [
          {
            rid: 'r0',
            maxBitrate: 100000,
            //scaleResolutionDownBy: 10.0,
            scalabilityMode: 'S1T3'
          },
          {
            rid: 'r1',
            maxBitrate: 300000,
            scalabilityMode: 'S1T3'
          },
          {
            rid: 'r2',
            maxBitrate: 900000,
            scalabilityMode: 'S1T3'
          }
        ]
        params.codecOptions = {
          videoGoogleStartBitrate: 1000
        }
      }
      producer = await this.producerTransport.produce(params)

      console.log('Producer', producer)

      this.producers.set(producer.id, producer)

      let elem
      if (!audio) {
        let locName = document.createElement('h6');
        locName.id = 'localVideoName'
        this.localMediaEl.appendChild(document.createElement('br'))
        elem = document.createElement('video')
        elem.srcObject = stream
        elem.id = producer.id
        elem.playsinline = false
        elem.autoplay = true
        if (this.isMobile) {
          elem.height = 200
          elem.width = 200
        }
        elem.className = 'localVideo'

        this.localMediaEl.appendChild(elem)

        this.handleFS(elem.id)
      }

      producer.on('trackended', () => {
        this.closeProducer(type)
      })

      producer.on('transportclose', () => {
        console.log('Producer transport close')
        if (!audio) {
          elem.srcObject.getTracks().forEach(function (track) {
            track.stop()
          })
          elem.parentNode.removeChild(elem)
        }
        this.producers.delete(producer.id)
      })

      producer.on('close', () => {
        console.log('Closing producer')
        if (!audio) {
          elem.srcObject.getTracks().forEach(function (track) {
            track.stop()
          })
          elem.parentNode.removeChild(elem)
        }
        this.producers.delete(producer.id)
      })

      this.producerLabel.set(type, producer.id)

      switch (type) {
        case mediaType.audio:
          this.event(_EVENTS.startAudio)
          break
        case mediaType.video:
          this.event(_EVENTS.startVideo)
          break
        case mediaType.screen:
          this.event(_EVENTS.startScreen)
          break
        default:
          return
      }
    } catch (err) {
      console.log('Produce error:', err)
    }
  }

  async consume(producer_id, producer_socket_id) {
    let info = await this.roomInfo()
    var peers = JSON.parse(info.peers)
    let consumer_name = ""
    for (let t = 0; t < peers.length; t++) {
      if (peers[t][0] == producer_socket_id) {
        consumer_name = peers[t][1].name
      }
    }

    this.getConsumeStream(producer_id).then(

      function ({ consumer, stream, kind }) {
        console.log(consumer_name)
        this.consumers.set(consumer.id, consumer)

        let elem
        if (kind === 'video') {
          let remName = document.createElement('h6')
          remName.innerText = consumer_name
          //remoteVideoEl.appendChild(remName)
          elem = document.createElement('video')
          elem.srcObject = stream
          elem.id = consumer.id
          elem.playsinline = false
          elem.autoplay = true
          elem.className = 'remote-side'
          this.remoteVideoEl.appendChild(elem)
          this.handleFS(elem.id)
        } else {
          elem = document.createElement('audio')
          elem.srcObject = stream
          elem.id = consumer.id
          elem.playsinline = false
          elem.autoplay = true
          this.remoteAudioEl.appendChild(elem)
        }

        consumer.on(
          'trackended',
          function () {
            this.removeConsumer(consumer.id)
          }.bind(this)
        )

        consumer.on(
          'transportclose',
          function () {
            this.removeConsumer(consumer.id)
          }.bind(this)
        )
      }.bind(this)
    )
  }

  async getConsumeStream(producerId) {
    const { rtpCapabilities } = this.device
    const data = await this.socket.request('consume', {
      rtpCapabilities,
      consumerTransportId: this.consumerTransport.id, // might be
      producerId
    })
    const { id, kind, rtpParameters } = data

    let codecOptions = {}
    const consumer = await this.consumerTransport.consume({
      id,
      producerId,
      kind,
      rtpParameters,
      codecOptions
    })

    const stream = new MediaStream()
    stream.addTrack(consumer.track)

    return {
      consumer,
      stream,
      kind
    }
  }

  closeProducer(type) {
    if (!this.producerLabel.has(type)) {
      console.log('There is no producer for this type ' + type)
      return
    }

    let producer_id = this.producerLabel.get(type)
    console.log('Close producer', producer_id)

    this.socket.emit('producerClosed', {
      producer_id
    })

    this.producers.get(producer_id).close()
    this.producers.delete(producer_id)
    this.producerLabel.delete(type)

    if (type !== mediaType.audio) {
      let elem = document.getElementById(producer_id)
      elem.srcObject.getTracks().forEach(function (track) {
        track.stop()
      })
      elem.parentNode.removeChild(elem)
    }

    switch (type) {
      case mediaType.audio:
        this.event(_EVENTS.stopAudio)
        break
      case mediaType.video:
        this.event(_EVENTS.stopVideo)
        break
      case mediaType.screen:
        this.event(_EVENTS.stopScreen)
        break
      default:
        return
    }
  }

  pauseProducer(type) {
    if (!this.producerLabel.has(type)) {
      console.log('There is no producer for this type ' + type)
      return
    }

    let producer_id = this.producerLabel.get(type)
    this.producers.get(producer_id).pause()
  }

  resumeProducer(type) {
    if (!this.producerLabel.has(type)) {
      console.log('There is no producer for this type ' + type)
      return
    }

    let producer_id = this.producerLabel.get(type)
    this.producers.get(producer_id).resume()
  }

  removeConsumer(consumer_id) {
    let elem = document.getElementById(consumer_id)
    elem.srcObject.getTracks().forEach(function (track) {
      track.stop()
    })
    elem.parentNode.removeChild(elem)

    this.consumers.delete(consumer_id)
  }

  exit(offline = false) {
    let clean = function () {
      this._isOpen = false
      this.consumerTransport.close()
      this.producerTransport.close()
      this.socket.off('disconnect')
      this.socket.off('newProducers')
      this.socket.off('consumerClosed')
    }.bind(this)

    if (!offline) {
      this.socket
        .request('exitRoom')
        .then((e) => console.log(e))
        .catch((e) => console.warn(e))
        .finally(
          function () {
            clean()
          }.bind(this)
        )
    } else {
      clean()
    }

    this.event(_EVENTS.exitRoom)
  }

  ///////  HELPERS //////////

  async roomInfo() {
    let info = await this.socket.request('getMyRoomInfo')
    return info
  }

  static get mediaType() {
    return mediaType
  }

  event(evt) {
    if (this.eventListeners.has(evt)) {
      this.eventListeners.get(evt).forEach((callback) => callback())
    }
  }

  on(evt, callback) {
    this.eventListeners.get(evt).push(callback)
  }

  //////// GETTERS ////////

  isOpen() {
    return this._isOpen
  }

  static get EVENTS() {
    return _EVENTS
  }

  //////// UTILITY ////////

  copyURL() {
    let tmpInput = document.createElement('input')
    document.body.appendChild(tmpInput)
    tmpInput.value = window.location.href
    tmpInput.select()
    document.execCommand('copy')
    document.body.removeChild(tmpInput)
    console.log('URL copied to clipboard 👍')
  }

  showDevices() {
    if (!this.isDevicesVisible) {
      reveal(devicesList)
      this.isDevicesVisible = true
    } else {
      hide(devicesList)
      this.isDevicesVisible = false
    }
  }

  handleFS(id) {
    let videoPlayer = document.getElementById(id)
    videoPlayer.addEventListener('fullscreenchange', (e) => {
      if (videoPlayer.controls) return
      let fullscreenElement = document.fullscreenElement
      if (!fullscreenElement) {
        videoPlayer.style.pointerEvents = 'auto'
        this.isVideoOnFullScreen = false
      }
    })
    videoPlayer.addEventListener('webkitfullscreenchange', (e) => {
      if (videoPlayer.controls) return
      let webkitIsFullScreen = document.webkitIsFullScreen
      if (!webkitIsFullScreen) {
        videoPlayer.style.pointerEvents = 'auto'
        this.isVideoOnFullScreen = false
      }
    })
    videoPlayer.addEventListener('click', (e) => {
      if (videoPlayer.controls) return
      if (!this.isVideoOnFullScreen) {
        if (videoPlayer.requestFullscreen) {
          videoPlayer.requestFullscreen()
        } else if (videoPlayer.webkitRequestFullscreen) {
          videoPlayer.webkitRequestFullscreen()
        } else if (videoPlayer.msRequestFullscreen) {
          videoPlayer.msRequestFullscreen()
        }
        this.isVideoOnFullScreen = true
        videoPlayer.style.pointerEvents = 'none'
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen()
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen()
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen()
        }
        this.isVideoOnFullScreen = false
        videoPlayer.style.pointerEvents = 'auto'
      }
    })
  }

  sendMessage(msg, socket_id) {
    this.socket
      .emit('sendMessage',
        msg,
        socket_id
      )

  }
  getMySocketId() {
    return this.socket.id;
  }
  getRoomData() {
    return this.room_data;
  }
  updateMsgList(msg, socket__id) {
    let chatBox = document.querySelector('.chat-box');
    chatBox.classList.remove('hide');
    var name = "";
    for (let i = 0; i < this.room_data.length; i++) {

      var data = this.room_data[i];
      if (data.socket_id != socket__id) {
        name = data.name;
      }
    }
    document.querySelector('.client_name').innerHTML = name;
    var msgs_ul = document.querySelector('.msgs');
    var li = document.createElement('li');
    li.setAttribute('class', 'chat-list');
    var li_div = document.createElement('div');
    li_div.setAttribute('class', 'left-chat');
    var div_p = document.createElement('p');
    div_p.innerText = name + ": \n" + msg;

    li_div.appendChild(div_p);
    li.appendChild(li_div);
    msgs_ul.appendChild(li);
  }
}
