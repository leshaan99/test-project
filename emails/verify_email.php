<?php
include_once '../inc/sys.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/plugins/PHPMailer/src/Exception.php';
require '../assets/plugins/PHPMailer/src/PHPMailer.php';
require '../assets/plugins/PHPMailer/src/SMTP.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate a unique verification code.
        $verification_code = bin2hex(random_bytes(16));

        // Store the verification code in the session
        $_SESSION['email_verification_code'] = $verification_code;
        $_SESSION['email_to_verify'] = $email;

        // The subject of the email.
        $subject = 'Verify your email address';

        // The message body of the email.
        $message = 'Please use the following code to verify your email address: ' . $verification_code;

        $mail = new PHPMailer(true);

        try {

            $mailadmin = new PHPMailer();
            $mailadmin->IsSmtp();
            $mailadmin->SMTPDebug = 0;
            $mailadmin->SMTPAuth = true;
            $mailadmin->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];                   // Use 'tls' for Titan Email
            $mailadmin->Host =  $_ENV['MAIL_HOST'];            // Titan Email SMTP server
            $mailadmin->Port = (int)$_ENV['MAIL_PORT'];                           // Use port 587 for TLS
            $mailadmin->IsHTML(true);

            $mailadmin->Username = $_ENV['MAIL_USERNAME'];
            $mailadmin->Password = $_ENV['MAIL_PASSWORD'];
            $mailadmin->SetFrom($_ENV['MAIL_FROM_ADDRESS']);

            $mailadmin->Subject = $subject;
            $mailadmin->Body = $message;
            // $mailadmin->addAttachment('../../attachments/Performance and Evaluation Service (PES) Combinations.pdf');  
            $mailadmin->AddAddress($email);
            

            if (!$mailadmin->Send()) {
                echo json_encode(['success' => false, 'message' => $mailadmin->ErrorInfo]);
               
            } else {              
                echo json_encode(['success' => true, 'message' =>  "Verification code Sent"]);
                

            }
        } catch (Exception $e) {            
            echo json_encode(['success' => false, 'message' =>  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid Access']);
}

?>