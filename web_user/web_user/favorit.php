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

$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

if ($id_user) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_favorit'])) {
        $id_resep = $_POST['id_resep'];

        // Get the current favorites
        $stmt = $conn->prepare("SELECT resep_favorit FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $favorit_list = array_filter(explode(',', $row['resep_favorit']));

        // Remove the favorite
        if (($key = array_search($id_resep, $favorit_list)) !== false) {
            unset($favorit_list[$key]);
            $updated_favorit = implode(',', $favorit_list);

            // Update the database
            $stmt = $conn->prepare("UPDATE user SET resep_favorit = ? WHERE id_user = ?");
            $stmt->bind_param("si", $updated_favorit, $id_user);
            $stmt->execute();
        }
    }

    // Fetch updated favorites
    $stmt = $conn->prepare("SELECT resep_favorit FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $favorit_list = array_filter(explode(',', $row['resep_favorit']));
    } else {
        $favorit_list = []; // Inisialisasi jika tidak ada data favorit
    }

    $favorit_resep = [];
    if (!empty($favorit_list)) {
        $placeholders = implode(',', array_fill(0, count($favorit_list), '?'));
        $types = str_repeat('i', count($favorit_list));
        $stmt = $conn->prepare("SELECT * FROM resep WHERE id_resep IN ($placeholders)");
        $stmt->bind_param($types, ...$favorit_list);
        $stmt->execute();
        $result_resep = $stmt->get_result();

        while ($row = $result_resep->fetch_assoc()) {
            $favorit_resep[] = $row;
        }
    }
} else {
    die("ID User tidak valid. Harap login kembali.");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Favorit</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Gaya Umum */
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
        h1 {
            text-align: center;
            color:rgb(255, 255, 255);
        }
        .dark-mode h1 {
            color: #ecf0f1;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
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

        /* Resep Favorit */
        .favorite-recipe {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .recipe-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex: 1 1 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
            min-width: 280px; /* Set a minimum width */
            text-align: center;
        }
        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .recipe-card img {
            width: 100%;
            height: auto;
        }

        .recipe-card h3 {
            margin: 15px 0;
            color:rgb(0, 0, 0);
            padding: 20px;
            font-size: 1.5em;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .recipe-card h3 a {
            text-decoration: none;
            color: inherit;
        }

        .recipe-card h3 a:hover {
            text-decoration: underline;
        }

        .dark-mode h3{
            color:rgb(252, 252, 252);
        }

        .recipe-card form {
            display: inline-block;
        }

        .recipe-card button {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .recipe-card button:hover {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
        }

        .dark-mode .recipe-card {
            background: #34495e;
            color: white;
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
        <button class="dark-mode-toggle" onclick="toggleDarkMode()">Mode Gelap</button>
        <h1>Resep Favorit</h1>
        <?php if (empty($favorit_resep)): ?>
        <p>Belum ada resep favorit.</p>
        <?php else: ?>
        <div class="favorite-recipe">
            <?php foreach ($favorit_resep as $resep): ?>
            <div class="recipe-card">
            <img src="<?= $resep['gambar_resep'] ?>" style="width:300px;height:200px" alt="Resep 1">
            <h3><a href="detail-resep.php?id_resep=<?= $resep['id_resep'] ?>"><?= $resep['judul_resep'] ?></a></h3>
                <form method="post" action="">
                    <input type="hidden" name="id_resep" value="<?= $resep['id_resep'] ?>">
                    <button type="submit" name="remove_favorit">Hapus dari Favorit</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    
    <footer>
        <p>Bagikan Resep Anda &copy; 2024</p>
    </footer>

    <script>
        // Toggle Mode Gelap
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>