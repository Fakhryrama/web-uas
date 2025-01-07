<?php 

require 'config.php';

if (isset($_GET['id_resep'])) {
    $id_resep = $_GET['id_resep'];

    $sql = "SELECT * FROM resep WHERE id_resep = $id_resep";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    $bahan_resep = explode('+', $row['bahan_resep']);
    $cara_resep = explode('+', $row['cara_resep']);

    
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        .dark-mode h1, .dark-mode h2, .dark-mode h3, .dark-mode h4 {
            color: #ecf0f1;
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
        .dark-mode .navbar {
            background: linear-gradient(135deg, #1b2b38, #1b2b38);
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dark-mode .container {
            background: #34495e;
        }
        .recipe-image {
            width: 100%;
            border-radius: 12px;
        }
        .recipe-title {
            color: #2c3e50;
            text-align: center;
            font-size: 2em;
            margin: 20px 0;
        }
        .dark-mode .recipe-title {
            color: #ecf0f1;
        }   
        .ingredients, .instructions {
            margin-bottom: 20px;
        }
        .ingredients h3, .instructions h3 {
            color: #2c3e50;
            border-bottom: 2px solid #f5f7fa;
            padding-bottom: 5px;
        }
        .dark-mode .ingredients h3, .dark-mode .instructions h3 {
            color: #ecf0f1;
        }
        .ingredients ul, .instructions ol {
            color: #2c3e50;
            margin: 0;
            padding-left: 20px;
        }
        .dark-mode .ingredients ul, .dark-mode .instructions ol {
            color: #ecf0f1;
        }
        footer {
            background: #34495e;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
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
        <a href="web user.php">Beranda</a>
        <a href="resep.php">Resep</a>
        <a href="tambahkan resep.php">Resep Baru</a>
        <a href="favorit.php">Favorit</a>
        <a href="#">Tentang Kami</a>
    </div>

    <div class="container">
    <img src="<?= $row['gambar_resep'] ?>" alt="Gambar Resep" class="recipe-image">
    <h1 class="recipe-title"><?= $row['judul_resep'] ?></h1>

    <div class="ingredients">
    <h3>Bahan-bahan</h3>
    <ul>
    </div>
    <?php 

    for ($i = 1; $i < count($bahan_resep); $i++){
        ?>
        <li><?= $bahan_resep[$i] ?></li>
    <?php
    }

    ?>
    </ul>

    <div class="instructions">
    <h3>Langkah-langkah</h3>
    <ol type="1">
    </div>
    <?php 

    for ($i = 1; $i < count($cara_resep); $i++){
        ?>
        <li><?= $cara_resep[$i] ?></li>
    <?php
    }

    ?>
    </ol>
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