<?php

   require 'mysqliconnection.php';


    //Esto checa la info de todos los perfiles depedndiendo el caso
    $email = $_GET["email"]; //Todo es por metodo get
    $table = $_GET["table"];

    $json = array();

    //Tengo q pasarle la position

    if (isset($email) && isset($table) && isset($_GET["position"])) { //El here para pasarle la position


      //QueryDirectivo

      $query = "SELECT name,lastname,url,position FROM $table WHERE email = '{$email}'";

      $resultquery = mysqli_query($conexion,$query); //Do query
      /*
      if (!$resultquery) {
       printf("Error: %s\n", mysqli_error($conexion)); //Muestra el error
          exit();
       }*/
      if ($giveresults = mysqli_fetch_array($resultquery)){ //Eso da un array asociativo donde vienen los resultados de la consulta sql

        //  $giveresults ese es el array asociativo con toodos los valores
          //Aqui creo otro array asociativo para guardar los valores ahi, luego le asigno el valor de lo qviene de la consulta
          $result["name"] = $giveresults['name'];
          $result["lastname"] = $giveresults['lastname']; //Nombre de la columna
          $result["url"] = $giveresults['url'];
          $result["position"] = $giveresults['position'];
          //Nombre por el q buscara el JSON y de ahi los valores asignados anteriormente
          $json["$table"][]  = $result;


      }//Cuando me de flase debo de poner o checar el error de sql sentece

      mysqli_close($conexion);//Cierara base de datos

      echo json_encode($json);//Lo muestro en pantalla para llamar los datos



   }else {


      $query = "SELECT name,lastname,url FROM $table WHERE email = '{$email}'";


      $resultquery = mysqli_query($conexion,$query); //Do query

      if ($giveresults = mysqli_fetch_array($resultquery)){ //Eso da un array asociativo donde vienen los resultados de la consulta sql

        //  $giveresults ese es el array asociativo con toodos los valores
          //Aqui creo otro array asociativo para guardar los valores ahi, luego le asigno el valor de lo qviene de la consulta
          $result["name"] = $giveresults['name'];
          $result["lastname"] = $giveresults['lastname']; //Nombre de la columna
          $result["url"] = $giveresults['url'];
          //Nombre por el q buscara el JSON y de ahi los valores asignados anteriormente
          $json["$table"][]  = $result;

      }

       mysqli_close($conexion);//Cierara base de datos

       echo json_encode($json);
        //Pueda habaer un error ya q saldria y cerraria 2 veces
    }






 ?>
