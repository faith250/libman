<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <ul>
        <li><a href="student_dashboard.php">Student Dashboard</a></li>
        <li><a href="view_available_books.php">View Available Books</a></li>
        <li><a href="view_borrowed_books.php">My Borrowed Books</a></li>
        <li><a href="account_settings.php">Account Settings</a></li>
        <li><a href="request_book.php">Request a New Book</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
