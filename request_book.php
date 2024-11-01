<?php
session_start();
include 'db.php'; // Include your database connection
include 'navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect if not logged in
    exit();
}

// Handle book request submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookTitle = $_POST['title'];
    $bookAuthor = $_POST['author'];
    $bookGenre = $_POST['genre'];

    // Insert book request into the database
    $query = $conn->prepare("INSERT INTO book_requests (user_id, title, author, genre) VALUES (?, ?, ?, ?)");
    $userId = $_SESSION['user_id'];
    $query->bind_param("isss", $userId, $bookTitle, $bookAuthor, $bookGenre);
    
    if ($query->execute()) {
        echo "<p class='success-message'>Book request submitted successfully!</p>";
    } else {
        echo "<p class='error-message'>Error submitting request: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a New Book</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Form container */
        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            background-color: #fff;
            outline: none;
        }

        /* Button styling */
        button[type="submit"] {
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Back link styling */
        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Message styling */
        .success-message {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .error-message {
            color: #dc3545;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Request a New Book</h1>
    <form method="post">
        <label for="title">Book Title:</label>
        <input type="text" name="title" required>

        <label for="author">Author:</label>
        <input type="text" name="author" required>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" required>

        <button type="submit">Submit Request</button>
    </form>
    <a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
