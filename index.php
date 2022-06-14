<?php  

require 'db.php';
$conn = connect();
$user_id = !empty($_GET['u'])?$_GET['u']:false;
$conference_type = !empty($_GET['t'])?$_GET['t']:false;
if($conn && $user_id){
	$user = getUser($user_id,$conn);
	if($user){
		$conference = getConference($conn,$user,$conference_type);
		print_r($conference);
	}
?>
	<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Psychowellness Video Conferencing</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.js" integrity="sha512-9mpsATI0KClwt+xVZfbcf2lJ8IFBAwsubJ6mI3rtULwyM3fBmQFzj0It4tGqxLOGQwGfJdk/G+fANnxfq9/cew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/mediasoupclient.min.js"></script>
        <script src="js/EventEmitter.min.js"></script>
        <script src="js/RoomClient.js"></script>

        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <script src="js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="font-sans antialiased">
	<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container">
            <div id="login">
                <br />
                <i class="fas fa-server"> Room: </i><input id="roomidInput" value="123" type="text" />
                <!--<button id="createRoom" onclick="createRoom(roomid.value)" label="createRoom">Create Room</button>-->
                <i class="fas fa-user"> User: </i><input id="nameInput" value="user" type="text" />
                <button id="joinButton" onclick="joinRoom(nameInput.value, roomidInput.value)">
                    <i class="fas fa-sign-in-alt"></i> Join
                </button>
            </div>
        </div>

        <div class="container">
            <div id="control" class="hidden">
                <br />
                <button id="exitButton" class="hidden" onclick="rc.exit()">
                    <i class="fas fa-arrow-left"></i> Exit
                </button>
                <button id="copyButton" class="hidden" onclick="rc.copyURL()">
                    <i class="far fa-copy"></i> copy URL
                </button>
                <button id="devicesButton" class="hidden" onclick="rc.showDevices()">
                    <i class="fas fa-cogs"></i> Devices
                </button>
                <button
                    id="startAudioButton"
                    class="hidden"
                    onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)"
                >
                    <i class="fas fa-volume-up"></i> Open audio
                </button>
                <button id="stopAudioButton" class="hidden" onclick="rc.closeProducer(RoomClient.mediaType.audio)">
                    <i class="fas fa-volume-up"></i> Close audio
                </button>
                <button
                    id="startVideoButton"
                    class="hidden"
                    onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)"
                >
                    <i class="fas fa-camera"></i> Open video
                </button>
                <button id="stopVideoButton" class="hidden" onclick="rc.closeProducer(RoomClient.mediaType.video)">
                    <i class="fas fa-camera"></i> Close video
                </button>
                <button id="startScreenButton" class="hidden" onclick="rc.produce(RoomClient.mediaType.screen)">
                    <i class="fas fa-desktop"></i> Open screen
                </button>
                <button id="stopScreenButton" class="hidden" onclick="rc.closeProducer(RoomClient.mediaType.screen)">
                    <i class="fas fa-desktop"></i> Close screen
                </button>
                <br /><br />
                <div id="devicesList" class="hidden">
                    <i class="fas fa-microphone"></i> Audio:
                    <select id="audioSelect" class="form-select" style="width: auto"></select>
                    <br />
                    <i class="fas fa-video"></i> Video:
                    <select id="videoSelect" class="form-select" style="width: auto"></select>
                </div>
                <br />
            </div>
        </div>

        <div class="container">
            <div id="videoMedia" class="hidden">
                <h4><i class="fab fa-youtube"></i> Local media</h4>
                <div id="localMedia" class="containers">
                    <!--<video id="localVideo" autoplay inline class="vid"></video>-->
                    <!--<video id="localScreen" autoplay inline class="vid"></video>-->
                </div>
                <br />
                <h4><i class="fab fa-youtube"></i> Remote media</h4>
                <div id="remoteVideos" class="containers"></div>
                <div id="remoteAudios"></div>
            </div>
        </div>
            </div>
        </div>
    </div>
		<script src="js/index.js"></script>
    </body>
</html>

<?php
}else{
	die;
}

?>

