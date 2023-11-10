<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Fútbol</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    </head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $usuario=$_POST["user"];
         $contraseña= hash("sha256", $_POST["password"]);
        $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
        $usuariobd = 'root';
        $clavebd = '';

        try {
            //Se crea la conexión con la base de datos
            $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);
            $sql='SELECT usuario,contraseña FROM usuarios where usuario="'.$usuario.'"and contraseña="'.$contraseña.'"';
            
                $user = $bd->query($sql);
              echo "Número de usuarios: ".$user->rowCount()."<br>";
                //Se recorre el array que nos devuelve la consulta
                foreach ($user as $row){
                    print $row["usuario"]."\t";
                    print $row["contraseña"]."\t";
                  
                }
                
                //Se cierra la conexión
                $bd = null;
            
            
            
            
            
        } catch (Exception $e) {
            echo "Error con la base de datos: " . $e->getMessage();
           
        }
        
        
        
        
        
        
        
    } else {
        header("Location: ../index.php");
    }
    ?>
    <body class="body">
        <div class="contenedor">
            <header class="header">
                <h1 class="header__title">BIENVENIDO A LA PÁGINA DEL EQUIPO</h1>   
            </header>
            <main class="main">


            </main>





        </div>  

    </body>
</html>