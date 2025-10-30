<?php
include '../inc/env.php';
include_once '../inc/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/plugins/PHPMailer/src/Exception.php';
require '../assets/plugins/PHPMailer/src/PHPMailer.php';
require '../assets/plugins/PHPMailer/src/SMTP.php';

function send_thank($email) {
    $result = array(
        'success' => false,
        'message' => null,
        'errors' => null,
    );

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Email content
        $subject = 'Thank You for Reaching Out!';
        $message = '
            <p>Dear User,</p>
            <p>Thank you for contacting us. We have received your message and will get back to you as soon as possible.</p>
            <p>Best regards,<br>Team NewWingsUK</p>
        ';

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
?>