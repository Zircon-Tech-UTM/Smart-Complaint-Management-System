<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'lsyuan1029@gmail.com';
$mail->Password = 'epI39:XmeforevER';
$mail->setFrom('lsyuan1029@gmail.com');
$mail->addAddress('momentumlee5@gmail.com');
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the body.';
$mail->send();
?>