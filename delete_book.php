<?php
session_start();
include 'db.php';

// Check if the user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect if not logged in or not an admin
    exit();
}

// Check if book_id is provided
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    // Prepare the delete statement
    $query = $conn->prepare("DELETE FROM books WHERE id = ?");
    $query->bind_param("i", $book_id); // Bind the book ID as an integer

    // Execute the query
    if ($query->execute()) {
        // Redirect back to the books page with a success message
        header("Location: view_books.php?message=Book deleted successfully");
        exit();
    } else {
        // Handle error
        echo "Error deleting book: " . $query->error;
    }
} else {
    // Handle case where book_id is not set
    echo "No book ID provided.";
}
?>
