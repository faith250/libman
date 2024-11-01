<?php
session_start();
include 'db.php';
include 'navbar_admin.php';

// Fetch all books from the database
$query = $conn->prepare("SELECT * FROM books");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light background color */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add some padding */
        }

        h1 {
            text-align: center; /* Center the heading */
            color: #333; /* Darker color for the header */
            margin-bottom: 20px; /* Space below the heading */
        }

        table {
            width: 100%; /* Full width */
            border-collapse: collapse; /* Remove spacing between cells */
            margin-bottom: 20px; /* Space below the table */
        }

        th, td {
            padding: 10px; /* Padding for cells */
            text-align: left; /* Left align text */
            border: 1px solid #ddd; /* Border for cells */
        }

        th {
            background-color: #007BFF; /* Header background color */
            color: white; /* Header text color */
        }

        tr:hover {
            background-color: #f1f1f1; /* Row hover effect */
        }

        a {
            color: #007BFF; /* Link color */
            text-decoration: none; /* Remove underline */
        }

        a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <h1>Books Available in the Library</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Available</th>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <th>Update</th>
                        <th>Delete</th>
                    <?php elseif ($_SESSION['role'] === 'student'): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['genre']); ?></td>
                        <td><?php echo htmlspecialchars($row['available']); ?></td>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <td>
                                <a href="update_book.php?id=<?php echo $row['id']; ?>">Update</a>
                            </td>
                            <td>
                                <form action="delete_book.php" method="post" style="margin: 0;">
                                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                </form>
                            </td>
                        <?php elseif ($_SESSION['role'] === 'student'): ?>
                            <td>
                                <form action="borrow_book.php" method="post" style="margin: 0;">
                                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit">Borrow</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No books available.</p>
    <?php endif; ?>

    <br>
    <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>">Back to Dashboard</a>
</body>
</html>
