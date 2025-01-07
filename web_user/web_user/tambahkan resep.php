<?php 
require 'config.php';

session_start();
if (!isset($_SESSION['login'])) {
    echo "You need to login first.";
    echo '<br>';
    echo '<form action="login.php">
    <input type="submit" value="Login"/>
    </form>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Resep</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Gaya Umum */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('1d8a347c89f303015942f3e2c3628dbf.jpg'); /* Ganti dengan URL gambar Anda */
            background-size: cover;
            background-position: center;
            filter: blur(8px); /* Efek blur */
            z-index: -1;
        }
        .dark-mode {
            background-color: #2c3e50;
            color: #ecf0f1;
        }
        h1, h2, h3, h4 {
            color: #2c3e50;
        }
        .dark-mode h1{
            color:rgb(252, 252, 252);
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Navigasi */
        .navbar {
            background: linear-gradient(135deg, rgb(24, 113, 247), rgb(24, 113, 247));
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .navbar a:hover {
            background-color: white;
            color: rgb(61, 158, 250);
        }
        .navbar .login {
            position: absolute;
            right: 20px;
            top: 10px;
        }
        .dark-mode .navbar {
            background: linear-gradient(135deg, #1b2b38, #1b2b38);
        }

        /* Formulir Resep */
        form {
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        form input, form button {
            width: calc(100% - 20px);
            margin-bottom: 20px;
            padding: 15px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        form input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 6px rgba(52, 152, 219, 0.5);
        }
        form button {
            background: linear-gradient(135deg, #1abc9c, #16a085);
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form button:hover {
            background: linear-gradient(135deg, #16a085, #1abc9c);
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        /* Notifikasi */
        #notification {
            display: none;
            background: #2ecc71;
            color: white;
            padding: 10px 20px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 8px;
            animation: fade-in 0.5s ease;
        }
        #notification.hidden {
            display: none;
        }
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Footer */
        footer {
            background: #34495e;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .dark-mode footer {
            background: #1b2b38;
        }
        .dark-mode-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ecf0f1;
            color: #333;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dark-mode .dark-mode-toggle {
            background: #34495e;
            color: #ecf0f1;
        }
    </style>
</head>
<body>
    <div class="background-image"></div>
    <div class="navbar">
        <a href="index.php">Beranda</a>
        <a href="resep.php">Resep</a>
        <a href="tambahkan resep.php">Resep Baru</a>
        <a href="favorit.php">Favorit</a>
        <a href="#">Tentang Kami</a>
        <?php 
        
        if (isset($_SESSION['login'])) {
            echo '<a href="logout.php" class="login">Log Out</a>';
        } else {
            echo '<a href="login.php" class="login">Login</a>';
        }
        
        ?>
    </div>
    <div class="container">
        <h1>Tambahkan Resep</h1>
        <div id="notification" class="hidden">Resep berhasil ditambahkan!</div>
        <form id="recipe-form" action="" method="POST" enctype="multipart/form-data">
            <h2>Judul Resep</h2>
            <input type="text" id="recipe-title" name="judul_resep" placeholder="Judul Resep" required>
            <h2>Unggah Gambar Resep:</h2>
            <input type="file" id="recipe-image" name="gambar_resep" accept="image/*" required>
            <h2>Deskripsi Resep</h2>
            <div id="recipe-description">
                <input type="text" name="deskripsi_resep" placeholder="Deskripsi" required>
            </div>
            <h2>Bahan-Bahan:</h2>
            <div id="ingredients-list">
                <textarea name="bahan_resep" id="" style="width: 100%; height: 15rem; border-color: #BCCCDC;"></textarea>
            </div>
            <h2>Cara Membuat:</h2>
            <div id="recipe-method">
            <textarea name="cara_resep" id="" style="width: 100%; height: 15rem; border-color: #BCCCDC; margin-bottom: 2rem;"></textarea>
            </div>
            <button type="submit" name="submit">Simpan Resep</button>
        </form>
    </div>
    <footer>
        <p>Bagikan Resep Anda &copy; 2024</p>
    </footer>
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">Mode Gelap</button>
    <script>
        // Toggle Mode Gelap
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>
<?php
require 'config.php';
if (isset($_POST['submit'])) {
    $judulResep = $_POST['judul_resep'];
    $deskripsiResep = $_POST['deskripsi_resep'];
    $bahanResep = $_POST['bahan_resep'];
    $caraResep = $_POST['cara_resep'];

    // Proses unggah gambar
    $gambarResep = "";
    if (isset($_FILES['gambar_resep']) && $_FILES['gambar_resep']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "img/"; // Folder untuk menyimpan file gambar
        $fileName = basename($_FILES["gambar_resep"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        
        // Pastikan folder 'uploads' ada
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        // Pindahkan file gambar
        if (move_uploaded_file($_FILES["gambar_resep"]["tmp_name"], $targetFilePath)) {
            $gambarResep = 'img/'.$fileName;
        } else {
            echo "Gagal mengunggah gambar.";
        }
    }

    // Simpan data ke database
    $sql = "INSERT INTO resep (judul_resep, deskripsi_resep, bahan_resep, cara_resep, gambar_resep)
            VALUES ('$judulResep', '$deskripsiResep', '$bahanResep', '$caraResep', '$gambarResep')";

    if ($conn->query($sql) === TRUE) {
        echo "Resep berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>