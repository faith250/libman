<?php
session_start();
include 'db.php'; 
include 'navbar_student.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}


$userId = $_SESSION['user_id'];


$query = $conn->prepare("SELECT br.id, b.title, br.borrow_date, br.return_date 
                          FROM borrowed_books br 
                          JOIN books b ON br.book_id = b.id 
                          WHERE br.user_id = ?");

if (!$query) {
    
    die("Query preparation failed: " . $conn->error);
}

$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Borrowed Books</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Set a clean font */
            background-color: #f8f9fa; /* Light background for contrast */
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #007bff; /* Bootstrap primary color */
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline; /* Display items in a single line */
            margin-right: 20px; /* Space between items */
        }

        nav ul li a {
            color: white; /* Text color */
            text-decoration: none; /* Remove underline from links */
            padding: 8px 16px; /* Padding around links */
        }

        nav ul li a:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-radius: 4px; /* Rounded corners */
        }

        h1 {
            text-align: center; /* Center-align the heading */
            margin-top: 20px; /* Space above heading */
            color: #333; /* Darker text color */
        }

        table {
            width: 80%; /* Set table width */
            margin: 20px auto; /* Center table */
            border-collapse: collapse; /* Remove space between table cells */
            background-color: white; /* White background for the table */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); /* Subtle shadow for elevation */
        }

        table, th, td {
            border: 1px solid #ccc; /* Table borders */
        }

        th, td {
            padding: 10px; /* Padding in table cells */
            text-align: left; /* Align text to the left */
        }

        th {
            background-color: #f2f2f2; /* Light grey background for table headers */
        }

        a.back-link {
            display: block; /* Block display to center the link */
            text-align: center; /* Center the text */
            margin: 20px auto; /* Space above and below */
            text-decoration: none; /* Remove underline */
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text */
        }

        a.back-link:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    

    <h1>My Borrowed Books</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Book Title</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                <td><?php echo htmlspecialchars($row['return_date']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="student_dashboard.php" class="back-link">Back to Dashboard</a>
</body>
</html>
