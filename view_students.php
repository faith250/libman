<?php
session_start();
include 'navbar_admin.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

// Fetching all students
$result = $conn->query("SELECT * FROM users WHERE role='student'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Students</title>
</head>
<body>
    <h1>View Students</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <?php while ($student = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($student['id']); ?></td>
            <td><?php echo htmlspecialchars($student['username']); ?></td>
            <td>
                <a href="view_student.php?id=<?php echo $student['id']; ?>">View</a> | 
                <a href="edit_student.php?id=<?php echo $student['id']; ?>">Edit</a> | 
                <a href="delete_student.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
