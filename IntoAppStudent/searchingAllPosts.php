<?php

     require '../mysqliconnection.php';




$json = array();


      $profile = $_GET["profile"]; //Por medio de esto buscara
    //igual esto
    //Por metodo get le llegara de la tabla q desea
      //$query_SQL = "SELECT * FROM postallprofiles WHERE profile = '{$profile}';

        $query_SQL = "SELECT * FROM postallprofiles WHERE profile IN ('{$profile}','10') ORDER BY idpost DESC";  // "10" = Todo
        //XPUNIQUE = Al parecer si no encuentra algunos de los parametros ('{$profile}','10') se sigue con el otro y asi y despues lo ordena
        //Exelente si funciona asi
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
           //Tow adds
           $result["date"]=$registro['dateforapp'];
           $result["profile"]=$registro['profile'];

           $json["$profile"][]=$result;
           //Seria el archivo raiz
           //echo $registro['id'].' - '.$registro['nombre'].'<br/>';
         }
         //Aqui yo no le estoy poniend la posicion como lo fue en otros JSON
         mysqli_close($conexion);
         echo json_encode($json);

         //Aqui DEBO DE CONFIGURAR PARA Q LE LLEGUE EL PROFILE ESPECIFICADO




 ?>
