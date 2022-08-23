<?php

namespace App\Controller\SetupSmtp;
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Controller\ContactMailController;
// Include library files 



class SmtpSend
{
    public function smtpSend($data)
    {
        try {
            // Create an instance; Pass `true` to enable exceptions 
            $mail = new PHPMailer(true);

            // Server settings 
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
            $mail->isSMTP();                            // Set mailer to use SMTP 
            $mail->Mailer = 'smtp';
            $mail->SMTPAuth = TRUE;
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
            $mail->SMTPAuth = true;                     // Enable SMTP authentication 
            $mail->Username = 'blog.php2022@gmail.com';       // SMTP username 
            $mail->Password = 'uryzohcnptxhvmsc';         // SMTP password 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;                          // TCP port to connect to 

            // Sender info 
            $mail->setFrom($data['email'], $data['name']);
            $mail->addReplyTo($data['email'], $data['name']);

            // Add a recipient 
            $mail->addAddress('blog.php2022@gmail.com');

            //$mail->addCC('cc@example.com'); 
            //$mail->addBCC('bcc@example.com'); 

            // Set email format to HTML 
            //$mail->isHTML(true);

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
