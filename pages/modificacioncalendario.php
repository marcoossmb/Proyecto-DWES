<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $equipacion = $_POST['equipacion'];
    $lugar = $_POST["lugar"];

    $nombre = $_GET['nombre'];

    echo $fecha;
    echo $equipacion;

    $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
    $usuariobd = 'root';
    $clavebd = '';

    try {
        // Se crea la conexión con la base de datos
         $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);
        
        $verificar= "SELECT cod_partido FROM partidos WHERE fecha = '$fecha' LIMIT 1;"; 
        $existe = $bd->query($verificar);
        
        
        if ($existe->rowCount() > 0) {
        $codmax;
        foreach ($existe as $row) {
            $codmax = $row["cod_partido"];
        }
             $sqlActualizar = "UPDATE partidos SET lugar = '$lugar', equipacion = '$equipacion' WHERE cod_partido = $codmax;";
             $stmtUpdate = $bd->prepare($sqlActualizar);
            $stmtUpdate->execute();
             header("Location: ./calendario.php?nombre=$nombre");
            
            
        }
        else{
      
       
        $sql = "SELECT MAX(cod_partido) AS cod_partido FROM partidos;";

        $sabercodmax = $bd->query($sql);
        $codmax;
        foreach ($sabercodmax as $row) {
            $codmax = $row["cod_partido"];
        }
        $codmax += 1;

        // Corregir la sintaxis de la consulta SQL
        $sq2 = 'insert into partidos(lugar,fecha,equipacion,cod_partido) values("' . $lugar . '","' . $fecha . '","' . $equipacion . '",' . $codmax . ');';

        // Preparar la consulta
        $stmt2 = $bd->prepare($sq2);

        // Ejecutar la consulta
        if ($stmt2->execute()) {
            header("Location: ./calendario.php?nombre=$nombre");
        } else {
            // Obtener información sobre el error
            $errorInfo = $stmt2->errorInfo();
            echo "Error al insertar el registro: " . $errorInfo[2];
        }
        }
    } catch (Exception $e) {
        echo "Error al hacer el insert: " . $e->getMessage();
    }
    

    
} else {
    echo "<h1 class='d-flex justify-content-center'>Error: La página se encuentra en mantenimiento.</h1>";
}


