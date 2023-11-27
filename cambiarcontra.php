<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
}
?>          
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Fútbol</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/calendario.css"/>

    </head>
    <body class="body">
        <div class="contenedor">
            <header class="header">
                <h1 class="header__title">CAMBIAR CONTRASEÑA</h1>
            </header>
            <main class="main">
                <?php
                if (isset($pass1) && isset($pass2)) {
                    if ($pass1 === $pass2) {

                        $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
                        $usuariobd = 'root';
                        $clavebd = '';

                        try {
                            $bd = new PDO($cadena_conexion, $usuario, $clave);

                            $bd = null;
                        } catch (Exception $e) {
                            echo "Error con la base de datos: " . $e->getMessage();
                        }
                    } else {
                        echo '<span class = "text-danger font-weight-bold">Las contraseñas no coinciden</span>';
                    }
                }
                if (isset($_GET['verificarTrue'])) {
                    ?>          
                    <form method="post" action="cambiarcontra.php?verificarTrue">
                        <div class="mt-3 mb-3">
                            <label class="form-label">Nueva Contraseña</label>
                            <input name="pass1" type="password" required class="form-control">
                        </div>
                        <div class="mt-3 mb-3">
                            <label class="form-label">Repetir Contraseña</label>
                            <input name="pass2" type="password" required class="form-control">
                        </div>
                        <button class="boton bg-success d-flex justify-content-center border-0 rounded" type="submit" class="btn btn-primary">Cambiar</button>
                    </form>
                    <?php
                } else {
                    ?>
                    <form method="post" action="verificarCorreo.php">
                        <?php
                        if (isset($_GET['denegado'])) {
                            echo '<span class = "text-danger font-weight-bold">Este correo no esta vinculado a ningún usuario</span>';
                        }
                        if (isset($_GET['enviado'])) {
                            echo '<span class = "text-success font-weight-bold">Correo enviado correctamente, revise su correo</span>';
                        }
                        ?>

                        <div class="mt-3 mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input name="correo" type="email" required class="form-control">
                        </div>
                        <button class="boton bg-success d-flex justify-content-center border-0 rounded" type="submit" class="btn btn-primary">Verificar</button>
                    </form>
                    <?php
                }
                ?>
            </main>
        </div>  
    </body>
</html>