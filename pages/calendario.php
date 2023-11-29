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
    function mostrarPartidosPorMes() {
        $dias = 0;

        echo '<table border="1"><tr>';

        for ($i = -1; $i <= 30; $i++) {
            echo '<td>';

            if ($i > 0) {
                $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
                $usuariobd = 'root';
                $clavebd = '';

                $fecha = ($i < 10) ? "0" . $i : $i;

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
                    echo "Error al hacer la consulta: " . $e->getMessage();
                }
            }

            echo '</td>';

            $dias++;

            if ($dias == 7) {
                echo '</tr><tr>';
                $dias = 0;
            }
        }

        echo '</tr></table>';
    }
   
   
    
    
     session_start();
    
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

            if ($user->rowCount() > 0) {
                 
            
                
                foreach ($user as $row) {
                    $_SESSION['usuario'] = $row["nombre"];
                }
                // Añado dos cookies la primera guarda el usuario y la segunda el rol
                setcookie("user_name",  $_SESSION['usuario'], time() + (86400 * 30), "/");
                if ($_SESSION['usuario'] == "Admin") {
                    setcookie("user_role", "1", time() + (86400 * 30), "/");
                } else {
                    setcookie("user_role", "0", time() + (86400 * 30), "/");
                }
            } else {
                header("Location: ../index.php?error");
            }
        } catch (Exception $e) {
            header("Location: ../index.php");
        }
    } else {
        if (isset($_GET['nombre'])) {
            $_SESSION['usuario'] = $_GET["nombre"];
        } else {
            header("Location: ../index.php");
        }
    }
    ?>

    <body class="body">
        <div class="contenedor">
            <!-- INICIO DEL HEADER -->
            <header class="header">
                <section class="header__marg">
                    <article class="header__article">
                        <img src="../assets/images/logotipo.PNG" alt="" class="header__img">
                    </article>
                    <article class="header__log">
                        <a href="./cerrar.php"class="header__button">Cerrar Sesión</a>
                    </article>
                </section>
            </header>
            <!-- FIN DEL HEADER -->
            <main class="main">
                <?php
                if ( $_SESSION['usuario']== "Admin") {
                    ?> 
                    <h1 class="header__title header__title--cal mb-5">BIENVENIDO ENTRENADOR A LA PÁGINA DEL EQUIPO</h1>    

                    <?php
                } else {
                    ?> 
                    <h1 class="header__title header__title--cal mb-5">BIENVENIDO <?php echo strtoupper($_SESSION['usuario']) ?> A LA PÁGINA DEL EQUIPO</h1>    

                    <?php
                }
                ?>
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
                            mostrarPartidosPorMes();
                            ?>
                    </tbody>
                </table>

                <?php
                if ($_SESSION['usuario'] == "Admin") {
                    ?>
                    <h2 class="mt-3">Añadir Partido</h2>
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
                    <?php
                    if (isset($_GET["error"])) {
                        ?>
                        <span class="text-danger">Error: no hay partido ese dia</span>
                        <?php
                    }
                    ?>

                    <h2 class="mt-3">Eliminar Partido</h2>
                    <form method="post" action="./eliminarcalendario.php?<?php echo("nombre=$nombre"); ?>">
                        <label>Fecha:</label>
                        <input type="date" name="fecha" min="2023-11-01" max="2023-11-30" required>
                        <button type="submit">Enviar</button>
                    </form>
                    <?php
                } else {
                    if (isset($_GET['correo'])) {
                        echo '<span class="text-success ml-5">Correo Enviado</span>';
                    }

                    if (isset($_GET['vacio'])) {
                        echo '<span class="text-danger ml-5">Error: algunos de los parametros vacio</span>';
                    }
                    ?>

                    <form class="ml-5" method="post" action="./send.php?<?php echo("nombre=$nombre"); ?>">
                        <h2 class="mt-3">Enviar Correo Al Entrenador</h2><br>
                        <label>(Ponga aquí su correo para comprobar que funciona)</label><br>
                        <input class="w-100" type="text" name="destinatario"> <br>
                        <label>Asunto</label><br>
                        <input type="text" name="subjet"> <br>
                        <label>Mensaje</label><br>
                        <textarea name="mensaje" rows="4" cols="50"></textarea><br>
                        <button class="mt-3" type="submit" value="" name="send">Enviar</button>
                    </form>
                    <?php
                }
                $bd = null;
                if (!isset($_SESSION['usuario'])) {
                 header("Location: ../index.php");
                }
                
                
                
                ?>
            </main>
        </div>  
    </body>
</html>