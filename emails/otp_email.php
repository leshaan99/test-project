<?php
include_once '../inc/env.php';
include_once '../inc/session.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/plugins/PHPMailer/src/Exception.php';
require '../assets/plugins/PHPMailer/src/PHPMailer.php';
require '../assets/plugins/PHPMailer/src/SMTP.php';

 
function send_otp($email){ 

    $result = array(
        'success' => false,
        'message'=>null,
        'errors' => null,
    );

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate a unique verification code.
        $verification_code = random_int(1000, 9999);

        // Store the verification code in the session
        $_SESSION['email_verification_code'] = $verification_code;
        $_SESSION['email_to_verify'] = $email;

        // The subject of the email.
        $subject = 'Verify your email address';

        // The message body of the email.
        $message = 'Please use the following code to verify your email address: ' . $_SESSION['otp'];

        $mail = new PHPMailer(true);

        try {

            $mailadmin = new PHPMailer();
            $mailadmin->IsSmtp();
            $mailadmin->SMTPDebug = 0;
            $mailadmin->SMTPAuth = true;
            $mailadmin->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];                   // Use 'tls' for Titan Email
            $mailadmin->Host =  $_ENV['MAIL_HOST'];            // Titan Email SMTP server
            $mailadmin->Port = (int)$_ENV['MAIL_PORT'];                           // Use port 587 /465 for TLS
            $mailadmin->IsHTML(true);

            $mailadmin->Username = $_ENV['MAIL_USERNAME'];
            $mailadmin->Password = $_ENV['MAIL_PASSWORD'];
            $mailadmin->SetFrom($_ENV['MAIL_FROM_ADDRESS']);

            $mailadmin->Subject = $subject;
            $mailadmin->Body = $message;
            // $mailadmin->addAttachment('../../attachments/Performance and Evaluation Service (PES) Combinations.pdf');  
            $mailadmin->AddAddress($email);
          

            if (!$mailadmin->Send()) {
                $result = array(
                    'success' => false,
                    'message'=>null,
                    'errors' => $mailadmin->ErrorInfo,
                );

               
               
            } else {   
                $result = array(
                    'success' => true,
                    'message'=>"Verification code Sent",
                    'errors' => null,
                );    

            }
        } catch (Exception $e) {  
            $result = array(
                'success' => false,
                'message'=>null,
                'errors' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}",
            );                    
          
        }

    } else {
        $result = array(
            'success' => false,
            'message'=>null,
            'errors' => 'Invalid email address',
        );     
       
    }

    return $result;

}
?>