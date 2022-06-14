<?php
error_reporting(E_ALL);
require 'db.php';
$conn = connect();
$user_id = !empty($_GET['u']) ? $_GET['u'] : false;
$conference_type = !empty($_GET['t']) ? $_GET['t'] : false;
if ($conn && $user_id) {
	try {
		$current_user = getUser($user_id, $conn);
		if ($current_user) {
			$conference = getConference($conn, $current_user, $conference_type);
			$host = !empty($conference) ? getUser($conference['conference_by'], $conn) : false;
			$participants = !empty($conference) ? explode(",", $conference['conference_for']) : false;
		}
	} catch (Exception $e) {
		print_r($e->getMessage());
	}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">

		<title>Psychowellness Video Conferencing</title>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.js" integrity="sha512-9mpsATI0KClwt+xVZfbcf2lJ8IFBAwsubJ6mI3rtULwyM3fBmQFzj0It4tGqxLOGQwGfJdk/G+fANnxfq9/cew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="js/mediasoupclient.min.js"></script>
		<script src="js/EventEmitter.min.js"></script>
		<script src="js/RoomClient.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery.keep-ratio@0.1.4/dist/jquery.keep-ratio.min.js"></script>
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/style.css" rel="stylesheet" />
		<script src="js/bootstrap.bundle.min.js"></script>
		<script>
			var host = "<?php echo $conference['conference_by']; ?>";
			var current_user = "<?php echo $current_user['id']; ?>";
			host = host == current_user ? 1 : 0;
			console.log(host);
		</script>
		<style>
			html,
			body {
				height: 100vh;
				width: 100vw;
				overflow: hidden;
			}

			video {
				max-width: 100%;
				max-height: 100%;
				width: 100%;
				margin-bottom: -7px;
			}

			#participants {
				position: absolute;
				top: 0;
				right: -100%;
				transition: 0.3s;
				max-width: 100%;
				width: 350px;
				height: 100%;
			}

			#participants.show {
				right: 0%;
			}

			#chat {
				position: absolute;
				top: 0;
				right: -100%;
				transition: 0.3s;
				max-width: 100%;
				width: 350px;
				height: 100%;
			}

			#chat.show {
				right: 0%;
			}
		</style>
	</head>

	<body class="font-sans antialiased">
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<div class="container">
						<div id="login" style="display: none;">
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
						<div id="control">
							<br />
							<button id="exitButton" class="hidden" onclick="rc.exit()" style="display:none ;">
								<i class="fas fa-arrow-left"></i> Exit
							</button>
							<button id="copyButton" class="hidden" style="display:none ;" onclick="rc.copyURL()">
								<i class="far fa-copy"></i> copy URL
							</button>
							<button id="devicesButton" class="hidden" style="display:none ;" onclick="rc.showDevices()">
								<i class="fas fa-cogs"></i> Devices
							</button>
							<button id="startAudioButton" class="hidden" onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)">
								<i class="fas fa-volume-up"></i> Open audio
							</button>
							<button id="stopAudioButton" class="hidden" onclick="rc.closeProducer(RoomClient.mediaType.audio)">
								<i class="fas fa-volume-up"></i> Close audio
							</button>
							<button id="startVideoButton" class="hidden" onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value,host)">
								<i class="fas fa-camera"></i> Open video
							</button>
							<button id="stopVideoButton" class="hidden" onclick="rc.closeProducer(RoomClient.mediaType.video)">
								<i class="fas fa-camera"></i> Close video
							</button>
							<button id="startScreenButton" class="hidden" style="display:none ;" onclick="rc.produce(RoomClient.mediaType.screen)">
								<i class="fas fa-desktop"></i> Open screen
							</button>
							<button id="stopScreenButton" class="hidden" style="display:none ;" onclick="rc.closeProducer(RoomClient.mediaType.screen)">
								<i class="fas fa-desktop"></i> Close screen
							</button>
							<br /><br />
							<!-- class="hidden"  -->
							<div id="devicesList" style="display: none;">
								<i class="fas fa-microphone"></i> Audio:
								<select id="audioSelect" class="form-select" style="width: auto"></select>
								<br />
								<i class="fas fa-video"></i> Video:
								<select id="videoSelect" class="form-select" style="width: auto"></select>
							</div>
							<br />
						</div>
					</div>
					<div class="bg-dark d-flex flex-column h-100 w-100 p-4" style="position: fixed;top: 0; left: 0;">
						<h4 class="text-white text-center"><?php echo $_GET['room']; ?></h4>
						<div class="flex-grow-1">
							<!-- <div id="control" class="hidden">
                <button id='exitButton' class='hidden' onclick="rc.exit()">Exit</button>
                <br/>
                audio: <select id="audioSelect">
                </select>
                <br/>
                video: <select id="videoSelect">
                </select>
                <br />
                <button id='startAudioButton' class='hidden' onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)">audio</button>
                <button id='stopAudioButton' class='hidden' onclick="rc.closeProducer(RoomClient.mediaType.audio)">close
                    audio</button>
                <button id='startVideoButton' class='hidden' onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)">video</button>
                <button id='stopVideoButton' class='hidden' onclick="rc.closeProducer(RoomClient.mediaType.video)">close
                    video</button>
                <button id='startScreenButton' class='hidden' onclick="rc.produce(RoomClient.mediaType.screen)">screen</button>
                <button id='stopScreenButton' class='hidden' onclick="rc.closeProducer(RoomClient.mediaType.screen)">close
                    screen</button>
                <br />
            </div> -->
							<div class="row no-gutters h-100" id="remoteVideos">
								<!-- <div class="col-12 col-md-3 p-1"><video src=""></video></div> -->
							</div>
						</div>
						<div class="p-2 bg-white rounded d-flex">
							<div class="flex-grow-1">
								<button class="btn btn-danger" id='exitButton' onclick="rc.exit()">
									Leave
								</button>
							</div>
							<div class="flex-grow-1 text-center">
								<?php
								if (isset($_SESSION['user_email']) || $_SESSION['user_type'] == "Admin") {
								?>
									<button class="btn btn-outline-dark mr-1" id='startAudioButton' onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)">
										<i class="fas fa-microphone"></i>
									</button>
									<button class="btn btn-outline-dark mr-1" id='stopAudioButton' onclick="rc.closeProducer(RoomClient.mediaType.audio)">
										<i class="fas fa-microphone-slash"></i>
									</button>

									<button class="btn btn-outline-dark mr-1" id='startVideoButton' class='hidden' onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)">
										<i class="fas fa-video"></i>
									</button>
									<button class="btn btn-outline-dark mr-1" id='stopVideoButton' class='hidden' onclick="rc.closeProducer(RoomClient.mediaType.video)">
										<i class="fas fa-video-slash"></i>
									</button>

									<button class="btn btn-outline-dark" id='startScreenButton' class='hidden' onclick="rc.produce(RoomClient.mediaType.screen)">
										<i class="fas fa-desktop"></i>
									</button>
									<button class="btn btn-primary" id='stopScreenButton' class='hidden' onclick="rc.closeProducer(RoomClient.mediaType.screen)">
										<i class="fas fa-desktop"></i>
									</button>
								<?php
								} else {
								?>

									<button class="btn btn-outline-dark mr-1" id='startAudioButton' onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)" disabled>
										<i class="fas fa-microphone"></i>
									</button>
									<button class="btn btn-outline-dark mr-1" id='stopAudioButton' onclick="rc.closeProducer(RoomClient.mediaType.audio)" disabled>
										<i class="fas fa-microphone-slash"></i>
									</button>

									<button class="btn btn-outline-dark mr-1" id='startVideoButton' class='hidden' onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)" disabled>
										<i class="fas fa-video"></i>
									</button>
									<button class="btn btn-outline-dark mr-1" id='stopVideoButton' class='hidden' onclick="rc.closeProducer(RoomClient.mediaType.video)" disabled>
										<i class="fas fa-video-slash"></i>
									</button>

									<button class="btn btn-outline-dark" id='startScreenButton' class='hidden' onclick="rc.produce(RoomClient.mediaType.screen)" disabled>
										<i class="fas fa-desktop"></i>
									</button>
									<button class="btn btn-primary" id='stopScreenButton' class='hidden' onclick="rc.closeProducer(RoomClient.mediaType.screen)" disabled>
										<i class="fas fa-desktop"></i>
									</button>



								<?php } ?>
							</div>
							<div class="flex-grow-1 text-right">
								<button class="btn btn-outline-dark mr-2" data-toggle="chat">
									<i class="fas fa-comments"></i>
								</button>
								<button class="btn btn-outline-dark" data-toggle="participants">
									<i class="fas fa-user-friends"></i>
								</button>
							</div>
						</div>
					</div>
					<div id="participants" class="bg-white d-flex flex-column">
						<div class="p-2 bg-primary d-flex justify-content-between">
							<h5 class="m-0 text-white">Participants</h5>
							<button class="close text-white" data-toggle="participants">&times;</button>
						</div>
						<div class="p-1">
							<div class="input-group">
								<input type="text" class="form-control" id="participantSearch" placeholder="Search" />
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" onclick="searchParticipant()" type="button">Search</button>
								</div>
							</div>
						</div>
						<div id="participants-list" class="flex-grow-1 overflow-auto"></div>
					</div>

					<div id="chat" class="bg-white d-flex flex-column">
						<div id="videoMedia" class="hidden">

							<h4><i class="fab fa-youtube"></i> Remote media</h4>
							<div id="remoteVideos" class="containers"></div>
							<div id="remoteAudios"></div>
							<h4><i class="fab fa-youtube"></i> <?php echo $current_user['name'] ?></h4>
							<div id="localMedia" class="containers">
								<!--<video id="localVideo" autoplay inline class="vid"></video>-->
								<!--<video id="localScreen" autoplay inline class="vid"></video>-->
							</div>
							<br />

						</div>
					</div>
					<script src="js/index.js"></script>

					<script>
						window.onload = function() {
							var name = "<?php echo $current_user['name'] ?>";
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
					</script>
	</body>

	</html>

<?php
} else {
	die;
}

?>