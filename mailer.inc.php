<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail-> Host ='smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username ='sophiasgs11@gmail.com';
$mail->Password ='senha';
$mail->SMTPSecure = PHPMailer::
$mail->Port = 465;