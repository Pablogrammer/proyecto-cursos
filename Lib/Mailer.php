<?php

namespace Lib;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;

    public function __construct($email){
        $this->email = $email;
    }

    public function sendMail(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '30977825c455af';
        $mail->Password = '68c70403eecdf8';

        $mail->setFrom('');
        $mail->addAddress('');
        $mail->Subject = '';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = 'registro correcto';
        $mail->Body = $contenido;

        $mail->send();

    }
}

?>