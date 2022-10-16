<?php

namespace Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use stdClass;

class Email
{
    private $mail = stdClass::class;

    public function __construct(
        $smtpDebug,
        $host,
        $user,
        $password,
        $smtpSecure,
        $port,
        $setFromEmail,
        $setFromName
    ) {
        //Create an instance; passing `true` enables exceptions
        $this->mail = new PHPMailer(true);

        //Server settings
        $this->mail->SMTPDebug = $smtpDebug; //Enable verbose debug output
        $this->mail->isSMTP(); //Send using SMTP
        $this->mail->Host = $host; //Set the SMTP server to send through
        $this->mail->SMTPAuth = true; //Enable SMTP authentication
        $this->mail->Username = $user; //SMTP username
        $this->mail->Password = $password; //SMTP password
        $this->mail->SMTPSecure = $smtpSecure;//Enable implicit TLS encryption
        $this->mail->Port = $port;
        //TCP port to connect; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->CharSet = 'utf-8';
        $this->mail->setLanguage('br');
        $this->mail->isHTML(true);

        //Recipients
        $this->mail->setFrom($setFromEmail, $setFromName);
    }

    public function sendMail(string $subject, $body, $replyEmail, $replyName, $addresEmail, $addressName)
    {
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->addReplyTo($replyEmail, $replyName);
        $this->mail->addAddress($addresEmail, $addressName);

        try {
            // $this->mail->send();
            echo "<p>E-mail enviado com sucesso!!</p>"; //JUST MOCKING A SUCCESS
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail: {$this->mail->ErrorInfo} {$e->getMessage()}";
        }
    }
}
