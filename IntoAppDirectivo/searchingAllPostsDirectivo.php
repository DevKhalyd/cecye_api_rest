<?php

require '../mysqliconnection.php';


$json = array();



require '../mysqliconnection.php';


$json = array();


  //Por medio de esto buscara
    //igual esto
    //Por metodo get le llegara de la tabla q desea

        //$query_SQL = "SELECT * FROM poststudents";
        //Cambia el orden de los pots
        $query_SQL = "SELECT * FROM postallprofiles ORDER BY idpost DESC";  // "*" = Todo
        //Desc para que muestre los pots mas actuales

        $result_query = mysqli_query($conexion,$query_SQL);

         //Comprueba que haya regresado los datos

         while($registro =mysqli_fetch_array($result_query)){ //Se pasa a este array
        //Tal vez aqui una vez consiga todos los datos puedo ir y hacer una consulta por cada uno o sea combinarlos
           $result["title"]=$registro['title'];
           $result["description"]=$registro['description'];
           $result["url"]=$registro['url'];
           $result["namedirectivo"]=$registro['namedirectivo']; //Columna lladada id
           $result["position"]=$registro['position'];
           $result["urldirectivo"]=$registro['urldirectivo'];
           $result["profile"]=$registro['profile']; //Distincion
           $result["date"]=$registro['dateforapp'];

           $json["poststudents"][]=$result;
           //Seria el archivo raiz
           //echo $registro['id'].' - '.$registro['nombre'].'<br/>';
         }
         //Aqui yo no le estoy poniend la posicion como lo fue en otros JSON
         mysqli_close($conexion);

         echo json_encode($json);

         //Al final quedo igual





 ?>
