<?php

namespace App\Controllers;

use App\Auth;
use App\ViewHelpers;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailController extends Controller
{
    public function send($organisation, $from, $to, $subject = null, $body, $attachment = null, $cc = null, $bcc = null, $html_body = false)
    {

        $mail = new PHPMailer(true);

        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'user@example.com';                     //SMTP username
            $mail->Password   = 'secret';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($from, ViewHelpers::getOrganisation($organisation)['name']);
            foreach ($to as $recp) {
                $mail->addAddress($recp);
            }
            $mail->addReplyTo($from, 'Information');
            foreach ($cc as $c) {
                $mail->addCC($c);
            }
            foreach ($bcc as $bc) {
                $mail->addBCC($bc);
            }


            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;

            if ($html_body) {
                $mail->Body = $body;
            } else {
                $mail->AltBody = $body;
            }


            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
