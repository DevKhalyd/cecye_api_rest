<?php


  require '../mysqliconnection.php';

//Usar bindparams para rellenar todo la tabla
//15420070050084
    //Entonces el registro solo seria un update de la fila que hiciste, alright //Cause se va a crear el numero de la tarjeta
    //y si ya esta ocupada o etc...

//3422345 //Primeras letras del cargo, cecyte, nombre etc
  //Parametros a pasar
  if(isset($_GET["noAsignado"])){

    $noAsignado = $_GET["noAsignado"];//Solo estos seran rellenados
    //Estp acepta 10 numeros


    $queryProfessional ="SELECT * FROM directivo WHERE noasignado = '{$noAsignado}'"; //BUscando por la matricula
    $resultado = mysqli_query($conexion,$queryProfessional);


    if ($noprofessionalResult = mysqli_fetch_array($resultado) ) { //encontro algo si devuelve true

          echo "Directivo ya Registrado";

    }else {

      $sql = "INSERT INTO directivo VALUES (?,?,?,?,?,?,?,?,?,?)"; //Son 10 valores //9 si no contamos el id (Falta 1)
      //Checar los signos de limitacion
      //Puede ser que falte el id, (Aunque este incrementable) otro error podria ser que haya personas que registren al mismo tiempo
      $id; //No se necesita inacializarlo
      $email = "";
      $password= "";
      $nombre = "";
      $lastname = "";
     //Quitar el $apellidomaterno para convertir el paterno a $lastname
      $issaccbusy = "NO";

       //Consulta que regrese el jsonobjectRequest o StringRequest para hacer validacion

      $stm = $conexion -> prepare ($sql);
        //i falta la i
      $stm -> bind_param('isssssssss',$id,$noAsignado,$email,$password,$password,$password,$password,$lastname,$password,$issaccbusy); //Bind params tiene la orden de rellenar todas las columnas si no, no hace registro

      //Otra cosa podria ser investigar como hacerle para hacer los cambios 2 minutos despues por algo es q algunas apps se tardan en respoder

      if ($stm -> execute()) {//True si hizo la inserccion

        echo "Exito al registrar";

      }else {
            echo "Sin exito al registrar"; //La sintaxis esta mal o no se conecto al servidor
      }
        }
  }else {

    echo "Ingrese el numero noAsignado";
  }


//  15420070050084

// 2329 833 850 va empezar desde el cero y empezara a contar
//2329833850






 ?>
