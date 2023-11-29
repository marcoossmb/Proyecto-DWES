<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css"/>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_GET['nombre'];
    $asunto = $_POST["subjet"];
    $mensaje = $_POST["mensaje"];
    $destinatario = $_POST["destinatario"];

    if (isset($_POST["send"])) {


        if (empty($asunto) || empty($mensaje)) {
            header("Location: ./calendario.php?nombre=$nombre&&vacio");
        } else {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jugadoresJuveniles@gmail.com';
            $mail->Password = 'krwtscchglatcmkg';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('jugadoresJuveniles@gmail.com');
            $mail->addAddress($destinatario);
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $mensaje;
            $mail->send();

            header("Location: ./calendario.php?nombre=$nombre&&correo");
        }
    }
} else {
    echo "<h1 class='d-flex justify-content-center mt-5'>Error: La página se encuentra en mantenimiento.</h1>";
    echo '<a class="d-flex justify-content-center boton__volver" href="../index.php">Volver</a>';
}