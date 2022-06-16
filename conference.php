<?php
error_reporting(E_ALL);
require 'db.php';
$conn = connect();
$user_id = !empty($_GET['u']) ? $_GET['u'] : false;
$conference_type = !empty($_GET['t']) ? $_GET['t'] : false;
if ($conn && $user_id) {
	$current_user = getUser($user_id, $conn);
	if ($current_user) {
		$conference = getConference($conn, $current_user, $conference_type);
		$host = !empty($conference) ? getUser($conference['conference_by'], $conn) : false;
		$participants = !empty($conference) ? explode(",", $conference['conference_for']) : false;
		if ($conference) {


?>
			<!DOCTYPE html>
			<html>

			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width">

				<title>Psychowellness Video Conferencing</title>

				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
				<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
				<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.js" integrity="sha512-9mpsATI0KClwt+xVZfbcf2lJ8IFBAwsubJ6mI3rtULwyM3fBmQFzj0It4tGqxLOGQwGfJdk/G+fANnxfq9/cew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
				<script src="js/EventEmitter.min.js"></script>
				<script src="js/mediasoupclient.min.js"></script>
				<script src="js/RoomClient.js"></script>
				<style>
					* {
						box-sizing: border-box;
						margin: 0;
						padding: 0;
					}

					body {
						background: rgb(78, 76, 76);
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
						position: relative;
						/*width: 70%;*/

					}

					#localMedia video {
						height: 150px;
						width: 150px;
						position: absolute;
						bottom: 10px;
						right: 10px;
						background-image: url(https://www.talktoangel.com/images/profile/profile.png);
						background-repeat: no-repeat;
						background-position: center;
						z-index: 2;
						box-shadow: 0px 0px 4px var(--gray);
					}

					.local-side {
						position: absolute;
						right: 0;
						bottom: 0;
						min-width: 15%;
						min-height: 25%;
						width: auto;
						height: auto;
						z-index: -100;
						background-size: cover;
						overflow: hidden;
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
						display: grid;
						z-index: 2;
						position: absolute;
						left: 0;
						top: 25%;
						background: #15748a;
						width: 60px;
						place-items: center;

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

					/*.feature::after {
			    content: "";
			    width: 10px;
			    height: 10px;
			    position: absolute;
			    right: -20px;
			    border-top: 20px solid transparent;
			    border-bottom: 20px solid transparent;
			    border-left: 20px solid #ff5d7d;
			    cursor: pointer;
			}*/
					.feature::before {
						content: 'x';
						color: #fff;
						font-weight: bolder;
						font-size: 1.5rem;
						position: absolute;
						right: -20px;
						z-index: -1;
						background: #272222;
						border-radius: 25px;
						width: 30px;
						height: 30px;
						text-align: center;
						cursor: pointer;
						line-height: 24px;
					}

					/*.chat-confrence {
			    position: absolute;
			    width: 30%;
			    height: 60vh;
			    background: green;
			    top: 0;
			    right: 0;
			    z-index: 2;
			}*/
					.hide {
						display: none;
					}
				</style>
				<script>
					var host = "<?php echo $conference['conference_by']; ?>";
					var current_user = "<?php echo $current_user['id']; ?>";
					host = host == current_user ? 1 : 0;
					console.log(host);
				</script>
			</head>

			<body>
				<section class="top-heading">
					<img src="https://www.talktoangel.com/images/logo.png" alt="Confrence Room">
					<p class="text-right text-white time">45:00</p>
				</section>
				<section class="video-confrence">
					<div id="devicesList" style="display: none;">
						<i class="fas fa-microphone"></i> Audio:
						<select id="audioSelect" class="form-select" style="width: auto"></select>
						<br />
						<i class="fas fa-video"></i> Video:
						<select id="videoSelect" class="form-select" style="width: auto"></select>
					</div>
					<div id="remoteVideos"></div>
					<div id="remoteAudios" style="display: none;"></div>
					<div id="localMedia"></div>
					<div class="feature">
						<span class="fas fa-phone" title="End Session" onclick="rc.exit()"></span>
						<span class="fas fa-video" title="Start Camera" onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)"></span>
						<span class="fas fa-video-slash hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.video)"></span>
						<span class="fas fa-microphone" title="Start Microphone" onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)"></span>
						<span class="fas fa-microphone-slash hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.audio)"></span>
						<span class="fas fa-desktop" title="Screen Share" onclick="rc.produce(RoomClient.mediaType.screen)"></span>
						<span class="fas fa-desktop hide" title="Stop Screen Share" onclick="rc.closeProducer(RoomClient.mediaType.screen)"></span>
						<span class="fas fa-comment" title="Chat"></span>
					</div>

				</section>

				<section class="chat-confrence">

				</section>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
			<script>
				let remoteVideos = document.querySelector("#remoteVideos");
				let localMedia = document.querySelector("#localMedia");
				let dragSrcEl = null;
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
			</script>

			</html>
<?php
		} else {
			echo "No Active conference available";
			die;
		}
	}
} else {
}

?>