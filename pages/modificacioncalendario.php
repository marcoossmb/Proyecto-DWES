<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $equipacion = $_POST['equipacion'];
    $lugar = $_POST["lugar"];

    echo $fecha;
    echo $equipacion;

    $cadena_conexion = 'mysql:dbname=futbol;host=127.0.0.1';
    $usuariobd = 'root';
    $clavebd = '';

    try {
        // Se crea la conexión con la base de datos
        $bd = new PDO($cadena_conexion, $usuariobd, $clavebd);
        $sql="SELECT MAX(cod_partido) AS cod_partido FROM partidos;";

        
         $sabercodmax = $bd->query($sql);
            $codmax;
                 foreach ($sabercodmax as $row){
                 $codmax= $row["cod_partido"];
                  
                }
        $codmax+=1;
        

        // Corregir la sintaxis de la consulta SQL
        $sq2 = 'insert into partidos(lugar,fecha,equipacion,cod_partido) values("' . $lugar . '","' . $fecha . '","' . $equipacion . '",'.$codmax.');';

        // Preparar la consulta
        $stmt2 = $bd->prepare($sq2);

       

        // Ejecutar la consulta
        if ($stmt2->execute()) {
            header("Location: ./calendario.php");
        } else {
            // Obtener información sobre el error
            $errorInfo = $stmt2->errorInfo();
            echo "Error al insertar el registro: " . $errorInfo[2];
        }
    } catch (Exception $e) {
        echo "Error al hacer el insert: " . $e->getMessage();
    }
} else {
    echo "Error: No se ha hecho la petición POST.";
}

