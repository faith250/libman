<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

// Add Book
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("INSERT INTO books (title, author, quantity) VALUES (?, ?, ?)");
    if ($stmt->execute([$title, $author, $quantity])) {
        // Send email to all students
        $stmt = $pdo->query("SELECT email FROM students");
        $students = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($students as $studentEmail) {
            mail($studentEmail, "New Book Added", "A new book titled '$title' by '$author' has been added.");
        }
        echo "Book added successfully!";
    } else {
        echo "Error adding book!";
    }
}
?>

<!-- HTML Form -->
<form method="POST">
    <input type="text" name="title" required>
    <input type="text" name="author" required>
    <input type="number" name="quantity" required>
    <button type="submit">Add Book</button>
</form>
