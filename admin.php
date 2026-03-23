<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="styles.css">
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    color: #1a3d2f;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

header {
    width: 100%;
    max-width: 600px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

header h1 {
    margin: 0;
}

a.logout {
    background: #1a3d2f;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
}

a.logout:hover {
    background: #2e5c47;
}

.dashboard {
    width: 100%;
    max-width: 400px;
    background: white;
    border-radius: 12px;
    padding: 40px 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 20px; /* vertical spacing between buttons */
}

.dashboard a.button {
    display: block;
    width: 100%;
    padding: 12px 0;
    background: #1a3d2f;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.2s;
}

.dashboard a.button:hover {
    background: #2e5c47;
}
</style>
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <a href="logout.php" class="logout">Logout</a>
</header>

<div class="dashboard">
    <h2>Welcome, Tanner</h2>
    <a href="messages.php" class="button">View Messages</a>
    <a href="#" class="button">Another Action</a> <!-- Example for future buttons -->
    <a href="#" class="button">Settings</a>
</div>

</body>
</html>
