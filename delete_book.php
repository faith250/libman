<?php
session_start();
include 'db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}

// Check if book_id is provided
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    
    $query = $conn->prepare("DELETE FROM books WHERE id = ?");
    $query->bind_param("i", $book_id); 

    
    if ($query->execute()) {
        
        header("Location: view_books.php?message=Book deleted successfully");
        exit();
    } else {
        
        echo "Error deleting book: " . $query->error;
    }
} else {
    
    echo "No book ID provided.";
}
?>
