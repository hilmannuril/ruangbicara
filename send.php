<?php
session_start();
include "db.php";

if (isset($_POST["message"]) && isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $message = trim($_POST["message"]);

    if ($message != "") {
		date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
		$stmt = $conn->prepare("INSERT INTO messages (username, message, timestamp) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $username, $message, $now);
        $stmt->execute();
    }
}

if (isset($_POST['delete_old_messages'])) {
    $sql = "
        DELETE FROM messages 
        WHERE id NOT IN (
            SELECT id FROM (
                SELECT id FROM messages ORDER BY timestamp DESC LIMIT 5
            ) AS temp
        )
    ";

    if ($conn->query($sql) === TRUE) {
        echo "Pesan lama berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
	// Redirect kembali ke chat.php
	$_SESSION['success_message'] = "Pesan lama berhasil dihapus.";
    header("Location: chat.php");
    exit();
}


?>

