<?php
require '../web_user/config.php';
session_start();

if(!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}


$recipeCountQuery = "SELECT COUNT(*) as total_recipes FROM resep";
$recipeCountResult = $conn->query($recipeCountQuery);
$totalRecipes = $recipeCountResult->fetch_assoc()['total_recipes'];

$userCountQuery = "SELECT COUNT(*) as total_users FROM user";
$userCountResult = $conn->query($userCountQuery);
$totalUsers = $userCountResult->fetch_assoc()['total_users'];
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
            flex-direction: row; /* Ensure sidebar and content are horizontally aligned */
            margin: 0;
            height: 100vh; /* Ensure full page height */
        }

        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: #fff;
            height: 100vh; /* Ensure full height for sidebar */
            padding: 20px;
            box-sizing: border-box;
            flex-shrink: 0; /* Prevent sidebar from shrinking */
        }

        .content {
            padding: 20px;
            flex-grow: 1; /* Make content flexible to fill remaining space */
            overflow-y: auto; /* Add scroll if content is too long */
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_resep.php">Manage Recipes</a></li>
            <li><a href="manage_user.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Here you can manage recipes, users, and other settings.</p>

        <div class="dashboard-grid">
            <div class="card">
                <div class="icon">📋</div>
                <h3>Total Recipes</h3>
                <p id="totalRecipes"><?= $totalRecipes ?></p>
            </div>
            <div class="card">
                <div class="icon">👥</div>
                <h3>Total Users</h3>
                <p id="totalUsers"><?= $totalUsers ?></p>
            </div>
            <div class="card">
                <div class="icon">⚙️</div>
                <h3>Manage Recipes</h3>
                <p><a href="manage_resep.php">Manage Settings</a></p>
            </div>
        </div>
    </div>
</body>
</html>