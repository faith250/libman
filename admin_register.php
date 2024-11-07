<?php
session_start();
include 'db.php'; // Ensure db.php path is correct
include 'navbar.php';

// Set role explicitly as 'admin'
$role = 'admin';

$errors = []; // Array to hold validation errors

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $roll = trim($_POST['roll']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);

    // Validation checks
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required.";
    }

    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required.";
    }

    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } elseif (strlen($username) < 5) {
        $errors['username'] = "Username must be at least 5 characters.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters.";
    }

    if (empty($roll)) {
        $errors['roll'] = "Roll number is required.";
    } elseif (!ctype_digit($roll)) {
        $errors['roll'] = "Roll number must be a number.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($contact)) {
        $errors['contact'] = "Contact number is required.";
    } elseif (!ctype_digit($contact) || strlen($contact) != 10) {
        $errors['contact'] = "Contact number must be a 10-digit number.";
    }

    // Proceed with registration if no errors
    if (empty($errors)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the query
        $query = $conn->prepare("INSERT INTO users (username, password, role, first_name, last_name, roll, email, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssssss", $username, $hashed_password, $role, $first_name, $last_name, $roll, $email, $contact);

        if ($query->execute()) {
            echo "<div class='alert alert-success' role='alert'>Admin registration successful! You can now <a href='admin_login.php'>login</a>.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . htmlspecialchars($query->error) . "</div>";
        }
        $query->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Registration</h1>
        <form method="post" class="border p-4 rounded bg-white shadow">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required value="<?php echo htmlspecialchars($first_name ?? ''); ?>">
                <small class="text-danger"><?php echo $errors['first_name'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required value="<?php echo htmlspecialchars($last_name ?? ''); ?>">
                <small class="text-danger"><?php echo $errors['last_name'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required value="<?php echo htmlspecialchars($username ?? ''); ?>">
                <small class="text-danger"><?php echo $errors['username'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <small class="text-danger"><?php echo $errors['password'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="roll">Roll No:</label>
                <input type="text" name="roll" id="roll" class="form-control" required value="<?php echo htmlspecialchars($roll ?? ''); ?>">
                <small class="text-danger"><?php echo $errors['roll'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
                <small class="text-danger"><?php echo $errors['email'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="contact">Phone No:</label>
                <input type="text" name="contact" id="contact" class="form-control" required value="<?php echo htmlspecialchars($contact ?? ''); ?>">
                <small class="text-danger"><?php echo $errors['contact'] ?? ''; ?></small>
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
