<?php

 require 'mysqliconnection.php';


   $reciveVersion = $_POST["versionInstalled"];

   $query = "SELECT versionapp,url FROM filesapp where id =  '3'"; //Si no funciona es sin comillas

   //Aqui tenia mayuscula y aun asi leia el la tabla es extraño filesApp estaba asi y aun asi iba para alla

   //Al parecer algo se movio al pasar el archivo asi q no hay problema


   $resultquery = mysqli_query($conexion,$query); //Do query

   if ($giveresults = mysqli_fetch_array($resultquery)){ //Eso da un array asociativo donde vienen los resultados de la consulta sql

     //  $giveresults ese es el array asociativo con toodos los valores

       //Aqui creo otro array asociativo para guardar los valores ahi, luego le asigno el valor de lo q viene de la consulta
       $version = $giveresults['versionapp'];
       $url = $giveresults['url'];

       if ($version == $reciveVersion ) {

          echo "DontNeedUpdate";

       }else if ($version == 1000) {//Mil para decir q estamos en mantenimiento
         //Se supone q la version la tengo q mover manualmente desde la base de datos
         echo "ServersOnMaintenance";

       }else {
           echo $url;
       }
   }
 ?>
