<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar_student.php';

// Query to fetch available books
$query = $conn->prepare("SELECT id, title, author, genre FROM books WHERE available = 1");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Available Books</title>
</head>
<body>
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
