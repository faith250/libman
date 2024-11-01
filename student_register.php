<?php
session_start();
include 'db.php'; // Ensure db.php path is correct

$role = 'student'; // Set role explicitly as 'student'

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $roll = $_POST['roll'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new student into the database
    $query = $conn->prepare("INSERT INTO users (username, password, role, first_name, last_name, roll, email, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssssss", $username, $hashed_password, $role, $first_name, $last_name, $roll, $email, $contact);

    if ($query->execute()) {
        echo "Student registration successful! You can now <a href='student_login.php'>login</a>.";
    } else {
        echo "Error: " . $query->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>
    <h1>Student Registration</h1>
    <form method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required><br>
        
        <label for="roll">Roll No:</label>
        <input type="text" name="roll" id="roll" required><br>
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        
        <label for="contact">Phone No:</label>
        <input type="text" name="contact" id="contact" required><br>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>
