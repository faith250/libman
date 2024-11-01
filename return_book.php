<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $borrowedBookId = $_POST['borrowed_book_id']; // ID of the borrowed book to return

    // Prepare the SQL statement to mark the book as returned
    $query = $conn->prepare("DELETE FROM borrowed_books WHERE id = ?");

    if (!$query) {
        die("Query preparation failed: " . $conn->error);
    }

    $query->bind_param("i", $borrowedBookId); // Bind the borrowed book ID
    if ($query->execute()) {
        echo "Book returned successfully!";
    } else {
        echo "Error returning the book: " . $conn->error;
    }
}

// Fetch all borrowed books for the form to select which to return
$booksQuery = $conn->prepare("SELECT br.id, b.title FROM borrowed_books br JOIN books b ON br.book_id = b.id");
if (!$booksQuery) {
    die("Books query preparation failed: " . $conn->error);
}

$booksQuery->execute();
$booksResult = $booksQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Return Book</title>
</head>
<body>
    <h1>Return a Book</h1>

    <form method="post">
        <label for="borrowed_book_id">Select Book to Return:</label>
        <select name="borrowed_book_id" required>
            <?php while ($row = $booksResult->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['id']); ?>">
                    <?php echo htmlspecialchars($row['title']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>
        <button type="submit">Return Book</button>
    </form>

    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
