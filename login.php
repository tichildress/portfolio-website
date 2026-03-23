<?php
session_start();

// --- CONFIG ---
define('ADMIN_USER', 'tanner');
define('ADMIN_PASS', 'webdev123'); // Change to your secure password

$error = '';

// Redirect if already logged in
if (!empty($_SESSION['logged_in'])) {
    header("Location: admin.php");
    exit;
}

// Handle login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
        $_SESSION['logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link rel="stylesheet" href="styles.css">
<style>
body { display:flex; justify-content:center; align-items:center; min-height:100vh; background:#e6f8ef; }
form { background:#fff; padding:30px; border-radius:12px; box-shadow:0 0 10px rgba(0,0,0,0.1); width:300px; }
input { width:100%; padding:10px; margin:8px 0; border-radius:6px; border:1px solid #ccc; }
button { width:100%; padding:10px; background:#1a3d2f; color:#fff; border:none; border-radius:6px; cursor:pointer; }
button:hover { background:#2e5c47; }
.error { color:red; text-align:center; margin-bottom:10px; }
/* Add below the existing form styles */
.home-button {
    display: block;
    text-align: center;
    margin-top: 12px;
    padding: 10px 0;
    background: #ccc;
    color: #1a3d2f;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.2s;
}
.home-button:hover {
    background: #b3b3b3;
}
</style>
</head>
<body>

<form method="POST">
    <h2 style="text-align:center;">Admin Login</h2>
    <?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <a href="index.html" class="home-button">Back to Home</a>
</form>

</body>
</html>
