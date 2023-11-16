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
        header("Location: ../index.php");
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>  
    </body>
<?php
if ($nombre == "Admin") {
    ?>
        <h2 class="mt-3">Añadir Entrenamiento o Partido</h2>
        <form method="post" action="./modificacioncalendario.php">
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
</html>