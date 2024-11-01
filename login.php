<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($role == 'student') {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
        $stmt->execute([$email]);
        $student = $stmt->fetch();

        if ($student && password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            header("Location: student/profile.php");
            exit;
        } else {
            echo "Invalid login credentials!";
        }
    } else if ($role == 'admin') {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: admin/dashboard.php");
            exit;
        } else {
            echo "Invalid login credentials!";
        }
    }
}
?>

<!-- HTML Form -->
<form method="POST">
    <select name="role">
        <option value="student">Student</option>
        <option value="admin">Admin</option>
    </select>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
