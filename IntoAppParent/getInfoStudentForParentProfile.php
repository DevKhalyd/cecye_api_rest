<?php


   require '../mysqliconnection.php';


   $json = array();



   $email = $_GET["email"];

   $consulta="SELECT idson FROM parents WHERE email = '{$email}'"; //BUscando por email ya que eso va recibir
   $resultadoAcc =mysqli_query($conexion,$consulta);

   //Este metodo seria casi igual para llamar a sus pots respectivos

   if ($childrenSearch = mysqli_fetch_array($resultadoAcc)) {//Siempre tiene q entrar aqui

        $idSon = $childrenSearch['idson']; //Con esto buscara en la tabla students y asi traer su info


        $query = "SELECT nombre,lastname,groupStudent,url FROM students WHERE id = '{$idSon}'";
        $resultquery = mysqli_query($conexion,$query);


        if ($giveresults = mysqli_fetch_array($resultquery)){ //Eso da un array asociativo donde vienen los resultados de la consulta sql

          //  $giveresults ese es el array asociativo con toodos los valores
            //Aqui creo otro array asociativo para guardar los valores ahi, luego le asigno el valor de lo qviene de la consulta
            $result["nombre"] = $giveresults['nombre'];
            $result["lastname"] = $giveresults['lastname']; //Nombre de la columna
            $result["groupStudent"] = $giveresults['groupStudent']; //Nombre de la columna
            $result["url"] = $giveresults['url'];
            //Nombre por el q buscara el JSON y de ahi los valores asignados anteriormente
            $json['students'][]  = $result;
            //Debo de entender el uso de los ciclos ya que son muy importantes para el recorrido de los arreglos
        }

        mysqli_close($conexion);//Cierara base de datos

        echo json_encode($json);//Crea el json y lo muestra



   }//No pondre else porq no tiene porq entrar ahi









 ?>
