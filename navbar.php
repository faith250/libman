<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<nav>
    <ul>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
            <li><a href="view_book_requests.php">View Book Requests</a></li>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'student'): ?>
            <li><a href="student_dashboard.php">Student Dashboard</a></li>
            <li><a href="view_available_books.php">View Available Books</a></li>
            <li><a href="view_borrowed_books.php">My Borrowed Books</a></li>
            <li><a href="account_settings.php">Account Settings</a></li>
            <li><a href="request_book.php">Request a New Book</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
</body>
</html>
