<?php

namespace Lib;
use PHPMailer\PHPMailer\PHPMailer;

class Email{

    //Envia un email a Mailtrap con el destinatario que le pasamos como $email
    public function sendMail($email){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c15a4b2f927d48';
        $mail->Password = '9d6041a706f21f';

        $mail->setFrom('proyecto-cursos@gmail.com');
        $mail->addAddress("$email");
        $mail->Subject = 'Registro Proyecto Cursos';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= '<h1>registro correcto</h1>';
        $contenido .= '<p>Gracias '. $email .' por registrarte en nuestros cursos</p>';
        $contenido .= '</html>';
        $mail->Body = $contenido;

        $mail->send();

    }
}

?>