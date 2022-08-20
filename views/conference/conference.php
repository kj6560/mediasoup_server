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
        background-color: white;
        margin: 0;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
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

<div class="container">
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