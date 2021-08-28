<?php


require '../mysqliconnection.php';


$json = array();


  # code...


 $matricula = $_GET["matricula"]; //Todo es por metodo get

 $query = "SELECT nombre,lastname,groupStudent,url FROM students WHERE matricula = '{$matricula}'";



 $resultquery = mysqli_query($conexion,$query); //Do query

 if ($giveresults = mysqli_fetch_array($resultquery)){ //Eso da un array asociativo donde vienen los resultados de la consulta sql

   //  $giveresults ese es el array asociativo con toodos los valores

     //Aqui creo otro array asociativo para guardar los valores ahi, luego le asigno el valor de lo qviene de la consulta
     $result["nombre"] = $giveresults['nombre'];
     $result["lastname"] = $giveresults['lastname']; //Nombre de la columna
     $result["groupStudent"] = $giveresults['groupStudent'];
     $result["url"] = $giveresults['url'];
     //Nombre por el q buscara el JSON y de ahi los valores asignados anteriormente
     $json['students'][]  = $result;


 }else {

   $result["nombre"] = "Alumno no encotrado";
   $result["lastname"] = "Verifique la matrícula";//Nombre de la columna
   $result["groupStudent"] = "";
   $result["url"] = "";
   //Nombre por el q buscara el JSON y de ahi los valores asignados anteriormente
   $json['students'][]  = $result;

 }
 mysqli_close($conexion);//Cierara base de datos

 echo json_encode($json);//Lo muestro en pantalla para llamar los datos





 ?>
