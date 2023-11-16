<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nombre = $_GET['nombre'];
    $fecha = $_POST['fecha'];

    echo $fecha;
  

    $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
    $usuariobd = 'root';
    $clavebd = '';

    try{
         $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);
        
        $verificar= "SELECT cod_partido FROM partidos WHERE fecha = '$fecha' LIMIT 1;"; 
        $existe = $bd->query($verificar);
        
        
        if ($existe->rowCount() > 0) {
        $cod;
        foreach ($existe as $row) {
            $cod = $row["cod_partido"];
        }
              $sqlElimina = "DELETE FROM partidos WHERE fecha = '$fecha';";
             $stmtEliminar = $bd->prepare($sqlElimina);
            $stmtEliminar->execute();
             header("Location: ./calendario.php?nombre=$nombre");
            
            
        }
        else{
      
           header("Location: ./calendario.php?error&nombre=$nombre");


        }
    } catch (Exception $e) {
        echo "Error al hacer el insert: " . $e->getMessage();
    }
    

    
} else {
    echo "Error: No se ha hecho la petición POST.";
}

