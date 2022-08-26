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
        top: 80;
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

    h6 {
        color: white;
    }

    .chat-box {
        width: 450px;
        height: 80vh;
        position: fixed;
        border: 1px solid;
        z-index: 3;
        bottom: 10px;
        right: 10px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        color: #fff;
        background-blend-mode: none;
    }

    .history-box {
        border: 1px solid #ff5d7d;
        width: 96%;
        height: 65vh;
        overflow-y: auto;
    }

    .text-box {
        width: 96%;
        height: auto;
        display: flex;
    }

    .input {
        width: 88%;
        height: 44px;
        border: 2px solid #ff5d7d;
        overflow-y: auto;
        outline: none;
        border-radius: 25px 0px 0px 25px;
        font-size: 12px;
        padding: 0px 5px;
    }

    .btn.btn-message {
        background: #ff5d7d;
        color: #fff;
        height: 44px;
        border-radius: 0px 25px 25px 0px;
        font-size: 14px;
    }

    li.chat-list {
        padding: 5px;
        margin: 0px;
        list-style: none;
        font-size: 14px;
    }

    .chat-list span {
        font-size: 10px;
    }

    .left-chat {
        background: #ff5d7d;
        color: #fff;
        padding: 10px;
        border-radius: 10px;
        width: auto;
        margin: 5px;
        float: left;
        clear: both;
        text-align: left;
        position: relative;

    }

    .right-chat {
        background: var(--teal);
        color: #fff;
        padding: 10px;
        border-radius: 10px;
        width: auto;
        margin: 5px;
        float: right;
        clear: both;
        text-align: right;
        position: relative;

    }

    .right-chat::before {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        bottom: -9px;
        border-left: 15px solid transparent;
        border-right: 8px solid transparent;
        border-top: 17px solid #20c997;
        right: 0px;
    }

    .left-chat::before {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        bottom: -9px;
        border-left: 15px solid transparent;
        border-right: 8px solid transparent;
        border-top: 17px solid #ff5d7d;
        left: 0px;
    }

    .hide {
        display: none;
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #ff5d7d05;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<script>
    var host = "<?php

                use App\ViewHelpers;

                echo $data['conference']['conference_by']; ?>";
    var current_user = "<?php echo $data['conference']['current_user']; ?>";
    host = host == current_user ? 1 : 0;
</script>

<script>
    var mobile = false; //initiate as false
    // device detection
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
        /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
        mobile = true;
    }
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
    <h6><?php //echo $data['conference']['user_name'] 
        ?></h6>
</div>

<div class="feature">

    <span class="fas fa-phone sessionEnd" title="End Session" onclick="rc.exit()"></span>
    <span id="vid" class="fas fa-video videoOpen" title="Start Camera"></span>
    <span id="aud" class="fas fa-microphone audioOpen" title="Start Microphone"></span>
    <span id="scr" class="fas fa-desktop" title="Screen Share"></span>
    <span class="fas fa-comment-slash chattoggle" title="Chat"></span>
    <span class="fas fa-exclamation reporttoggle" title="Report a Problem"></span>
</div>

<div class="chat-box hide">
    <h4 class="text-center client_name">Client Name</h4>
    <div class="history-box">
        <ul>
            <li class="chat-list">
                <div class="left-chat">
                    <p>message by client sla;df adsjfladjfajd adjfad adf adj dfhgdfg dgfhdfgh dfghdfgf</p><span class="fas fa-clock"> Just Now</span>
                </div>
            </li>
            <li class="chat-list">
                <div class="right-chat">
                    <p>message by me</p><span class="fas fa-clock"> Just Now</span>
                </div>
            </li>
            
        </ul>
    </div>
    <div class="text-box">
        <input type="text" class="input msg" name="msg"></p><button onclick="sendMsg()" class="btn btn-message fas fa-send send_msg"> Send</button>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    var socket_id='';
    window.onload = function() {
        var name = "<?php echo $data['conference']['user_name']; ?>";
        var room_id = "<?php echo $data['conference']['conference_room_id']; ?>";
        joinRoom(name, room_id, mobile);
        socket_id = rc.socket.id;
        console.log("my socket: ",socket_id);
    };
    $(function() {
        $('[data-toggle]').click(function() {
            const $this = $(this)
            panelId = $this.data('toggle')
            $('#' + panelId).toggleClass('show')
        })
    })





    // toggle video 
    let video = document.querySelector('#vid');
    let vc = 0;
    video.addEventListener("click", () => {
        if (vc == 0) {
            video.classList.add('fa-video-slash');
            video.classList.remove('fa-video');
            video.style.background = '#ff5d7d';
            vc++;
            rc.produce(RoomClient.mediaType.video, videoSelect.value);
        } else {
            video.classList.remove('fa-video-slash');
            video.classList.add('fa-video');
            video.style.background = '';
            vc--;
            rc.closeProducer(RoomClient.mediaType.video)
        }

    });


    // toggle audio 
    let audio = document.querySelector('#aud');
    let ac = 0;
    audio.addEventListener("click", () => {
        if (ac == 0) {
            audio.classList.add('fa-microphone-slash');
            audio.classList.remove('fa-microphone');
            audio.style.background = '#ff5d7d';
            ac++;
            rc.produce(RoomClient.mediaType.audio, audioSelect.value);
        } else {
            audio.classList.remove('fa-microphone-slash');
            audio.classList.add('fa-microphone');
            audio.style.background = '';
            ac--;
            rc.closeProducer(RoomClient.mediaType.audio);
        }

    });


    // toggle screen share 
    let screen = document.querySelector('#scr');
    let scr = 0;
    screen.addEventListener("click", () => {
        if (scr == 0) {

            screen.style.background = '#ff5d7d';
            scr++;
            rc.produce(RoomClient.mediaType.screen)
        } else {
            screen.style.background = '';
            scr--;
            rc.closeProducer(RoomClient.mediaType.screen)
        }

    });
    //chat toggle

    let chattoggle = document.querySelector('.chattoggle');
    let chatBox = document.querySelector('.chat-box');
    chattoggle.classList.remove('fa-comment');
    chattoggle.classList.add('fa-comment-slash');
    chatBox.classList.add('hide');

    chattoggle.addEventListener("click", () => {
        if (chatBox.classList.contains('hide')) {
            chattoggle.classList.add('fa-comment');
            chattoggle.classList.remove('fa-comment-slash');
            chatBox.classList.remove('hide');
            chattoggle.style.background = '#ff5d7d';

        } else {
            chattoggle.classList.remove('fa-comment');
            chattoggle.classList.add('fa-comment-slash');
            chatBox.classList.add('hide');
            chattoggle.style.background = 'none';
        }
    });

    //receive msg and send it to sockets
    let input = document.querySelector('.input');
    function sendMsg(){
        rc.sendMessage(input.value);
    }
</script>