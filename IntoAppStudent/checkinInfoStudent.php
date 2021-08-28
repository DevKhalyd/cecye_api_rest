<?php

    require '../mysqliconnection.php';

    $json = array();

    $email = $_GET["email"]; //Todo es por metodo get

    $query = "SELECT nombre,groupStudent,url from students where email = '{$email}'";

    $resultquery = mysqli_query($conexion,$query); //Do query

    if ($giveresults = mysqli_fetch_array($resultquery)){ //Eso da un array asociativo donde vienen los resultados de la consulta sql

      //  $giveresults ese es el array asociativo con toodos los valores
        //Aqui creo otro array asociativo para guardar los valores ahi, luego le asigno el valor de lo qviene de la consulta
        $result["nombre"] = $giveresults['nombre'];
        $result["groupStudent"] = $giveresults['groupStudent']; //Nombre de la columna
        $result["url"] = $giveresults['url'];
        //Nombre por el q buscara el JSON y de ahi los valores asignados anteriormente
        $json['students'][]  = $result;

        //Debo de entender el uso de los ciclos ya que son muy importantes
    }

    mysqli_close($conexion);//Cierara base de datos

    echo json_encode($json);//Lo muestro en pantalla para llamar los datos


 ?>
