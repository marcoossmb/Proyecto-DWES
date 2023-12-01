<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Fútbol</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="shortcut icon" href="../assets/images/logotipo.PNG" type="image/x-icon">
    </head>
    <body class="body">
        <div class="contenedor p-3">

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = $_GET['nombre'];
                $fecha = $_POST['fecha'];
                $dia = date('d', strtotime($fecha));

                // Verificar si el formulario de confirmación ha sido enviado
                if (isset($_POST['confirmacion'])) {
                    // Eliminar el partido
                    $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
                    $usuariobd = 'root';
                    $clavebd = '';

                    try {
                        // Se crea la conexión con la base de datos
                        $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);

                        // Verifica si el partido existe
                        $verificar = "SELECT cod_partido FROM partidos WHERE fecha = '$fecha' LIMIT 1;";
                        $existe = $bd->query($verificar);

                        if ($existe->rowCount() > 0) {
                            $cod;
                            foreach ($existe as $row) {
                                $cod = $row["cod_partido"];
                            }
                            // Elimina el partido
                            $sqlElimina = "DELETE FROM partidos WHERE fecha = '$fecha';";
                            $stmtEliminar = $bd->prepare($sqlElimina);
                            $stmtEliminar->execute();
                            header("Location: ./calendario.php?nombre=$nombre");
                        } else {

                            header("Location: ./calendario.php?error&nombre=$nombre");
                        }
                    } catch (Exception $e) {
                        echo "Error al hacer el insert: " . $e->getMessage();
                    }
                } else {
                    // Mostrar el formulario de confirmación
                    echo "
                        <form method='post' action='eliminarcalendario.php?nombre=$nombre'>
                            <input type='hidden' name='fecha' value='$fecha'>
                            <h3 class='text-center'>¿Estás seguro de que quieres eliminar el partido del día $dia?</h3>
                            <input class='boton__volver--elim' type='submit' name='confirmacion' value='Sí, eliminar partido'>
                            <a class='boton__volver--elim ml-5' href='./calendario.php?nombre=$nombre'>Cancelar</a>
                        </form>
                    ";
                }
            } else {
                echo "<h1 class='d-flex justify-content-center mt-5'>Error: La página se encuentra en mantenimiento.</h1>";
                echo "<a class='d-flex justify-content-center boton__volver' href='../index.php'>Volver</a>";
            }
            ?>
        </div>    
    </body>
</html>