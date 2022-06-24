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
				<script src="js/index.js"></script>
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
						max-height: 100%;
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
						background: #15748a;
						z-index: 3;
						bottom: 10px;
						right: 10px;
						border-radius: 10px;
						display: grid;
						place-items: center;
						color: #fff;
						background-image: url('https://www.talktoangel.com/images/logo/chat.png');
						background-blend-mode: soft-light;
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
				<script>
					var host = "<?php echo $conference['conference_by']; ?>";
					var current_user = "<?php echo $current_user['id']; ?>";
					host = host == current_user ? 1 : 0;
					console.log(host);
				</script>
			</head>

			<body>
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
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


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