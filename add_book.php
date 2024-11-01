<?php
include 'navbar.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $available = $_POST['available'];

    // Prepare the SQL statement
    $query = $conn->prepare("INSERT INTO books (title, author, genre, available) VALUES (?, ?, ?, ?)");

    if (!$query) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind the parameters and execute
    $query->bind_param("sssi", $title, $author, $genre, $available);
    if ($query->execute()) {
        echo "Book added successfully!";
    } else {
        echo "Error adding book: (" . $query->errno . ") " . $query->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Add Book</title></head>
<body>
    <h1>Add a New Book</h1>
    <form method="post">
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        Genre: <input type="text" name="genre" required><br>
        Available Copies: <input type="number" name="available" required><br>
        <button type="submit">Add Book</button>
    </form>
</body>
</html>
