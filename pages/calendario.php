<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Fútbol</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/calendario.css"/>

    </head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $usuario = $_POST["user"];
        $contraseña = hash("sha256", $_POST["password"]);
        $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
        $usuariobd = 'root';
        $clavebd = '';

        try {

            //Se crea la conexión con la base de datos
            $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);
            $sql = 'SELECT nombre,usuario,contraseña FROM usuarios where usuario="' . $usuario . '"and contraseña="' . $contraseña . '"';

            $user = $bd->query($sql);

            foreach ($user as $row) {
                $nombre = $row["nombre"];
            }
        } catch (Exception $e) {
            header("Location: ../index.php");
        }
    } else {
        $nombre = $_GET["nombre"];
    }
    ?>

    <body class="body">
        <div class="contenedor">
            <header class="header">

                <?php
                if ($nombre == "Admin") {
                    ?> 
                    <h1 class="header__title">BIENVENIDO ENTRENADOR A LA PÁGINA DEL EQUIPO</h1>    

                    <?php
                } else {
                    ?> 
                    <h1 class="header__title">BIENVENIDO <?php echo strtoupper($nombre) ?> A LA PÁGINA DEL EQUIPO</h1>    

                    <?php
                }
                ?>

            </header>
            <main class="main">
                <h2>Calendario</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miércoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sábado</th>
                            <th>Domingo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $dias = 0;
                            for ($i = -3; $i <= 31; $i++) {
                                ?>
                                <td> <?php
                                    if ($i > 0) {
                                        $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
                                        $usuariobd = 'root';
                                        $clavebd = '';
                                        $fecha;
                                        if ($i < 10) {
                                            $fecha = "0" . $i;
                                        } else {
                                            $fecha = $i;
                                        }
                                        echo $i . "<br>";
                                        try {
                                            // Se crea la conexión con la base de datos
                                            $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);
                                            $sql = "SELECT * FROM partidos where fecha='2023-11-" . $fecha . "';";

                                            $saberpartido = $bd->query($sql);

                                            foreach ($saberpartido as $fila) {

                                                echo $fila['lugar'] . "<br>";
                                                echo $fila['equipacion'] . "<br>";
                                            }
                                        } catch (Exception $e) {
                                            echo "Error al hacer el insert: " . $e->getMessage();
                                        }
                                    }
                                    ?> </td>
                                    <?php
                                    $dias++;
                                    if ($dias == 7) {
                                        echo '</tr><tr>';
                                        $dias = 0;
                                    }
                                }
                                ?>
                    </tbody>
                </table>
            </main>
                            <?php
                            if ($nombre == "Admin") {
                                ?>
                <h2 class="mt-3">Añadir Entrenamiento o Partido</h2>
                <form method="post" action="./modificacioncalendario.php?<?php echo("nombre=$nombre"); ?>">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" min="2023-11-01" max="2023-11-30" required>
                    <label for="fecha">Equipación:</label>
                    <select name="equipacion" id="id">
                        <option disabled="" selected="" value="texto" >Selecciona equipacion</option>
                        <option value="local">local</option>
                        <option value="visitante">visitante</option>
                    </select>
                    <label for="fecha">Lugar:</label>
                    <input type="text" name="lugar" required>

                    <button type="submit">Enviar</button>
                </form>
            </main>
        </div>  
    </body>

    <?php
}

$bd = null;
?>
</div>
</body>

</html>