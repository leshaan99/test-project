<?php
include '../inc/env.php';
include_once '../inc/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/plugins/PHPMailer/src/Exception.php';
require '../assets/plugins/PHPMailer/src/PHPMailer.php';
require '../assets/plugins/PHPMailer/src/SMTP.php';

function feedback($email)
{
    $result = array(
        'success' => false,
        'message' => null,
        'errors' => null,
    );

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


        if ('info@newwings.com' !== $email) {
            // Email content
            $subject = 'Thank You for Uploading Your Document';
            $name = htmlspecialchars($_SESSION['user_name'] ?? 'User');
            $message = "
                <p>Dear $name,</p>
                <p>Thank you for uploading your document to NewWingsUK. We have successfully received it and will review it shortly.</p>
                <p>If any further action is needed, our team will get in touch with you.</p>
                <p>Best regards,<br>Team NewWingsUK</p>
            ";
        }else {
            // Email content for testing
            $subject = 'Document Upload Notification';
            $name = htmlspecialchars($_SESSION['user_name'] ?? 'User');
            $message = "
                <p> $name has successfully uploaded a document to the NewWingsUK platform.</p>
                <p>Best regards,<br>Team NewWingsUK</p>
            ";
        }


        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = "smtp.titan.email";
            $mail->Port = 587;
            $mail->Username = "info@tenxanalytix.com";
            $mail->Password = "Tenx@2024";
            $mail->setFrom("info@tenxanalytix.com", 'NewWingsUK Team');

            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            if ($mail->send()) {
                $result['success'] = true;
                $result['message'] = "Thank-you email sent successfully.";
            } else {
                $result['errors'] = $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            $result['errors'] = "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $result['errors'] = 'Invalid email address.';
    }

    return $result;
}
