<?php

namespace Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use stdClass;

class Email
{
    private $mail = stdClass::class;

    public function __construct()
    {
        //Create an instance; passing `true` enables exceptions
        $this->mail = new PHPMailer(true);

        //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $this->mail->isSMTP(); //Send using SMTP
        $this->mail->Host = 'smtp.sendgrid.net'; //Set the SMTP server to send through
        $this->mail->SMTPAuth = true; //Enable SMTP authentication
        $this->mail->Username = 'apikey'; //SMTP username
        $this->mail->Password = 'xxxxxx'; //SMTP password
        $this->mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//Enable implicit TLS encryption
        $this->mail->Port = 587;
        //TCP port to connect; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->CharSet = 'utf-8';
        $this->mail->setLanguage('br');
        $this->mail->isHTML(true);

        //Recipients
        $this->mail->setFrom('thiagomiranda.tms@gmail.com', 'Equipe Thiago');
    }

    public function sendMail(string $subject, $body, $replyEmail, $replyName, $addresEmail, $addressName)
    {
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->addReplyTo($replyEmail, $replyName);
        $this->mail->addAddress($addresEmail, $addressName);

        try {
            $this->mail->send();
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail: {$this->mail->ErrorInfo} {$e->getMessage()}";
        }
    }
}
