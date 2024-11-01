<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect if not logged in
    exit();
}

// Handle book request submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookTitle = $_POST['title'];
    $bookAuthor = $_POST['author'];
    $bookGenre = $_POST['genre'];

    // Insert book request into the database
    $query = $conn->prepare("INSERT INTO book_requests (user_id, title, author, genre) VALUES (?, ?, ?, ?)");
    $userId = $_SESSION['user_id'];
    $query->bind_param("isss", $userId, $bookTitle, $bookAuthor, $bookGenre);
    
    if ($query->execute()) {
        echo "Book request submitted successfully!";
    } else {
        echo "Error submitting request: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Request a New Book</title>
</head>
<body>
    <h1>Request a New Book</h1>
    <form method="post">
        <label for="title">Book Title:</label>
        <input type="text" name="title" required><br>
        <label for="author">Author:</label>
        <input type="text" name="author" required><br>
        <label for="genre">Genre:</label>
        <input type="text" name="genre" required><br>
        <button type="submit">Submit Request</button>
    </form>
    <br>
    <a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
