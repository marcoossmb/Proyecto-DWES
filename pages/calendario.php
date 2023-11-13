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
            $sql='SELECT nombre,usuario,contraseña FROM usuarios where usuario="'.$usuario.'"and contraseña="'.$contraseña.'"';
            
                $user = $bd->query($sql);
            
                 foreach ($user as $row){
                 $nombre= $row["nombre"];
                  
                }
               
             
            
            
        } catch (Exception $e) {
            header("Location: ../index.php");
           
        }
        
        
        
        
        
        
        
    } else {
        header("Location: ../index.php");
    }
    if ($nombre!="Admin") {
        
    ?>
    
    <body class="body">
        <div class="contenedor">
            <header class="header">
                <h1 class="header__title">BIENVENIDO <?php echo strtoupper($nombre ) ?> A LA PÁGINA DEL EQUIPO</h1>   
            </header>
            <main class="main">
                

                
                
                
                
            
            </main>





        </div>  

    </body>
    <?php
      }
 else {
       ?>
     
    <body class="body">
        <div class="contenedor">
            <header class="header">
                <h1 class="header__title">BIENVENIDO ENTRENADOR A LA PÁGINA DEL EQUIPO</h1>   
            </header>
            <main class="main">


            </main>





        </div>  

    </body>
    
    
    <?php
      }
         $bd = null;
    ?>
</html>