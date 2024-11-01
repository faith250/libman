<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar_student.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect if not logged in
    exit();
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Query to fetch borrowed books for the logged-in user
$query = $conn->prepare("SELECT br.id, b.title, br.borrow_date, br.return_date 
                          FROM borrowed_books br 
                          JOIN books b ON br.book_id = b.id 
                          WHERE br.user_id = ?");

if (!$query) {
    // If the prepare fails, output the error
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
    <br>
    <a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
