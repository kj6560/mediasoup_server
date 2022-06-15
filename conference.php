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
						padding: 10px;
					}

					.time {
						font-size: 1.5rem;
					}

					.video-confrence {
						background: rgb(17, 17, 17);
						;
						height: 92vh;
						position: relative;

					}

					/* .chat-confrence{
			background: red;
			height: 92vh;
			
		} */
					.local-side {
						background: rgb(10, 10, 10);
						height: 150px;
						width: 150px;
						position: absolute;
						bottom: 0;
						right: 0;
						background-image: url('https://www.talktoangel.com/images/profile/profile.png');
						background-repeat: no-repeat;
						background-position: center;
						z-index: 2;
					}

					.remote-side {
						background: rgb(39, 34, 34);
						height: 92vh;
						position: relative;
						bottom: 0;
						right: 0;
						background-image: url('https://www.talktoangel.com/images/profile/profile.png');
						background-repeat: no-repeat;
						background-position: center;
						z-index: 2;
					}

					.feature {
						position: absolute;
						bottom: 0;
						width: 100%;
						display: flex;
						justify-content: center;
						z-index: 2;

					}

					.feature span {
						margin: 10px;
						font-size: 2rem;
						color: #fff;
						cursor: pointer;
						/* border:1px solid red; */
						border-radius: 100%;
						padding: 10px;
						box-shadow: 0px 0px 10px rgb(51, 50, 50);

					}

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
					<div class="remote-side"></div>
					<div class="local-side"></div>
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