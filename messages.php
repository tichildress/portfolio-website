<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

$messagesDir = __DIR__ . '/messages';

// Handle deletion
if (isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']);
    $path = $messagesDir . '/' . $fileToDelete;
    if (file_exists($path)) {
        unlink($path);
    }
    header("Location: messages.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Messages</title>
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
    margin-bottom: 30px;
}

header h1 {
    margin: 0;
}

a.button {
    background: #1a3d2f;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.2s;
    display: inline-block;
}

a.button:hover {
    background: #2e5c47;
}

.messages-container {
    width: 100%;
    max-width: 600px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.message {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.message-header strong {
    font-size: 14px;
}

.message pre {
    background: #f9f9f9;
    padding: 12px;
    border-radius: 8px;
    overflow-x: auto;
    font-size: 14px;
    line-height: 1.5;
}
</style>
</head>
<body>

<header>
    <h1>Messages</h1>
    <div>
        <a href="admin.php" class="button">Dashboard</a>
        <a href="logout.php" class="button">Logout</a>
    </div>
</header>

<div class="messages-container">
<?php
if (!is_dir($messagesDir)) {
    echo "<p>No messages directory found.</p>";
} else {
    $files = array_diff(scandir($messagesDir, SCANDIR_SORT_DESCENDING), ['.', '..']);
    if (empty($files)) {
        echo "<p>No messages found.</p>";
    } else {
        foreach ($files as $file) {
            $content = htmlspecialchars(file_get_contents($messagesDir . '/' . $file));
            echo "
            <div class='message'>
                <div class='message-header'>
                    <strong>$file</strong>
                    <a href='?delete=" . urlencode($file) . "' class='button' onclick='return confirm(\"Delete this message?\");'>Delete</a>
                </div>
                <pre>$content</pre>
            </div>";
        }
    }
}
?>
</div>

</body>
</html>
