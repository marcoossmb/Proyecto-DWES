<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="../css/correo.css"/>
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
            $nombre_codificado = base64_encode($nombre);
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
            $mail->Body = "
                            <!DOCTYPE html>
                            <html lang='es'>
                            <head>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            </head>
                            <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
                                <table role='presentation' cellspacing='0' cellpadding='0' width='100%' style='margin: auto;'>
                                    <tr>
                                        <td style='max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
                                            <h1 style='color: #333333; font-size: 24px; margin-bottom: 20px;'>Estimado/a " . $nombre . "</h1>
                                            <p style='color: #555555; font-size: 16px; margin-bottom: 20px;'>Hemos recibido una solicitud para cambiar la contraseña asociada a su cuenta en la página web de tu equipo.</p>
                                            <p style='color: #555555; font-size: 16px; margin-bottom: 20px;'>Para garantizar la seguridad de su cuenta, necesitamos verificar que esta solicitud proviene legítimamente de usted.</p>
                                            <p style='color: #555555; font-size: 16px; margin-bottom: 20px;'>Por favor, haga clic en el siguiente enlace para confirmar su intención de cambiar la contraseña:</p>
                                            <p style='margin-bottom: 30px;'><a href='http://localhost/Proyecto-DWES/pages/cambiarcontra.php?verificarTrue&&nombre=" . urlencode($nombre_codificado) . "' style='color: #ffffff; text-decoration: none; font-size: 16px; display: inline-block; padding: 10px 20px; background-color: #28a745; border-radius: 5px; text-align: center;'>Verificar Correo</a></p>
                                            <p style='color: #555555; font-size: 16px;'>Si no ha solicitado este cambio o no reconoce esta actividad, le recomendamos que ignore este mensaje y tome las medidas necesarias para asegurar su cuenta.</p>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                            </html>";

            $mail->send();

            header("Location: ./cambiarContra.php?enviado&&nombre='.urlencode($nombre_codificado).'");
        } else {
            header("Location: ./cambiarContra.php?denegado");
        }
    } catch (Exception $e) {
        header("Location: ../index.php");
        echo $e->getMessage();
    }
}

