<?php


//Solo tendria q subir los archvivos creadores recientemente

$hostname = "localhost"; //Se sigue llamando el host igual
$database = "cecyteschool";
$username = "root";
$pass= "";


$conexion = mysqli_connect($hostname,$username,$pass,$database); //Its working

/* if ($conexion->ping()) {
    echo "Conexion activa";
} else {
    printf ("Error: %s\n", $mysqli->error);
}*/
//require '../mysqliconnection.php';
 ?>
