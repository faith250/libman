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

    // Update user information
    $query = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $query->bind_param("ssi", $newUsername, $newPassword, $userId);
    
    if ($query->execute()) {
        echo "Account settings updated successfully!";
    } else {
        echo "Error updating account: " . $conn->error;
    }
}

// Query to get current user information
$query = $conn->prepare("SELECT username FROM users WHERE id = ?");
$query->bind_param("i", $userId);
$query->execute();
$userResult = $query->get_result();
$user = $userResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Settings</title>
</head>
<body>
    <h1>Account Settings</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
        <label for="password">New Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Update</button>
    </form>
    <br>
    <a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
