<?php
// Tambahkan pengaman (opsional)
$token = 'hilman'; // ganti dengan kode unikmu
if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    http_response_code(403);
    exit('Unauthorized');
}

// Jalankan git pull
$repoDir = '/home/ruax7678/public_html';
$output = shell_exec("cd {$repoDir} && git pull 2>&1");

echo "<pre>$output</pre>";
?>
