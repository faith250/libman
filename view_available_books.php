<?php
session_start();
include 'db.php'; 


$query = $conn->prepare("SELECT id, title, author, genre FROM books WHERE available = 1");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Books</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #333;
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
}

table {
    width: 80%; /* Set table width */
    margin: 20px auto; /* Center table */
    border-collapse: collapse; /* Remove space between table cells */
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
    </style>
</head>
<body>
    >
    <nav>
        <ul>
            <li><a href="student_dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="available_books.php">Available Books</a></li>
            <li><a href="my_borrowed_books.php">Issued Books</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    
    <h1>Available Books</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['author']); ?></td>
                <td><?php echo htmlspecialchars($row['genre']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
