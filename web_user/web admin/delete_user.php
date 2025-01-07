<?php
require 'function.php';
require '../web_user/config.php';

$id = $_GET["id"];

if (delete($id) > 0) {
    echo "
        <script>
            alert('User berhasil dihapus!');
            document.location.href = 'manage_user.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'manage_user.php';
        </script>
    ";
}
?>