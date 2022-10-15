<?php
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//class that is made for sending emails it has the needed methods that could be useful
//configuring the email messages 
class SendMail
{
    private $emailSentStatus = false;

    private $sendersEmail;
    private $body;

    private $headerText;
    public function setMessageBodyForVerificationCode($B)
    {
        $text = 'Your Verification Code is' . "" . $B;
        return $text;
    }
    public function setHeader($headerText)
    {
        $this->headerText = $headerText;
    }

    public function setSenderEmail($E)
    {
        $this->sendersEmail = $E;
    }
    public function setBody($B)
    {
        $this->body = $B;
    }
    public function sendEmail()
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp-mail.outlook.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = "jasonmarhsallrag33@outlook.com";
            $mail->Password   = 'ragrag**39000';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom("jasonmarhsallrag33@outlook.com", 'jason');
            $mail->addAddress($this->sendersEmail);
            $mail->addReplyTo("jasonmarhsallrag33@outlook.com", 'jason');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            $mail->isHTML(true);
            $mail->Subject = $this->headerText;
            $mail->Body    = $this->body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
       
            $this->emailSentStatus = true;
            echo "Success";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error {$e} : {$mail->ErrorInfo}";
            $this->emailSentStatus = false;
        }
        return $this->emailSentStatus;
    }
}
$email = new SendMail();
$email->setSenderEmail("stiflerwedontgiveup@gmail.com");
$email->setHeader("blah blah");
$email->setBody("You know what it is ");
$email->sendEmail();
