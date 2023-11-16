<?php

$nombre = $_GET['nombre'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jugadoresJuveniles@gmail.com';
    $mail->Password = 'krwtscchglatcmkg';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('jugadoresJuveniles@gmail.com');
    $mail->addAddress('iviromotequiero@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = $_POST["subjet"];
    $mail->Body = $_POST["mensaje"];
    $mail->send();
    
    header("Location: ./calendario.php?nombre=$nombre&&correo");
}