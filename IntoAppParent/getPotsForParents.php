
<?php



require '../mysqliconnection.php';


$json = array();



$email = $_GET["email"];



$consulta="SELECT idson FROM parents WHERE email = '{$email}'"; //BUscando por email ya que eso va recibir
$resultadoAcc =mysqli_query($conexion,$consulta);

if ($childrenSearch = mysqli_fetch_array($resultadoAcc)) {//Siempre tiene q entrar aqui

     $idSon = $childrenSearch['idson']; //Aqui ya obtengo el id del hijo

     $query = "SELECT groupStudent FROM students WHERE id = '{$idSon}'"; //Pregunto su grupo
     $resultquery = mysqli_query($conexion,$query);


     if ($groupStudent = mysqli_fetch_array($resultquery)) {

          $group = $groupStudent['groupStudent']; //Aqui ya tengo el grupo

          //lO MANDO A BUSCAR por su grupo
          $query_SQL = "SELECT * FROM postallprofiles WHERE profile IN ('{$group}','10') ORDER BY idpost DESC";  // "10" = Todo
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

             $json["parentOnly"][]=$result; //Puede cambiarselo a su correo pero por el momento asi buscara
             //Seria el archivo raiz
             //echo $registro['id'].' - '.$registro['nombre'].'<br/>';
           }
           //Aqui yo no le estoy poniend la posicion como lo fue en otros JSON
           mysqli_close($conexion);
           echo json_encode($json);



        }










   }






 ?>
