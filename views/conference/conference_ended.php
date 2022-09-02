<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    #mydiv {
        top: 50%;
        left: 50%;
        width: 30em;
        height: 18em;
        margin-top: -9em;
        /*set to a negative number 1/2 of your height*/
        margin-left: -15em;
        /*set to a negative number 1/2 of your width*/
        border: 1px solid #ccc;
        background-color: #f3f3f3;
        position: fixed;
    }

    body {
        width: 100%;
        height: 100vh;
    }

    .top-heading {
        display: flex;
        justify-content: space-between;
        padding: 5px;
        align-items: center;
        height: 50px;
    }

    .time {
        font-size: 1.5rem;
    }

    .video-confrence {
        background: rgb(17, 17, 17);
        ;
        height: 93vh;
        position: absolute;
        width: 100%;

    }

    #localMedia {
        height: 150px;
        width: 150px;
        position: fixed;
        left: 0;
        top: 50px;
        background-image: url(https://www.talktoangel.com/images/profile/profile.png);
        background-repeat: no-repeat;
        background-position: center;
        z-index: 2;
        box-shadow: 0px 0px 4px var(--gray);
        cursor: move;
        /*transform: translate(-50%, -50%);*/
    }

    .local-side {
        max-width: 100%;
        max-height: 200%;
        width: auto;
    }

    #localMedia video.active {
        cursor: move;
        user-select: none;
    }

    #remoteVideos video {
        background: rgb(39, 34, 34);
        position: relative;
        bottom: 0;
        right: 0;
        background-image: url(https://www.talktoangel.com/images/profile/profile.png);
        background-repeat: no-repeat;
        background-position: center;
        z-index: 2;

        height: 92.6vh;
    }

    .remote-single video {
        width: 100%;
    }

    .remote-couple video {
        width: calc(100% - 50.2%);
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
        background-image: url('https://www.talktoangel.com/images/logo/chat.png');
        background-blend-mode: none;
    }

    .report-a-problem {
        position: absolute;
        width: 500px;
        height: 60vh;
        background: #fff;
        z-index: 4;
        top: 10%;
        left: 30%;
        border-radius: 10px;
        box-shadow: 0px 0px 4px 3px #676565;
    }

    .sessionEnd:hover {
        background: #ff5d7d;
    }

    .history-box {
        border: 1px solid #ff5d7d;
        width: 96%;
        height: 65vh;
        overflow-y: auto;
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

    .text-box {
        width: 96%;
        height: auto;
        display: flex;
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

<section class="top-heading">
    <img src="<?php echo BASE . 'img/logo.png' ?>" alt="Confrence Error" width="100">
</section>


<div class="container text-center" id="mydiv">
    <h4 style="margin-top: 100px;">Your Conference has ended. <a href="/conferences"> Click Here</a> for dashboard</h4>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>