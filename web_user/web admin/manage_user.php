<?php 
require 'function.php';
require '../web_user/config.php';
$users = query("SELECT * FROM user");

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Recipe Website</title>
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
            font-weight: 500;
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
            font-weight: 500;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        .content {
            padding: 40px;
            flex-grow: 1;
        }

        .content h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 1.2em;
            margin-bottom: 40px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .card h3 {
            margin-top: 0;
            font-weight: 500;
        }

        .card p {
            font-size: 2em;
            margin: 20px 0;
            font-weight: 700;
        }

        .card a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }

        .card a:hover {
            text-decoration: underline;
        }

        .card .icon {
            font-size: 3em;
            margin-bottom: 20px;
            color: #007bff;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .user-table th, 
        .user-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .user-table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage resep.php">Manage Recipes</a></li>
            <li><a href="manage_user.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Here you can manage recipes, users, and other settings.</p>
        <div class="card">
            <h3>User List</h3>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Id_User</th>
                        <th>Username</th>
                        <th>Resep Favorit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user['id_user'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['resep_favorit'] ?></td>
                        <td>
                            <a href="delete_user.php?id=<?= $user['id_user'] ?>" 
                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>  
</body>