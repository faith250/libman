<?php
session_start();
include 'db.php'; // Database connection file
include 'navbar_admin.php';

$role = 'admin'; // Set role explicitly as 'admin'

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check user credentials
    $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
    $query->bind_param("ss", $username, $role);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $role;
        header("Location: admin_dashboard.php");
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>