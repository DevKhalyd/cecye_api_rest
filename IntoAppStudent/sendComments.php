<?php

   require '../mysqliconnection.php';


     $email = $_POST["email"];
     $title = $_POST["title"];
     $description = $_POST["description"];

     $sql = "INSERT INTO comments VALUES (?,?,?,?,?)"; //Son 10 valores //9 si no contamos el id (Falta 1)


     $id;

     $error = ""; //Cuadno es texto se debe de inicializar

     $stm = $conexion -> prepare ($sql);
     //i falta la i
     $stm -> bind_param('issss',$id,$email,$title,$description,$error); //Bind params tiene la orden de rellenar todas las columnas si no, no hace registro

   //Otra cosa podria ser investigar como hacerle para hacer los cambios 2 minutos despues por algo es q algunas apps se tardan en respoder
    if ($stm -> execute()) {//True si hizo la inserccion

      echo "succesful";

    }else {
          echo "nosuccesful"; //La sintaxis esta mal o no se conecto al servidor
    }



 ?>
