<?php

$switchEnv = 'local';

$username = "root";
    $password = "";
    $database = "resep_db";
    $host = "localhost";


$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}