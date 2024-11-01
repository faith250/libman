<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}

// Check if student_id is provided
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'student'");
    $stmt->bind_param("i", $student_id);
    
    if ($stmt->execute()) {
        header("Location: view_students.php?message=Student deleted successfully");
        exit();
    } else {
        echo "Error deleting student: " . $stmt->error;
    }
} else {
    echo "No student ID provided.";
}
?>
