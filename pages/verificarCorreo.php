<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];

    $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
    $usuariobd = 'root';
    $clavebd = '';

    try {
        // Se crea la conexión con la base de datos
        $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);

        $verificar = "SELECT * FROM usuarios WHERE correo = '$correo';";
        $existe = $bd->query($verificar);
        foreach ($existe as $row) {
            $nombre = $row["nombre"];
        }

        if ($existe->rowCount() > 0) {

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jugadoresJuveniles@gmail.com';
            $mail->Password = 'krwtscchglatcmkg';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('marcossblazquezz@gmail.com');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "Verificación de Cambio de Contraseña";
            $mail->Body = "<h1>Estimado/a " . $nombre . "</h1><br><br>
                           Hemos recibido una solicitud para cambiar la contraseña asociada a su cuenta en la página web de tu equipo.<br><br>
                           Para garantizar la seguridad de su cuenta, necesitamos verificar que esta solicitud proviene legítimamente de usted. Por favor, haga clic en el siguiente enlace para confirmar su intención de cambiar la contraseña:<br><br>
                           <a href='http://localhost/Proyecto-DWES/pages/cambiarcontra.php?verificarTrue'>Verificar Correo</a><br><br>
                           Si no ha solicitado este cambio o no reconoce esta actividad, le recomendamos que ignore este mensaje y tome las medidas necesarias para asegurar su cuenta.";
            $mail->send();
            
            header("Location: ./cambiarContra.php?enviado");
        } else {
            header("Location: ./cambiarContra.php?denegado");
        }
    } catch (Exception $e) {
        header("Location: ../index.php");
        echo $e->getMessage();
    }
}

