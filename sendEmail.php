<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "mailhub.eait.uq.edu.au";
$mail->Port = 25;

$mail->setFrom('noreply@uq.edu.au');
$mail->addAddress($email);
$mail->Subject = $subject;
$mail->isHTML(true);
$mail->Body = $email_body;
if (!$mail->send())
    echo $email_alert;
?>