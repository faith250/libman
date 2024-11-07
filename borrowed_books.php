<?php
include 'navbar.php';
session_start();
include 'db.php';


$query = $conn->prepare("SELECT b.id, b.title, b.author, br.user_id, br.borrow_date, br.return_date FROM borrowed_books br JOIN books b ON br.book_id = b.id");

if (!$query) {
    die("Query preparation failed: " . $conn->error);
}

$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrowed Books</title>
</head>
<body>
    <h1>Borrowed Books</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>User ID</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No books have been borrowed yet.</p>
    <?php endif; ?>

    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
