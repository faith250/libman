<?php
session_start();
include 'db.php'; 
include 'navbar.php';

$role = 'student'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $roll = $_POST['roll'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $query = $conn->prepare("INSERT INTO users (username, password, role, first_name, last_name, roll, email, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssssss", $username, $hashed_password, $role, $first_name, $last_name, $roll, $email, $contact);

    if ($query->execute()) {
        echo "<div class='alert alert-success' role='alert'>Student registration successful! You can now <a href='student_login.php'>login</a>.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . htmlspecialchars($query->error) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Student Registration</h1>
        <form method="post" class="border p-4 rounded bg-white shadow">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="roll">Roll No:</label>
                <input type="text" name="roll" id="roll" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contact">Phone No:</label>
                <input type="text" name="contact" id="contact" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
