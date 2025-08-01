<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <style>
        #chat-box {
            width: 95%;
            height: 500px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            margin-bottom: 10px;
			border: 3px solid #3483eb;
			padding-left:10px;
        }
		body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
		.button {
			background: -webkit-linear-gradient(top, #008dfd 0, #0370ea 100%);
			border: 1px solid #076bd2;
			border-radius: 3px;
			color: #fff;
			display: none;
			font-size: 13px;
			font-weight: bold;
			line-height: 1.3;
			padding: 8px 25px;
			text-align: center;
			text-shadow: 1px 1px 1px #076bd2;
			letter-spacing: normal;
		  }
		  .center {
			text-align: center;
		  }
        .container {
			width: 85%;
			margin-left: 220px;
			display: flex;
			gap: 20px; /* Jarak antar kiri dan kanan */
			box-sizing: border-box;
        }
        .left {
             width: 100%;
			background-color: #f9f9f9;
			padding: 15px;
			border-radius: 8px;
        }
        .right {
            width: 40%;
			border: 2px dashed #ccc;
			padding: 15px;
			border-radius: 8px;
			background-color: #fff;
        }
        video {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        #result {
            background-color: #fff;
            padding: 10px;
            min-height: 100px;
            border: 1px solid #ccc;
        }
		
		  #results {
			font-size: 13px;
			font-weight: bold;
			border: 5px solid #3483eb;
			padding: 15px;
			text-align: left;
			min-height: 150px;
			max-height: 560px;
			height: 150px;
			overflow: scroll;
		  }
		  .info {
			font-size: 10px;
			text-align: center;
			color: #777;
		    display: none;
		  }
		 sidebyside {
			display: inline-block;
			width: 45%;
			min-height: 40px;
			text-align: left;
			vertical-align: top;
		  }
		  #info {
			font-size: 12px;
			text-align: center;
			color: #777;
			box-shadow: 0 2px 5px rgba(0,0,0,0.1);
			position: fixed;
			bottom: 250px;
		
		  }
		  video#webcam {
				display: block;
				margin: 0 auto;
				width: 640px;     /* lebar */
				height: 480px;    /* tinggi */
				border: 5px solid #3483eb;
			}
			
			select,input {
				padding: 10px 15px;
				border-radius: 8px;
				border: 1px solid #ccc;
				font-size: 16px;
				margin-right: 10px;
				background-color: #f9f9f9;
				cursor: pointer;
				transition: border-color 0.3s ease, box-shadow 0.3s ease;
			}

			select:focus {
				border-color: #2575fc;
				box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
				outline: none;
			}

			button {
				background-color: #2575fc;
				border: none;
				border-radius: 8px;
				padding: 10px 20px;
				color: white;
				font-size: 16px;
				cursor: pointer;
				transition: background-color 0.3s ease, transform 0.2s ease;
			}

			button:hover {
				background-color: #1a5edc;
				transform: scale(1.05);
			}

			button a {
				color: white;
				text-decoration: none;
				font-weight: bold;
			}

			button a:hover {
				text-decoration: underline;
			}
			
			.info-box {
				background-color: #f0f4ff;
				padding: 20px 25px;
				border-left: 6px solid #2575fc;
				border-radius: 10px;
				margin-bottom: 20px;
				box-shadow: 0 4px 8px rgba(0,0,0,0.1);
				font-family: 'Segoe UI', sans-serif;
			}

			.info-box h2 {
				margin: 0 0 10px 0;
				font-size: 20px;
				color: #2c3e50;
			}

			.info-box p {
				margin: 0;
				font-size: 16px;
				color: #555;
			}
			
			.welcome-msg {
				font-family: 'Segoe UI', sans-serif;
				font-size: 20px;
				color: #333;
				background-color: #f0f4ff;
				padding: 15px 20px;
				border-radius: 10px;
				box-shadow: 0 2px 5px rgba(0,0,0,0.1);
				display: inline-block;
			}

			.welcome-msg a {
				color: #2575fc;
				text-decoration: none;
				font-weight: bold;
				margin-left: 10px;
				transition: color 0.3s ease;
			}

			.welcome-msg a:hover {
				color: #1a5edc;
				text-decoration: underline;
			}
			
			/* Sidebar Menu */
				.menu {
					position: fixed;
					top: 0;
					left: 0;
					width: 220px;
					height: 100vh;
					background-color: #2575fc;
					color: white;
					padding: 20px;
					box-sizing: border-box;
				}

				.menu .logo {
					font-size: 24px;
					font-weight: bold;
					margin-bottom: 30px;
					text-align: center;
				}

				.nav {
					list-style: none;
					padding: 0;
					margin: 0;
				}

				.nav li {
					margin: 15px 0;
				}

				.nav li a {
					color: white;
					text-decoration: none;
					display: block;
					padding: 10px 15px;
					border-radius: 6px;
					transition: background 0.3s ease;
				}

				.nav li a:hover {
					background-color: #1a5edc;
				}
				
				.profile {
					text-align: center;
					margin-bottom: 30px;
				}

				.profile img {
					width: 100px;
					height: 100px;
					border-radius: 50%;
					object-fit: cover;
					border: 3px solid #fff;
					box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
				}

				.profile .username {
					margin-top: 10px;
					font-size: 16px;
					font-weight: 600;
				}
				
				.nav li a.logout {
					background-color: #ff4d4d;
					color: #fff;
					font-weight: bold;
					margin-top: 30px;
				}

				.nav li a.logout:hover {
					background-color: #cc0000;
				}

    </style>
    <script>
        function loadChat() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch.php", true);
            xhr.onload = function () {
                document.getElementById("chat-box").innerHTML = this.responseText;
            };
            xhr.send();
        }

        function sendChat() {
            const message = document.getElementById("message").value;
            if (message.trim() !== "") {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "send.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    document.getElementById("message").value = "";
                    loadChat();
                };
                xhr.send("message=" + encodeURIComponent(message));
            }
            return false;
        }

        setInterval(loadChat, 1000);
    </script>
</head>
<body onload="loadChat()">
    <div class="menu">
		<div class="logo">Smart 2025</div>
		<div class="profile">
			<img src="abg.jpg" alt="Foto Profil">
			<div class="username"><?php echo $_SESSION["username"]; ?></div>
      	</div>
		  <ul class="nav">
			<li><a href="#">Dashboard</a></li>
			<li><a href="#">Profil</a></li>
			<li><a href="#">Pengaturan</a></li>
			<li><a href="logout.php" class="logout">Keluar</a></li>
		  </ul>
	</div>
	
	<div class="container">
		<div class="left">
			<div class="info-box">
				<h2>Mata Kuliah : Rekayasa Perangkat Lunak</h2>
				<p>#1 - Selasa 16 Juli 2025 pukul 14.30-17.00 WIB</p>
			</div>
			<video id="webcam" autoplay playsinline></video>
			<br/>
			<div class="center">
			<label for="cameraSelect">Pilih Kamera:</label>
			<select id="cameraSelect"></select>
			<select id="select_language" onchange="updateCountry()"></select>
			  
			  <select id="select_dialect"></select>
			<button id="start_button" onclick="startButton(event)">
			  <a href="#" class="fa fa-microphone"> Mulai berbicara</a>
			</button>
			
			


			<div id="div_language">
			  
			</div>
		  </div>
			  </hr>
		  <div id="info">
			<p id="info_speak_now">Bicara Sekarang.</p>
			<p id="info_no_speech">
			  Tidak ada speech terdeteksi.
			  <a
				href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892"
			  >
				Klik Disini Untuk Melihat Bantuan</a
			  >.
			</p>
			<p id="info_no_microphone" style="display: none">
			  No microphone was found. Ensure that a microphone is installed and that
			  <a
				href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892"
			  >
				microphone settings</a
			  >
			  are configured correctly.
			</p>
			<p id="info_allow">Klik Tombol "Allow" untuk mengaktifkan microphone Anda.</p>
			<p id="info_denied">Permintaan Akses Microphone di Tolak</p>
			<p id="info_blocked">
			  Permission to use microphone is blocked. To change, go to
			  chrome://settings/contentExceptions#media-stream
			</p>
			<p id="info_upgrade">
			  Web Speech API is not supported by this browser. Upgrade to
			  <a href="//www.google.com/chrome">Chrome</a> version 25 or later.
			</p>
		  </div>
		  

		  
		<!--   <div>
			<button onclick="location.reload();">Refresh</button>
		  </div> -->
		  <br/>
		  <div id="results">
			<span id="final_span" class="final"></span>
			<span id="interim_span" class="interim"></span>
			<p></p>
		  </div>

		  <div class="center">
			<div class="sidebyside">
			  <button id="email_button" class="button" onclick="emailButton()">
				Create Email</button>
			  <div id="email_info" class="info">
				Text sent to default email application.<br>
				(See chrome://settings/handlers to change.)
			  </div>
			</div>
			<p></p>
			
		  </div>
		  <script>
			var langs = [
			  ["-", ["id-ID"]],
			  ["Bahasa Indonesia", ["id-ID"]]

			];

			for (var i = 0; i < langs.length; i++) {
			  select_language.options[i] = new Option(langs[i][0], i);
			}
			select_language.selectedIndex = 0;
			updateCountry();
			select_dialect.selectedIndex = 1;
			showInfo("info_start");

			function updateCountry() {
			  for (var i = select_dialect.options.length - 1; i >= 0; i--) {
				select_dialect.remove(i);
			  }
			  var list = langs[select_language.selectedIndex];
			  for (var i = 1; i < list.length; i++) {
				select_dialect.options.add(new Option(list[i][1], list[i][0]));
			  }
			  select_dialect.style.visibility = list[1].length == 1 ? "hidden" : "visible";
			}

			var create_email = false;
			var final_transcript = "";
			var recognizing = false;
			var ignore_onend;
			var start_timestamp;
			if (!("webkitSpeechRecognition" in window)) {
			  upgrade();
			} else {
			  start_button.style.display = "inline-block";
			  var recognition = new webkitSpeechRecognition();
			  recognition.continuous = true;
			  recognition.interimResults = true;

			  recognition.onstart = function () {
				recognizing = true;
				showInfo("info_speak_now");
				start_img.src = "mic-animate.gif";
			  };

			  recognition.onerror = function (event) {
				if (event.error == "no-speech") {
				  start_img.src = "mic.gif";
				  showInfo("info_no_speech");
				  ignore_onend = true;
				}
				if (event.error == "audio-capture") {
				  start_img.src = "mic.gif";
				  showInfo("info_no_microphone");
				  ignore_onend = true;
				}
				if (event.error == "not-allowed") {
				  if (event.timeStamp - start_timestamp < 100) {
					showInfo("info_blocked");
				  } else {
					showInfo("info_denied");
				  }
				  ignore_onend = true;
				}
			  };

			  recognition.onend = function () {
				recognizing = false;
				if (ignore_onend) {
				  return;
				}
				start_img.src = "mic.gif";
				if (!final_transcript) {
				  showInfo("info_start");
				  return;
				}
				showInfo("");
				if (window.getSelection) {
				  window.getSelection().removeAllRanges();
				  var range = document.createRange();
				  range.selectNode(document.getElementById("final_span"));
				  window.getSelection().addRange(range);
				}
				if (create_email) {
				  create_email = false;
				  createEmail();
				}
			  };

			  var latestTranscript = "";
			  recognition.onresult = function (event) {
				var interim_transcript = "";
				for (var i = event.resultIndex; i < event.results.length; ++i) {
				  if (event.results[i].isFinal) {
					final_transcript += event.results[i][0].transcript;
				  } else {
					interim_transcript += event.results[i][0].transcript;
				  }
				}
				final_transcript = capitalize(final_transcript);

			   

				var newTranscript = final_transcript.slice(latestTranscript.length);
				latestTranscript = final_transcript;

				final_span.innerHTML = linebreak(final_transcript);
				interim_span.innerHTML = linebreak(interim_transcript);
				
				if (final_transcript || interim_transcript) {
				  showButtons("inline-block");
				}
			  };
			}
				  // Function to reset the transcript and restart recognition
		  
				  


			  function resetTranscriptAndRestart() {
				
				interim_span.innerHTML = ""; // Append the new transcript

				// Clear the final transcript
				final_transcript = "";
				final_span.innerHTML = "";

				showButtons("none"); // Hide the buttons

				// Restart the recognition process
				recognition.start();
				ignore_onend = false;
				start_img.src = "mic-slash.gif";
				showInfo("info_allow");
			  }



			function upgrade() {
			  start_button.style.visibility = "hidden";
			  showInfo("info_upgrade");
			}

			var two_line = /\n\n/g;
			var one_line = /\n/g;
			function linebreak(s) {
			  return s.replace(two_line, "<p></p>").replace(one_line, "<br>");
			}

			var first_char = /\S/;
			function capitalize(s) {
			  return s.replace(first_char, function (m) {
				return m.toUpperCase();
			  });
			}

			function createEmail() {
			  var n = final_transcript.indexOf("\n");
			  if (n < 0 || n >= 80) {
				n = 40 + final_transcript.substring(40).indexOf(" ");
			  }
			  var subject = encodeURI(final_transcript.substring(0, n));
			  var body = encodeURI(final_transcript.substring(n + 1));
			  window.location.href = "mailto:?subject=" + subject + "&body=" + body;
			}

			function copyButton() {
			  if (recognizing) {
				recognizing = false;
				recognition.stop();
			  }
			  copy_button.style.display = "none";
			  copy_info.style.display = "inline-block";
			  showInfo("");
			}

			function emailButton() {
			  if (recognizing) {
				create_email = true;
				recognizing = false;
				recognition.stop();
			  } else {
				createEmail();
			  }
			  email_button.style.display = "none";
			  email_info.style.display = "inline-block";
			  showInfo("");
			}

			function startButton(event) {
			  if (recognizing) {
				recognition.stop();
				return;
			  }
			  final_transcript = "";
			  recognition.lang = select_dialect.value;
			  recognition.start();
			  ignore_onend = false;
			  final_span.innerHTML = "";
			  interim_span.innerHTML = "";
			  start_img.src = "mic-slash.gif";
			  showInfo("info_allow");
			  showButtons("none");
			  start_timestamp = event.timeStamp;
			}

			function showInfo(s) {
			  if (s) {
				for (var child = info.firstChild; child; child = child.nextSibling) {
				  if (child.style) {
					child.style.display = child.id == s ? "inline" : "none";
				  }
				}
				info.style.visibility = "visible";
			  } else {
				info.style.visibility = "hidden";
			  }
			}

			var current_style;
			function showButtons(style) {
			  if (style == current_style) {
				return;
			  }
			  current_style = style;
			  copy_button.style.display = style;
			  email_button.style.display = style;
			  copy_info.style.display = "none";
			  email_info.style.display = "none";
			}
			
		  </script>
		</div>
		
		
		<div class="right">
			<h2 class="welcome-msg">
			  Welcome, <?php echo $_SESSION["username"]; ?> |
			  <a href="#">It's you</a>
			</h2>
			<div id="chat-box"></div>
			<form onsubmit="return sendChat();">
				<input type="text" id="message" autocomplete="off" placeholder="Type your message..." required>
				<button type="submit">Send</button>
			</form>
			
			<br/><br/>


			<form method="post" action="send.php">
				<button type="submit" name="delete_old_messages">Hapus Pesan Lama</button>
			</form>

			<?php if (isset($_SESSION['success_message'])): ?>
				<div id="notif" style="color: green; margin-top: 10px;">
					<?= $_SESSION['success_message']; ?>
				</div>
				<script>
					setTimeout(() => {
						document.getElementById('notif').style.display = 'none';
					}, 5000);
				</script>
				<?php unset($_SESSION['success_message']); ?>
			<?php endif; ?>
		</div>
	</div>

	<script>
			// Menyalakan webcam
			const video = document.getElementById('webcam');
			navigator.mediaDevices.getUserMedia({ video: true, audio: false })
				.then(stream => {
					video.srcObject = stream;
				})
				.catch(error => {
					console.error('Error accessing webcam:', error);
				});
		</script>
		
		<script>
	  const videoElement = document.getElementById('webcam');
	  const cameraSelect = document.getElementById('cameraSelect');
	  let currentStream;

	  function stopMediaTracks(stream) {
		stream.getTracks().forEach(track => track.stop());
	  }

	  function startCamera(deviceId) {
		if (currentStream) {
		  stopMediaTracks(currentStream);
		}

		const constraints = {
		  video: { deviceId: deviceId ? { exact: deviceId } : undefined }
		};

		navigator.mediaDevices.getUserMedia(constraints)
		  .then(stream => {
			currentStream = stream;
			videoElement.srcObject = stream;
		  })
		  .catch(error => {
			console.error('Gagal mengakses kamera:', error);
		  });
	  }

	  function loadCameraList() {
		navigator.mediaDevices.enumerateDevices()
		  .then(devices => {
			cameraSelect.innerHTML = '';
			const videoDevices = devices.filter(device => device.kind === 'videoinput');
			
			videoDevices.forEach((device, index) => {
			  const option = document.createElement('option');
			  option.value = device.deviceId;
			  option.text = device.label || `Kamera ${index + 1}`;
			  cameraSelect.appendChild(option);
			});

			if (videoDevices.length > 0) {
			  startCamera(videoDevices[0].deviceId);
			}
		  });
	  }

	  cameraSelect.addEventListener('change', () => {
		startCamera(cameraSelect.value);
	  });

	  navigator.mediaDevices.getUserMedia({ video: true })
		.then(() => {
		  loadCameraList();
		})
		.catch(err => {
		  console.error('Izin kamera ditolak atau tidak tersedia.', err);
		});
	</script>



    
</body>
</html>