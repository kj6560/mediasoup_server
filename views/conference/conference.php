<style>
    html {
        overflow: hidden;
        height: 100%;
    }

    .one video {
        object-fit: cover;
    }

    .localMedia {
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
<section class="top-heading">
    <img src="<?php echo BASE.'img/logo.png'; ?>" alt="Confrence Room" width="100">
    <p class="text-right text-white time">45:00</p>
</section>

<section class="video-confrence">
    <div id="devicesList" style="display: none;">
        <div id="remoteAudios" style="display: none;"></div>
        <i class="fas fa-microphone"></i> Audio:
        <select id="audioSelect" class="form-select" style="width: auto"></select>
        <br />
        <i class="fas fa-video"></i> Video:
        <select id="videoSelect" class="form-select" style="width: auto"></select>
    </div>
    <div id="remoteVideos" class="remote-single">

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
    <!-- <div class="chat-box hide">
        <h4 class="text-center">Client Name</h4>
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
            <p class="input" contenteditable="true"></p><span class="btn btn-message fas fa-send"> Send</span>
        </div>

    </div> -->

</section>
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

    let remoteVideos = document.querySelector("#remoteVideos");
    let screenWidth = document.querySelector(".video-confrence");
    setInterval(function() {
        chkremote();
    }, 1000);

    function chkremote() {
        if (remoteVideos.children.length > 1) {
            remoteVideos.classList.remove('remote-single');
            remoteVideos.classList.add('remote-couple');
        } else {
            remoteVideos.classList.add('remote-single');
            remoteVideos.classList.remove('remote-couple');
        }
    }


    // local media draggable function
    let videoSec = document.querySelector("#localMedia");
    let localSide = videoSec.querySelector('.local-side');
    if (localSide) {
        localSide.addEventListener("mousedown", () => {
            localSide.classList.add("active");
            localSide.addEventListener("mousemove", localUserDrag);
        });
        document.addEventListener("mouseup", () => {
            localSide.classList.remove("active");
            localSide.removeEventListener("mousemove", localUserDrag);
        });
    }

    function localUserDrag({
        movementX,
        movementY
    }) {
        let getStyle = window.getComputedStyle(videoSec);
        let topval = parseInt(getStyle.top);
        let leftval = parseInt(getStyle.left);

        if (leftval + movementX < 0) {
            videoSec.style.left = 0;
        } else if (leftval + movementX > (screenWidth.offsetWidth - videoSec.offsetWidth)) {
            // do nothing here but its important
        } else {
            videoSec.style.left = `${leftval + movementX}px`;
        }

        if (topval + movementY < 50) {
            videoSec.style.top = 50;
        } else if (topval + movementY > (screenWidth.clientHeight - 100)) {
            // do nothing here but its important
        } else {
            videoSec.style.top = `${topval + movementY}px`;
        }



    }
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
    let chattoggle = document.querySelector('.chattoggle');
    //let chatBox = document.querySelector('.chat-box');
    chattoggle.classList.remove('fa-comment');
    chattoggle.classList.add('fa-comment-slash');
    //chatBox.classList.add('hide');

    // chattoggle.addEventListener("click", () => {
    //     if (chatBox.classList.contains('hide')) {
    //         chattoggle.classList.add('fa-comment');
    //         chattoggle.classList.remove('fa-comment-slash');
    //         chatBox.classList.remove('hide');
    //         chattoggle.style.background = '#ff5d7d';

    //     } else {
    //         chattoggle.classList.remove('fa-comment');
    //         chattoggle.classList.add('fa-comment-slash');
    //         chatBox.classList.add('hide');
    //         chattoggle.style.background = 'none';
    //     }
    // });

    // toggle report a problem
    let reportAproblem = document.querySelector(".report-a-problem");
    let reporttoggle = document.querySelector('.reporttoggle');
    reporttoggle.addEventListener("click", () => {
        if (reportAproblem.classList.contains('hide')) {
            reportAproblem.classList.remove('hide');
            reporttoggle.style.background = '#ff5d7d';

        } else {

            reportAproblem.classList.add('hide');
            reporttoggle.style.background = 'none';
        }
    });

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