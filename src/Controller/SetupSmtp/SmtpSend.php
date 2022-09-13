<?php

namespace App\Controller\SetupSmtp;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Controller\ContactMailController;

class SmtpSend
{
    /**
     * server Stmp connection , receive data form , check and send .
     * @param Array | $data
     * @return True ou erreur
     */
    public function smtpSend(array $data)
    {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();                                 // Set mailer to use SMTP
            $mail->Mailer = 'smtp';
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';                  // Specify  SMTP servers
            $mail->SMTPAuth = true;                         // Enable SMTP authentication
            $mail->Username = 'blog.php2022@gmail.com';    // SMTP username
            $mail->Password = 'nhdefiebuqjxtwnp';         // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;                          // TCP port to connect to

            // Sender info
            $mail->setFrom($data['email'], $data['name']);
            $mail->addReplyTo($data['email'], $data['name']);

            // Add a recipient
            $mail->addAddress('blog.php2022@gmail.com');

            // Mail subject
            $mail->Subject = 'Formulaire Contact de site Blog-Php';

            // Mail body content
            $bodyContent = $data['message'];
            $mail->Body    = $bodyContent;
            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
