<?php



      require '../mysqliconnection.php';

      $matricula = $_POST["matricula"];
      $email = $_POST["email"];
      $password = $_POST["password"];

      $numerMax = 15420070059000;    //05 = PLANTEL
      $numerMin = 15420070050000; //Ultimo Año
      //Segundo Año
      $numerMinSecondYear = 16420070050000;
      $numerMaxSecondYear = 16420070059000;
      //Los de primer año
      $numerMinFirtsYear = 17420070050000;
      $numerMaxFirtsYear = 17420070059000;

      if ($matricula > $numerMin && $matricula < $numerMax) {

          $semestre = "Top"; //Ultimo Año

          InsertDataForGroup($conexion,$semestre,$matricula,$email,$password);
          //  This method is working

      }else if($matricula > $numerMinSecondYear && $matricula < $numerMaxSecondYear) {

            $SecondYear = "Mid"; //Segundo Año

          InsertDataForGroup($conexion,$SecondYear,$matricula,$email,$password);

      }else if ($matricula > $numerMinFirtsYear && $matricula < $numerMaxFirtsYear) {
        //Primer Año

            $FirtsYear = "Bot"; //Primer año

            InsertDataForGroup($conexion,$FirtsYear,$matricula,$email,$password);

      }else {

         echo "Somethingisbad"; //O sea q  esta mal la matricula

      } //Esto va al final porq si ninguno se cumple ps quiere decir q no corresponde a ningun grupo




   //Function q hace la insersion dependiendo del grupo
   function InsertDataForGroup($conexion,$message,$matricula,$email,$password){
  //Todo esto se supone q se repite solo q lo q va imprimir sera diferente
       $consultamatricula="SELECT matricula FROM students WHERE matricula = '{$matricula}'"; //BUscando por la matricula
       $resultadoEmail = mysqli_query($conexion,$consultamatricula);

  //Solo entra si encuentra algo en la base else {La cuenta esta desocupada}
         if ($matriculaNoRepeat = mysqli_fetch_array($resultadoEmail) ) { //True si encontro algo else no encontro nada

          echo "accountBusy";

        }else {


          $consultaEmail ="SELECT email FROM students WHERE email = '{$email}'"; //BUscando por la matricula
          $resultadoEmail = mysqli_query($conexion,$consultaEmail);

            //Solo entra si encuentra algo en la base else {La cuenta esta desocupada}
          if ($matriculaNoRepeat = mysqli_fetch_array($resultadoEmail) ) {

            echo "accInUseEmail";//Email oucpado

          }else {


            $sql = "INSERT INTO students VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"; //Son 10 valores //9 si no contamos el id (Falta 1)

            //Checar los signos de limitacion
            //Puede ser que falte el id, (Aunque este incrementable) otro error podria ser que haya personas que registren al mismo tiempo
            $id; //No se necesita inacializarlo
            $groupStudent = "";
            $nombre = "";
            $lastname = "";
             //Quitar el $apellidomaterno para convertir el paterno a $lastname
            $url = "";
            $issaccbusy = "SI"; //Este dice si la cuenta esta ocupada por el alumno
            $accparent = "NO";
            $isUpdateProfile = "NO";
            $img = "";

             //Consulta que regrese el jsonobjectRequest o StringRequest para hacer validacion
            //Una vez registrado esto, cambiarle el valor a si
            //Efectivamente le puedo enviar valores nulos

            $stm = $conexion -> prepare ($sql);
              //i falta la i
              //Aqui le cambie ya q son mas columnas
            $stm -> bind_param('iississsssss',$id,$matricula,$email,$password,$groupStudent,$nombre,$lastname,$img,$url,$issaccbusy,$accparent,$isUpdateProfile); //Bind params tiene la orden de rellenar todas las columnas si no, no hace registro

            //Otra cosa podria ser investigar como hacerle para hacer los cambios 2 minutos despues por algo es q algunas apps se tardan en respoder


            if ($stm -> execute()) {//True si hizo la inserccion

              echo $message; //El q dira de q semestre es

            }else {
                  echo "nosuccesful"; //La sintaxis esta mal o no se conecto al servidor
            }


          }

  }


}//Fin de la function


 ?>
