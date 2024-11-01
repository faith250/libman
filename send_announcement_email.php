<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

function sendAnnouncementEmail($announcement) {
    require 'db.php';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aastha.k@somaiya.edu';
        $mail->Password = 'abnzifspvmftkpbx';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = 'New Announcement from Admin';
        $mail->Body = "<p>Dear Student,</p><p>{$announcement}</p><p>Best regards,<br>Library Management System</p>";

        // Fetch student emails from the database
        $query = $conn->prepare("SELECT email FROM users");
        $query->execute();
        $result = $query->get_result();

        // Send email to each student
        while ($row = $result->fetch_assoc()) {
            $mail->addAddress($row['email']);
            $mail->send();
            $mail->clearAddresses(); // Clear the address for the next student
        }

        return true;
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>
