<?php
require '../web_user/config.php'; // Pastikan file konfigurasi database terhubung

// Periksa apakah parameter `id` diterima
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Amankan input dengan mengubahnya menjadi integer

    // Query untuk mengambil informasi gambar sebelum menghapus
    $sql = "SELECT gambar_resep FROM resep WHERE id_resep = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gambarResep = $row['gambar_resep'];

        // Hapus gambar jika file ada
        if (file_exists($gambarResep)) {
            unlink($gambarResep); // Menghapus file gambar
        }

        // Query untuk menghapus data dari database
        $deleteSql = "DELETE FROM resep WHERE id_resep = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            echo "Resep berhasil dihapus.";
            header('Location: manage resep.php');
            exit();
        } else {
            echo "Gagal menghapus resep.";
        }

        $deleteStmt->close();
    } else {
        echo "Resep tidak ditemukan.";
    }

    $stmt->close();
} else {
    echo "ID resep tidak diberikan.";
}

$conn->close(); // Tutup koneksi database
?>
