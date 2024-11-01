<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar.php';

// Check if the user is logged in as a student
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .notification-box {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px; /* Space below the notification box */
        }

        .options-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Two columns */
            gap: 20px; /* Space between boxes */
            max-width: 600px;
            margin: 0 auto; /* Center the grid */
        }

        .option-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center text inside boxes */
            transition: transform 0.3s; /* Animation effect */
        }

        .option-box:hover {
            transform: translateY(-5px); /* Lift effect on hover */
        }

        a {
            text-decoration: none;
            color: #007bff; /* Link color */
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline; /* Underline links on hover */
        }

        a.logout {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            color: #ff0000;
            font-weight: bold;
        }

        a.logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Student Dashboard</h1>

    <div class="notification-box">
        <h2>Notifications</h2>
        <ul>
            <?php while ($notification = $notificationsResult->fetch_assoc()): ?>
                <li>
                    <?php echo htmlspecialchars($notification['message']); ?> 
                    <small>(<?php echo htmlspecialchars($notification['created_at']); ?>)</small>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="options-container">
        <div class="option-box">
            <a href="view_available_books.php">View Available Books</a>
        </div>
        <div class="option-box">
            <a href="view_borrowed_books.php">My Borrowed Books</a>
        </div>
        <div class="option-box">
            <a href="account_settings.php">Account Settings</a>
        </div>
        <div class="option-box">
            <a href="request_book.php">Request a New Book</a>
        </div>
    </div>

    <a href="logout.php" class="logout">Logout</a>
</body>
</html>
