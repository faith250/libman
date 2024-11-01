<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar.php';

// Check if the user is logged in as student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: student_login.php"); // Redirect to login if not authenticated
    exit();
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Fetch notifications for the logged-in student
$notifyQuery = $conn->prepare("SELECT message, created_at FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$notifyQuery->bind_param("i", $userId);
$notifyQuery->execute();
$notificationsResult = $notifyQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to the Student Dashboard</h1>
    <p>Select an option:</p>

    <ul>
        <li><a href="view_available_books.php">View Available Books</a></li>
        <li><a href="view_borrowed_books.php">My Borrowed Books</a></li>
        <li><a href="account_settings.php">Account Settings</a></li>
        <li><a href="request_book.php">Request a New Book</a></li>
    </ul>

    <h2>Notifications</h2>
    <ul>
        <?php while ($notification = $notificationsResult->fetch_assoc()): ?>
            <li>
                <?php echo htmlspecialchars($notification['message']); ?> 
                <small>(<?php echo htmlspecialchars($notification['created_at']); ?>)</small>
            </li>
        <?php endwhile; ?>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
