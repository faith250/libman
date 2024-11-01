<?php
session_start();
include 'db.php'; // Ensure db.php path is correct
$role = 'admin';
include 'navbar.php';

$role = 'admin'; // Set role explicitly as 'admin'

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

    // Insert new admin into the database
    $query = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $query->bind_param("sss", $username, $hashed_password, $role);

    if ($query->execute()) {
        echo "Admin registration successful! You can now <a href='admin_login.php'>login</a>.";
    } else {
        echo "Error: " . $query->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Registration</title>
</head>
<body>
    <h1>Admin Registration</h1>
    <form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
