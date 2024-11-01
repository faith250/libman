<?php
session_start();
include 'db.php'; // Include your database connection

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect if not logged in or not an admin
    exit();
}

// Fetch book requests from the database
$query = $conn->prepare("SELECT br.id, u.id AS user_id, u.username, br.title, br.author, br.genre, br.request_date 
                          FROM book_requests br 
                          JOIN users u ON br.user_id = u.id");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Book Requests</title>
</head>
<body>
    <h1>Book Requests</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Student Username</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Request Date</th>
            <th>Actions</th> <!-- Added Actions column -->
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
            <td><?php echo htmlspecialchars($row['genre']); ?></td>
            <td><?php echo htmlspecialchars($row['request_date']); ?></td>
            <td>
                <form method="post" action="approve_book_request.php" style="display:inline;">
                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
                    <input type="hidden" name="author" value="<?php echo htmlspecialchars($row['author']); ?>">
                    <input type="hidden" name="genre" value="<?php echo htmlspecialchars($row['genre']); ?>">
                    <button type="submit">Approve</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
