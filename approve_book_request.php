<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar.php';

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect if not logged in or not an admin
    exit();
}

// Get data from the POST request
$requestId = $_POST['request_id'];
$userId = $_POST['user_id'];
$bookTitle = $_POST['title'];
$bookAuthor = $_POST['author'];
$bookGenre = $_POST['genre'];

// Insert the book into the books table
$insertQuery = $conn->prepare("INSERT INTO books (title, author, genre) VALUES (?, ?, ?)");
$insertQuery->bind_param("sss", $bookTitle, $bookAuthor, $bookGenre);

if ($insertQuery->execute()) {
    // Prepare the notification message
    $notificationMessage = "The book '$bookTitle' is now available for you!";

    // Insert the notification into the notifications table
    $notifyQuery = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
    $notifyQuery->bind_param("is", $userId, $notificationMessage);
    $notifyQuery->execute();

    // Delete the request from the book_requests table
    $deleteQuery = $conn->prepare("DELETE FROM book_requests WHERE id = ?");
    $deleteQuery->bind_param("i", $requestId);
    $deleteQuery->execute();

    // Redirect back to the view book requests page
    header("Location: view_book_requests.php?success=1");
    exit();
} else {
    echo "Error inserting book: " . $conn->error;
}
?>
