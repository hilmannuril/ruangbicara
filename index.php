<title>Ruang Bicara</title>
<link rel="icon" href="assets/ruangbicara.ico" type="image/x-icon">

<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_key = trim($_POST["subject_key"]);
    $username = trim($_POST["username"]);
    if ($username != "" &&  $subject_key == "ubhinus") {
        $_SESSION["username"] = $username;

        // Optional: simpan user
        $stmt = $conn->prepare("INSERT INTO users (username) VALUES (?)");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        header("Location: https://ruangbicara.online/chat.php");
        exit();
    }
    else {
       // Jika subject_key salah
        echo '
        <html>
        <head>
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
          <script>
            Swal.fire({
              icon: "error",
              title: "Subject Key Salah",
              text: "Silakan periksa kembali dan coba lagi.",
              confirmButtonText: "OK"
            }).then(() => {
              window.location.href = "index.php"; 
            });
          </script>
        </body>
        </html>';
        exit();
    }
}
?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!DOCTYPE html>
<html>
<head>
    <title>Login Chat</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        input[type="text"] {
            width: 80%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2575fc;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1a5edc;
        }
    </style>
</head>
<body>
    <form method="post">
        <img src="assets/logo.png" alt="Logo Ruang Bicara" width="370">
        <h2>Aplikasi Pintar PDP 2025</h2>
        <input type="text" name="subject_key" placeholder="subject key" required>
        <input type="text" name="username" placeholder="Enter username" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
