<?php
require '../web_user/config.php';
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Recipe Website</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: row; /* Pastikan sidebar dan content berada sejajar horizontal */
        margin: 0;
        height: 100vh; /* Pastikan tinggi seluruh halaman */
    }

        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: #fff;
            height: 100vh; /* Pastikan sidebar memiliki tinggi penuh */
            padding: 20px;
            box-sizing: border-box;
            flex-shrink: 0; /* Mencegah sidebar mengecil */
        }

        .content {
            padding: 20px;
            flex-grow: 1; /* Buat content fleksibel mengisi sisa ruang */
            overflow-y: auto; /* Tambahkan scroll jika konten terlalu panjang */
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        .content {
            padding: 20px;
            flex-grow: 1;
        }

        .card {
            background-color: #f4f4f4;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input, form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        /* Container untuk tombol Edit dan Delete */
.action-buttons {
    display: flex;
    justify-content: space-between; /* Memisahkan tombol ke kiri dan kanan */
    gap: 10px; /* Memberi jarak di antara tombol */
}

.action-buttons a {
    text-decoration: none;
    color: #fff;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 14px;
    text-align: center;
    display: inline-block;
    width: 45%; /* Mengatur lebar tombol agar konsisten */
}

.action-buttons a:hover {
    opacity: 0.9;
}

/* Gaya untuk tombol Edit */
.action-buttons a[href*="edit.php"] {
    background-color: #4CAF50; /* Hijau */
    border: 1px solid #3e8e41;
}

.action-buttons a[href*="edit.php"]:hover {
    background-color: #45a049; /* Hijau lebih cerah */
}

/* Gaya untuk tombol Delete */
.action-buttons a[href*="delete.php"] {
    background-color: #f44336; /* Merah */
    border: 1px solid #d32f2f;
}

.action-buttons a[href*="delete.php"]:hover {
    background-color: #e53935; /* Merah lebih cerah */
}


        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage resep.php">Manage Recipes</a></li>
            <li><a href="manage_user.php">Manage Users</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Here you can manage recipes, users, and other settings.</p>

        <div class="card">
            <h3>Add New Recipe</h3>
            <form id="recipeForm" method="post" action="">
                <label for="title">Recipe Title:</label>
                <input type="text" id="title" name="judul_resep" required>

                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <label for="description">Description:</label>
                <textarea id="description" name="deskripsi_resep" required></textarea>

                <label for="ingredients">Ingredients:</label>
                <textarea id="ingredients" name="bahan_resep" required></textarea>

                <label for="instructions">Instructions:</label>
                <textarea id="instructions" name="cara_resep" required></textarea>

                <button type="submit" name="submit">Add Recipe</button>
            </form>
        </div>

        <div class="card">
            <h3>Recipes List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Ingredients</th>
                        <th>Instructions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="recipeList">
    <?php
    require '../web_user/config.php'; // Pastikan file konfigurasi database terhubung

    // Query untuk mengambil data resep
    $sql = "SELECT * FROM resep";
    $result = $conn->query($sql);

    // Periksa apakah ada data
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['judul_resep']) . "</td>";
            echo "<td><img src='../" . htmlspecialchars($row['gambar_resep']) . "' alt='Image' style='width:100px; height:auto;'></td>";
            echo "<td>" . htmlspecialchars($row['deskripsi_resep']) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row['bahan_resep'])) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row['cara_resep'])) . "</td>";
            echo "<td>
                    <div class='action-buttons'>
                        <a href='edit.php?id=" . $row['id_resep'] . "'>Edit</a>
                        <a href='delete.php?id=" . $row['id_resep'] . "' onclick='return confirm('Are you sure you want to delete this recipe?')'>Delete</a>
                     </div>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No recipes found.</td></tr>";
    }

    $conn->close(); // Tutup koneksi database
    ?>
</tbody>

            </table>
        </div>
    </div>
</body>
</html>
