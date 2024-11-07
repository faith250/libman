<?php
session_start();
include 'navbar_admin.php';
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}


if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'student'");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit();
    }
} else {
    echo "No student ID provided.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email']; 

    $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $username, $email, $student_id);
    
    if ($update_stmt->execute()) {
        header("Location: view_students.php?message=Student updated successfully");
        exit();
    } else {
        echo "Error updating student: " . $update_stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($student['username']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required><br>

        

        <input type="submit" value="Update Student">
    </form>
    <a href="view_students.php">Cancel</a>
</body>
</html>
