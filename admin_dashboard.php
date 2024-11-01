<?php
include 'navbar_admin.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light background color */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        h1 {
            text-align: center; /* Center the heading */
            color: #333; /* Darker color for the header */
            margin-top: 20px; /* Space above the heading */
        }

        p {
            text-align: center; /* Center the paragraph */
            margin: 10px 0; /* Space above and below the paragraph */
            font-size: 18px; /* Slightly larger font size */
        }

        ul {
            list-style: none; /* Remove bullet points */
            padding: 0; /* Remove default padding */
            text-align: center; /* Center align the list */
            margin-top: 30px; /* Added space above the list */
        }

        ul li {
            margin: 15px 0; /* Space between list items */
        }

        ul li a {
            text-decoration: none; /* Remove underline from links */
            color: #007BFF; /* Link color */
            padding: 12px 25px; /* Increased padding around the link */
            border: 1px solid #007BFF; /* Border around the link */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for hover */
        }

        ul li a:hover {
            background-color: #007BFF; /* Change background on hover */
            color: white; /* Change text color on hover */
        }

        .logout {
            display: block; /* Make the logout link a block */
            text-align: center; /* Center the logout link */
            margin-top: 40px; /* Increased margin above */
            font-weight: bold; /* Bold text */
            color: #FF0000; /* Red color for emphasis */
            font-size: 18px; /* Increased font size for visibility */
        }
    </style>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Select an action:</p>

    <ul>
        <li><a href="add_book.php">Add New Book</a></li><br>
        <li><a href="view_books.php">View/Edit/Delete Books</a></li><br>
        <li><a href="view_students.php">View Students</a></li><br>
        <li><a href="borrowed_books.php">View Borrowed Books</a></li><br>
        <li><a href="issue_book.php">Issue Book to Student</a></li><br>
        <li><a href="return_book.php">Mark Book as Returned</a></li><br>
        <li><a href="view_book_requests.php">Requested Books</a></li><br>
    </ul>

    <a href="logout.php" class="logout">Logout</a>
</body>
</html>
