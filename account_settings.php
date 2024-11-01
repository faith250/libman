<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect if not logged in
    exit();
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newFirstName = $_POST['first_name'];
    $newLastName = $_POST['last_name'];
    $newRoll = $_POST['roll'];
    $newEmail = $_POST['email'];
    $newContact = $_POST['contact'];

    // Update user information
    $query = $conn->prepare("UPDATE users SET username = ?, password = ?, first_name = ?, last_name = ?, roll = ?, email = ?, contact = ? WHERE id = ?");
    $query->bind_param("sssssisi", $newUsername, $newPassword, $newFirstName, $newLastName, $newRoll, $newEmail, $newContact, $userId);
    
    if ($query->execute()) {
        echo "Account settings updated successfully!";
    } else {
        echo "Error updating account: " . $conn->error;
    }
}

// Query to get current user information
$query = $conn->prepare("SELECT id, username, first_name, last_name, roll, email, contact FROM users WHERE id = ?");
$query->bind_param("i", $userId);
$query->execute();
$userResult = $query->get_result();
$user = $userResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Includes padding in width calculation */
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #4cae4c; /* Darker shade on hover */
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none; /* Removes underline */
        }
        .back-link:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <h1>Account Settings</h1>
    <form method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        
        <label for="roll">Roll No:</label>
        <input type="text" name="roll" value="<?php echo htmlspecialchars($user['roll']); ?>" required>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        
        <label for="contact">Phone No:</label>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>

        <label for="password">New Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Update</button>
    </form>
    <a class="back-link" href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
