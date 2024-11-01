<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: student_login.php");
    exit();
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];
    $borrow_date = date('Y-m-d');

    // Check book availability
    $bookQuery = $conn->prepare("SELECT available FROM books WHERE id = ?");
    $bookQuery->bind_param("i", $book_id);
    $bookQuery->execute();
    $bookResult = $bookQuery->get_result();
    $book = $bookResult->fetch_assoc();

    if ($book && $book['available'] > 0) {
        // Insert borrow record
        $borrowQuery = $conn->prepare("INSERT INTO borrow (user_id, book_id, borrow_date) VALUES (?, ?, ?)");
        $borrowQuery->bind_param("iis", $user_id, $book_id, $borrow_date);

        if ($borrowQuery->execute()) {
            // Update book availability
            $updateQuery = $conn->prepare("UPDATE books SET available = available - 1 WHERE id = ?");
            $updateQuery->bind_param("i", $book_id);
            $updateQuery->execute();
            echo "Book borrowed successfully!";
        } else {
            echo "Error borrowing book: " . $borrowQuery->error;
        }
    } else {
        echo "Book not available!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Borrow Book</title></head>
<body>
    <h1>Borrow a Book</h1>
    <form method="post">
        Book ID: <input type="number" name="book_id" required><br>
        <button type="submit">Borrow</button>
    </form>
</body>
</html>
