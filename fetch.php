<?php
include "db.php";

$result = $conn->query("SELECT * FROM messages ORDER BY timestamp DESC LIMIT 50");

$messages = array();
while ($row = $result->fetch_assoc()) {
    $messages[] = "<p><strong>{$row['username']}:</strong> {$row['message']} <br/><small>({$row['timestamp']})</small></p>";

}
echo implode("", array_reverse($messages));
?>