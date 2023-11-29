<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $dni = $_POST["dni"];
    $dorsal = $_POST["dorsal"];
    $usuario = $_POST["usuario"];
    $contrasena = hash("sha256", $_POST["contrasena"]);

    $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
    $usuariobd = 'root';
    $clavebd = '';

    try {
        //Se crea la conexión con la base de datos
        $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);
        $sql = 'INSERT INTO usuarios (nombre,apellidos,correo,rol,dni,usuario,contraseña) VALUES ("' . $nombre . '","' . $apellidos . '","' . $email . '",0,"' . $dni . '","' . $usuario . '","' . $contrasena . '");';

        $user = $bd->query($sql);
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Fútbol</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="body">
        <div class="contenedor">
            <header class="header">
                <h1 class="header__title">BIENVENIDO A LA PÁGINA DEL EQUIPO</h1>   
            </header>
            <main class="main">
                <h2 class="main__title">
                    INICIA SESIÓN
                </h2>
                <form method="post" action="./pages/calendario.php">
                    <?php
                    if (isset($_GET['error'])) {
                        ?>
                        <span class="text-danger font-weight-bold">Usuario o Contraseña incorrectos</span>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($_GET['cambioContra'])) {
                        ?>
                        <span class="text-success font-weight-bold">Contraseña correctamente cambiada</span>
                        <?php
                    }
                    ?>
                    <div class="mt-3 mb-3">
                        <label class="form-label">Usuario</label>
                        <input name="user" type="text" class="form-control" id="inputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="inputPassword1">
                    </div>
                    <div class="d-flex">
                        <p>¿No estás registrado?</p>&nbsp;
                        <a class="font-weight-bold" href="./pages/registro.php">Registate</a>
                    </div>
                    <?php
                    if (isset($_GET['error'])) {
                        ?>
                        <div class="d-flex px-3 mb-3">
                            <a class="font-weight-bold" href="./pages/cambiarcontra.php">He olvidado mi contraseña</a>
                        </div>
                        <?php
                    }
                    ?>
                    <button class="btn btn-primary boton bg-success d-flex justify-content-center border-0 rounded" type="submit">Entrar</button>
                </form>
            </main>
        </div>  
    </body>
</html>