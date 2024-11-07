<?php
session_start();
include 'db.php'; 
include 'navbar.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}


$requestId = $_POST['request_id'];
$userId = $_POST['user_id'];
$bookTitle = $_POST['title'];
$bookAuthor = $_POST['author'];
$bookGenre = $_POST['genre'];


$insertQuery = $conn->prepare("INSERT INTO books (title, author, genre) VALUES (?, ?, ?)");
$insertQuery->bind_param("sss", $bookTitle, $bookAuthor, $bookGenre);

if ($insertQuery->execute()) {
    
    $notificationMessage = "The book '$bookTitle' is now available for you!";

    
    $notifyQuery = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
    $notifyQuery->bind_param("is", $userId, $notificationMessage);
    $notifyQuery->execute();

    
    $deleteQuery = $conn->prepare("DELETE FROM book_requests WHERE id = ?");
    $deleteQuery->bind_param("i", $requestId);
    $deleteQuery->execute();

    
    header("Location: view_book_requests.php?success=1");
    exit();
} else {
    echo "Error inserting book: " . $conn->error;
}
?>
