<?php 

session_start();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama Resep</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
            position: relative;
        }
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('1d8a347c89f303015942f3e2c3628dbf.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            z-index: -1;
        }
        .dark-mode .background-image {
            filter: blur(8px) brightness(0.5);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .navbar {
            background: linear-gradient(135deg, rgb(24, 113, 247), rgb(24, 113, 247));
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
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
        .center-image {
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        .slider {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            min-width: 100%;
            flex-shrink: 0;
        }
        .slide img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .recipe-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            z-index: 1;
            position: relative;
        }
        .recipe-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .recipe-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .recipe-card img {
            width: 100%;
            height: auto;
        }
        .recipe-card h3 {
            padding: 20px;
            font-size: 1.5em;
            margin: 0;
            background: #ecf0f1;
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
        .recipe-card p {
            padding: 20px;
            font-size: 14px;
            line-height: 1.5;
            transition: color 0.3s ease;
        }
        .dark-mode .recipe-card {
            background: #34495e;
            color: #ecf0f1;
        }
        .dark-mode .recipe-card h3 {
            background: #2c3e50;
            color: #ecf0f1;
        }
        .dark-mode .recipe-card p {
            color: #bdc3c7;
        }
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
        <a href="web user.php">Beranda</a>
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
    <div class="center-image slider">
        <div class="slides">
            <div class="slide"><img src="makanan-indonesia-kompas.jpg" alt="Slide 1"></div>
            <div class="slide"><img src="624729f498ad4.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="6037b6fb51bdd.jpg" alt="Slide 3"></div>
        </div>
    </div>
    <div class="container">
        <div id="recipeList" class="recipe-list">
            <div class="recipe-card">
                <img src="614dc6865eb24.jpg" style="width:300px;height:200px" alt="Resep 1">
                <h3>Nasi Goreng</h3>
                <p>Nasi goreng adalah hidangan khas Indonesia berupa nasi goreng berbumbu gurih, biasanya disajikan dengan telur, daging, dan pelengkap seperti kerupuk.</p>
            </div>
            <div class="recipe-card">
                <img src="066100900_1644554867-shutterstock_1984582070.jpg" style="width:300px;height:200px" alt="Resep 2">
                <h3>Mie Goreng Jawa</h3>
                <p>Mie goreng Jawa adalah mie goreng khas Indonesia dengan bumbu rempah seperti bawang, kemiri, dan kecap manis, disajikan dengan telur, sayuran, dan ayam atau udang.</p>
            </div>
            <div class="recipe-card">
                <img src="shutterstock_1927030937.jpg" style="width:300px;height:200px" alt="Resep 3">
                <h3>Bubur Ayam</h3>
                <p>Bubur ayam adalah bubur nasi khas Indonesia yang disajikan dengan ayam suwir, kerupuk, kacang, daun bawang, dan kuah kuning gurih.</p>
            </div>
            <div class="recipe-card">
                <img src="Nasi-Pecel-Madiun.jpg" style="width:300px;height:200px" alt="Resep 4">
                <h3>Nasi Pecel</h3>
                <p>Nasi pecel adalah hidangan khas Indonesia berupa nasi dengan sayuran rebus, disiram bumbu kacang, dan dilengkapi lauk seperti tempe, rempeyek, atau tahu.</p>
            </div>
        </div>
    </div>
    <footer>
        <p>Bagikan Resep Anda &copy; 2024</p>
    </footer>
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">Mode Gelap</button>
    <script>
        let currentSlide = 0;
        const slides = document.querySelector('.slides');
        const totalSlides = slides.children.length;

        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
        }, 3000);

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>
