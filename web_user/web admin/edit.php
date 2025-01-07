<?php
require '../web_user/config.php'; // Pastikan file konfigurasi database terhubung

// Periksa apakah parameter `id` diterima
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Amankan input dengan mengubahnya menjadi integer

    // Ambil data resep dari database
    $sql = "SELECT * FROM resep WHERE id_resep = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resep = $result->fetch_assoc();
    } else {
        echo "Resep tidak ditemukan.";
        exit;
    }
}

// Proses form ketika data disubmit
if (isset($_POST['submit'])) {
    $judulResep = $_POST['judul_resep'];
    $deskripsiResep = $_POST['deskripsi_resep'];
    $bahanResep = $_POST['bahan_resep'];
    $caraResep = $_POST['cara_resep'];

    // Proses unggah gambar baru jika ada
    $gambarResep = $resep['gambar_resep']; // Default gambar yang ada
    if (isset($_FILES['gambar_resep']) && $_FILES['gambar_resep']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../img/"; // Folder untuk menyimpan file gambar
        $fileName = basename($_FILES["gambar_resep"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Pastikan folder 'img/' ada
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Hapus gambar lama jika ada gambar baru
        if (file_exists($gambarResep)) {
            unlink($gambarResep);
        }

        // Pindahkan file gambar baru
        if (move_uploaded_file($_FILES["gambar_resep"]["tmp_name"], $targetFilePath)) {
            $gambarResep = 'img/' . $fileName;
        } else {
            echo "Gagal mengunggah gambar baru.";
            exit;
        }
    }

    // Update data ke database
    $updateSql = "UPDATE resep SET judul_resep = ?, deskripsi_resep = ?, bahan_resep = ?, cara_resep = ?, gambar_resep = ? WHERE id_resep = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssssi", $judulResep, $deskripsiResep, $bahanResep, $caraResep, $gambarResep, $id);

    if ($stmt->execute()) {
        echo "Resep berhasil diperbarui!";
        header("Location: manage resep.php"); // Redirect ke halaman manajemen resep
        exit;
    } else {
        echo "Gagal memperbarui resep.";
    }
}

$conn->close(); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
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

        button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Edit Resep</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="judul_resep">Judul Resep:</label>
        <input type="text" id="judul_resep" name="judul_resep" value="<?php echo htmlspecialchars($resep['judul_resep']); ?>" required>

        <label for="deskripsi_resep">Deskripsi:</label>
        <textarea id="deskripsi_resep" name="deskripsi_resep" required><?php echo htmlspecialchars($resep['deskripsi_resep']); ?></textarea>

        <label for="bahan_resep">Bahan:</label>
        <textarea id="bahan_resep" name="bahan_resep" required><?php echo htmlspecialchars($resep['bahan_resep']); ?></textarea>

        <label for="cara_resep">Cara Memasak:</label>
        <textarea id="cara_resep" name="cara_resep" required><?php echo htmlspecialchars($resep['cara_resep']); ?></textarea>

        <label for="gambar_resep">Gambar:</label>
        <input type="file" id="gambar_resep" name="gambar_resep" accept="image/*">
        <p>Gambar saat ini: <img src="<?php echo $resep['gambar_resep']; ?>" alt="Gambar Resep" width="150"></p>

        <button type="submit" name="submit">Perbarui Resep</button>
    </form>
</body>
</html>
