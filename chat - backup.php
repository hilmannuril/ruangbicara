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
            width: 100%;
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            margin-bottom: 10px;
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
    <h2>Welcome, <?php echo $_SESSION["username"]; ?> | <a href="logout.php">Logout</a></h2>
    <div id="chat-box"></div>
    <form onsubmit="return sendChat();">
        <input type="text" id="message" autocomplete="off" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
</body>
</html>