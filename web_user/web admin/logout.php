<?php
session_start();
session_destroy(); // Hapus semua data

setcookie('admin', '', time() - 3600, "/");

echo '<script>
alert("Logout berhasil");
</script>';
header('Location: index.php');
exit();
?>