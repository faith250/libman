<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    require 'db.php';
    require 'send_announcement_email.php';

    $announcement = $_POST['announcement'];

    if (sendAnnouncementEmail($announcement)) {
        echo "Announcement sent to all students successfully!";
    } else {
        echo "Failed to send announcement.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Make an Announcement</title>
</head>
<body>
    <h1>Make an Announcement</h1>
    <form action="announcement.php" method="POST">
        <label for="announcement">Announcement:</label><br>
        <textarea name="announcement" id="announcement" rows="5" cols="50" required></textarea><br><br>
        <button type="submit">Send Announcement</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
