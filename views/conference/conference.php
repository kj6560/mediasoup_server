<script>
    var host = "<?php echo $conference['conference_by']; ?>";
    var current_user = "<?php echo $current_user['id']; ?>";
    host = host == current_user ? 1 : 0;
    console.log(host);
</script>
<section class="top-heading">
    <img src="https://www.talktoangel.com/images/logo.png" alt="Confrence Room" width="100">
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
    <div class="chat-box">
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

    </div>

</section>
<script>
    window.onload = function() {
        var name = "<?php echo "Keshav Jha"; ?>";
        var room_id = "<?php echo $conference['conference_room_id'] ?>";
        console.log(name);
        console.log(room_id);
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
    let chatBox = document.querySelector('.chat-box');
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