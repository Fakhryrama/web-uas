<?php
require 'config.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm-password'];

    if ($password === $cpassword) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("INSERT INTO user (username, password, resep_favorit) VALUES (?, ?, '')");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo '<script>
            alert("Register Berhasil");
            window.location.href = "login.php";
            </script>';
            exit();
        } else {
            echo '<script>
            alert("Register Gagal");
            window.location.href = "register.php";
            </script>';
            exit();
        }
    } else {
        echo '<script>
        alert("Password Tidak Sesuai");
        window.location.href = "register.php";
        </script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .toggle {
            text-align: center;
            margin-top: 10px;
        }
        .toggle a {
            color: #3498db;
            text-decoration: none;
        }
        .toggle a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container" id="register-container">
        <h2>Register</h2>
        <form id="register-form" action="" method="post">
            <label for="register-username">Username</label>
            <input type="text" id="register-username" name="username" placeholder="Masukkan username" required>

            <label for="register-password">Password</label>
            <input type="password" id="register-password" name="password" placeholder="Masukkan password" required>

            <label for="register-confirm-password">Konfirmasi Password</label>
            <input type="password" id="register-confirm-password" name="confirm-password" placeholder="Masukkan kembali password" required>

            <button type="submit" name="submit">Daftar</button>
        </form>
        <div class="toggle">
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>