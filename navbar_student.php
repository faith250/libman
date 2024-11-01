<?php
session_start(); // Start the session to access session variables
include 'navbar_student.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Navigation Bar</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file for styling -->
</head>
<body>
<nav>
    <ul>
        <li><a href="student_dashboard.php">Student Dashboard</a></li>
        <li><a href="view_available_books.php">View Available Books</a></li>
        <li><a href="view_borrowed_books.php">My Borrowed Books</a></li>
        <li><a href="account_settings.php">Account Settings</a></li>
        <li><a href="request_book.php">Request a New Book</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
</body>
</html>
