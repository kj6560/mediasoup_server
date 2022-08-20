<style>
    
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

    span {
        margin: 5px;
        font-size: 16px;
        color: #f3efef;
        cursor: pointer;
        border-radius: 5px;
        padding: 2px;
        box-shadow: 0px 0px 10px rgb(80 78 78);
        text-align: center;

    }
</style>
<script>
    var host = "<?php echo $data['conference']['conference_by']; ?>";
    var current_user = "<?php echo $data['conference']['current_user']; ?>";
    host = host == current_user ? 1 : 0;
</script>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><?php echo SITE_NAME; ?></a>
        </div>
        <ul class="nav navbar-nav">
            <li><span class="fas fa-phone sessionEnd" title="End Session" onclick="rc.exit()"></span></li>
            <li><span class="fas fa-video videoOpen" title="Start Camera" onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)"></span></li>
            <li><span class="fas fa-video-slash videoClose hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.video)"></span></li>
            <li><span class="fas fa-microphone audioOpen" title="Start Microphone" onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)"></span></li>
            <li><span class="fas fa-microphone-slash audioClose hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.audio)"></span></li>
            <li><span class="fas fa-desktop" title="Screen Share" onclick="rc.produce(RoomClient.mediaType.screen)"></span></li>
            <li><span class="fas fa-desktop hide" title="Stop Screen Share" onclick="rc.closeProducer(RoomClient.mediaType.screen)"></span></li>
            <li><span class="fas fa-comment-slash chattoggle" title="Chat"></span></li>
            <li><span class="fas fa-exclamation reporttoggle" title="Report a Problem"></span></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
        </ul>
    </div>
</nav>
<div class="container mBody">
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
</div>


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