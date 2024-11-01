<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch student data
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$_SESSION['student_id']]);
$student = $stmt->fetch();
?>

<h1>Welcome, <?= $student['name'] ?></h1>
<!-- Profile info can be displayed here -->
