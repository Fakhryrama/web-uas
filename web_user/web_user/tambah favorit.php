<?php 
require 'config.php';
?>

<?php
if (isset($_GET['id_user']) && isset($_GET['id_resep'])) {
    $id_user = intval($_GET['id_user']);
    $id_resep = intval($_GET['id_resep']);

    // Validasi input
    if ($id_user > 0 && $id_resep > 0) {
        // Query untuk mendapatkan informasi resep
        $result = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep = '$id_resep'");
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $resep_favorit = mysqli_real_escape_string($conn, $row['judul_resep']);

            // Query untuk mengupdate informasi pengguna
            $query = "UPDATE user SET resep_favorit = '$resep_favorit' WHERE id_user = $id_user";
            if ($conn->query($query) === TRUE) {
                echo '<script>
                alert("Resep berhasil ditambahkan");
                window.location.href = "favorit.php";
                </script>';
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Resep tidak ditemukan.";
        }
    } else {
        echo "ID User atau ID Resep tidak valid.";
    }
} else {
    echo "Data tidak lengkap. Pastikan ID User dan ID Resep dikirim.";
}

$conn->close();
?>
