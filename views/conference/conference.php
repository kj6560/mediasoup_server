<style>
    html {
        overflow: hidden;
        height: 100%;
    }

    .one video {
        object-fit: cover;
    }

    .localVideo {
        width: 20%;
        position: absolute;
        z-index: 2;
        bottom: 10px;
        left: 10px;
        display: block;
    }

    .remoteVideos {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: stretch;
        align-content: stretch;
    }

    .remoteVideos video {
        flex-grow: 1;
        flex-shrink: 1;
        min-width: 0px;
        min-height: 0px;
    }

    body {
        background-color: black;
        margin: 0;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    .feature {
        display: flex;
        z-index: 2;
        position: absolute;
        left: 40%;
        top: 0;
        background: #15748a;
        width: 270px;
        cursor: pointer;
    }


    .feature span {
        margin: 5px;
        font-size: 16px;
        color: #f3efef;
        cursor: pointer;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0px 0px 10px rgb(80 78 78);
        text-align: center;

    }

    .featurehead {
        position: absolute;
        bottom: 17rem;
        color: #fff;
        z-index: 3;
        background: #15748a;
        width: 60px;
        display: flex;
        justify-content: center;
        height: 34px;
        place-items: center;
        cursor: pointer;
    }
</style>
<script>
    var host = "<?php echo $data['conference']['conference_by']; ?>";
    var current_user = "<?php echo $data['conference']['current_user']; ?>";
    host = host == current_user ? 1 : 0;
</script>


    <div id="devicesList" style="display: none;">
        <div id="remoteAudios" style="display: none;"></div>
        <i class="fas fa-microphone"></i> Audio:
        <select id="audioSelect" class="form-select" style="width: auto"></select>
        <br />
        <i class="fas fa-video"></i> Video:
        <select id="videoSelect" class="form-select" style="width: auto"></select>
    </div>
    <div id="remoteVideos" class="remoteVideos">

    </div>
    <div id="localMedia">

    </div>
    <section class="report-a-problem hide"></section>
    <div class="featurehead">
        <span class="fas fa-times"></span>
    </div>
    <div class="feature">

        <span class="fas fa-phone sessionEnd" title="End Session" onclick="rc.exit()"></span>
        <span class="fas fa-video videoOpen" title="Start Camera" onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)"></span>
        <span class="fas fa-video-slash videoClose hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.video)"></span>
        <span class="fas fa-microphone audioOpen" title="Start Microphone" onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)"></span>
        <span class="fas fa-microphone-slash audioClose hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.audio)"></span>
        <span class="fas fa-desktop" title="Screen Share" onclick="rc.produce(RoomClient.mediaType.screen)"></span>
        <span class="fas fa-desktop hide" title="Stop Screen Share" onclick="rc.closeProducer(RoomClient.mediaType.screen)"></span>
        <span class="fas fa-comment-slash chattoggle" title="Chat"></span>
        <span class="fas fa-exclamation reporttoggle" title="Report a Problem"></span>
    </div>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    window.onload = function() {
        var name = "<?php echo $data['conference']['user_name']; ?>";
        var room_id = "<?php echo $data['conference']['conference_room_id']; ?>";
        joinRoom(name, room_id);
    };
    $(function() {
        $('[data-toggle]').click(function() {
            const $this = $(this)
            panelId = $this.data('toggle')
            $('#' + panelId).toggleClass('show')
        })
    })

    // add remove remote media

    


    

    
    // feature section hide show function 
    let featureHead = document.querySelector(".featurehead");
    let feature = document.querySelector(".feature");
    featureHead.addEventListener("click", () => {
        if (feature.classList.contains('hide')) {
            featureHead.innerHTML = '<span class="fas fa-times"></span>';
            feature.classList.remove('hide');
            featureHead.style.bottom = '17rem';
        } else {
            featureHead.innerHTML = '<span class="fas fa-bars"></span>';
            feature.classList.add('hide');
            featureHead.style.bottom = 0;
        }
    });

    // toggle chat option 
    

    

    

    // toggle video 
    let videoOpen = document.querySelector('.videoOpen');
    let videoClose = document.querySelector('.videoClose');
    videoOpen.addEventListener("click", () => {
        videoOpen.classList.add('hide');
        videoClose.classList.remove('hide');
        videoClose.style.background = '#ff5d7d';
    });
    videoClose.addEventListener("click", () => {
        videoClose.classList.add('hide');
        videoOpen.classList.remove('hide');
    });

    // toggle audio 
    let audioOpen = document.querySelector('.audioOpen');
    let audioClose = document.querySelector('.audioClose');
    audioOpen.addEventListener("click", () => {
        audioOpen.classList.add('hide');
        audioClose.classList.remove('hide');
        audioClose.style.background = '#ff5d7d';
    });
    audioClose.addEventListener("click", () => {
        audioClose.classList.add('hide');
        audioOpen.classList.remove('hide');
    })
</script>