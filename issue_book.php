<?php

session_start();
include 'db.php';
include 'navbar.php';

$query_students = $conn->prepare("SELECT id, username FROM users WHERE role = 'student'");
$query_students->execute();
$result_students = $query_students->get_result();


$query_books = $conn->prepare("SELECT id, title FROM books WHERE available > 0");
$query_books->execute();
$result_books = $query_books->get_result();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];

    
    $borrow_date = date('Y-m-d');
    $return_date = null; 
    $issue_query = $conn->prepare("INSERT INTO borrowed_books (user_id, book_id, borrow_date, return_date) VALUES (?, ?, ?, ?)");
    $issue_query->bind_param("iiss", $user_id, $book_id, $borrow_date, $return_date);
    
    if ($issue_query->execute()) {
        
        $update_query = $conn->prepare("UPDATE books SET available = available - 1 WHERE id = ?");
        $update_query->bind_param("i", $book_id);
        $update_query->execute();

        echo "Book issued successfully!";
    } else {
        echo "Error issuing book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Issue Book</title>
</head>
<body>
    <h1>Issue Book to Student</h1>
    <form method="post">
        <label for="user_id">Select Student:</label>
        <select name="user_id" required>
            <?php while ($student = $result_students->fetch_assoc()): ?>
                <option value="<?php echo $student['id']; ?>"><?php echo htmlspecialchars($student['username']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="book_id">Select Book:</label>
        <select name="book_id" required>
            <?php while ($book = $result_books->fetch_assoc()): ?>
                <option value="<?php echo $book['id']; ?>"><?php echo htmlspecialchars($book['title']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Issue Book</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
