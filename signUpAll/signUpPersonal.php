<?php



//Todo el personal se registrara por medio de este metodo (docente,director)

  require '../mysqliconnection.php';

  $numbersdiffernts = $_POST["numbers"]; //Numbers of persolnal for sign up of echa one
  $email = $_POST["email"];
  $password = $_POST["password"];
  $table = $_POST["table"];//La tabla a donde ira a busacar
  $forsearch = $_POST["where"]; //Como se llama esa columna por la que buscara
  $resultemail = "";

  //Create other table if the values differnts
  //Checar esto
  $consulta="SELECT isaccbusy FROM $table WHERE $forsearch = '{$numbersdiffernts}'";//BUscando por los numeros que le hayamos pasado
  $resultado = mysqli_query($conexion,$consulta);

//Da error poque no le estan llegando valores, eso pasa porq le estoy pasando todo por variables y directamente

  if ($accbusy = mysqli_fetch_array($resultado)) { //Si trae algo es que encontro esa matricula (Devolvio true)

    //Almaceno el resultado obtenido de la columna isaccbusy
        $resultacc = $accbusy['isaccbusy']; //
      //  $resultemail = $accbusy['email']; //hasta aqui estaria vacio o sea el valor seria nuill


        if ($resultacc == "NO") {

            $consulta2="SELECT email FROM $table WHERE email = '{$email}'"; //BUscando por la matricula
            $resultadoEmail = mysqli_query($conexion,$consulta2);


              if ($emailNoRepeat = mysqli_fetch_array($resultadoEmail)) {

                  echo "emailBusy"; //Componer dependiendo de lo q me pida el metodo

              }else {
                //Do Update table

                 $sql ="UPDATE $table SET email = ?, password = ?, isaccbusy = ?  WHERE $forsearch = ? ";
                 $accbussy = "SI";
                 $stm=$conexion->prepare($sql);
                 $stm->bind_param('ssss',$email,$password,$accbussy,$numbersdiffernts);
                 //Añadiendo el

                 if($stm->execute()){

                       echo "succesful";

                      }else{
                          echo "nosuccesful";

                         }
                  mysqli_close($conexion);

              }

        }else {
            echo "accountBusy"; //Cuenta ocupada
        }
      }else {
            echo "AccNoFound"; //No encontro la cuenta
      }





 ?>
