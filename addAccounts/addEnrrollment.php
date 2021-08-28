<?php

  require '../mysqliconnection.php';
//Usar bindparams para rellenar todo la tabla
//15420070050084
    //Entonces el registro solo seria un update de la fila que hiciste, alright //Cause se va a crear el numero de la tarjeta
    //y si ya esta ocupada o etc...


  //Parametros a pasar
  if(isset($_GET["matricula"])){

    $matricula = $_GET["matricula"];//Solo estos seran rellenados


    $queryMatricula ="SELECT * FROM students WHERE matricula = '{$matricula}'"; //BUscando por la matricula
    $resultadoEmail = mysqli_query($conexion,$queryMatricula);


    if ($emailResult = mysqli_fetch_array($resultadoEmail) ) { //encontro algo si devuelve true

          echo "Alumno ya registrado";

    }else {

      $sql = "INSERT INTO students VALUES (?,?,?,?,?,?,?,?,?,?,?)"; //Son 10 valores //9 si no contamos el id (Falta 1)

      //Checar los signos de limitacion
      //Puede ser que falte el id, (Aunque este incrementable) otro error podria ser que haya personas que registren al mismo tiempo
      $id; //No se necesita inacializarlo
      $email = "";
      $password= "";
      $semestre = "";
      $nombre = "";
      $lastname = "";
       //Quitar el $apellidomaterno para convertir el paterno a $lastname
      $url = "";
      $issaccbusy = "NO";
      $accparent = "NO";
       //Consulta que regrese el jsonobjectRequest o StringRequest para hacer validacion
      //Una vez registrado esto, cambiarle el valor a si
      //Efectivamente le puedo enviar valores nulos

      $stm = $conexion -> prepare ($sql);
        //i falta la i
        //Aqui le cambie ya q son mas columnas
      $stm -> bind_param('issssssssss',$id,$matricula,$email,$password,$semestre,$nombre,$lastname,$semestre,$url,$issaccbusy,$accparent); //Bind params tiene la orden de rellenar todas las columnas si no, no hace registro

      //Otra cosa podria ser investigar como hacerle para hacer los cambios 2 minutos despues por algo es q algunas apps se tardan en respoder


      if ($stm -> execute()) {//True si hizo la inserccion

        echo "Exito al registrar";

      }else {
            echo "Sin exito al registrar"; //La sintaxis esta mal o no se conecto al servidor
      }
        }
  }else {

    echo "Ingrese una matricula";
  }


//  15420070050084

//Debo de crear una verificacion para q no se vuelva a repeir el mismo nombre
























 ?>
