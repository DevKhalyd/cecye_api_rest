<?php


  require '../mysqliconnection.php';


  $email = $_POST["email"];
  $password = $_POST["password"];
  $table = $_POST["table"];


          $queryEmail="SELECT * FROM $table WHERE email = '{$email}'"; //BUscando por la matricula
          $resultadoEmail = mysqli_query($conexion,$queryEmail);


          if ($emailResult = mysqli_fetch_array($resultadoEmail) ) { //True si encontro algo else no encontro nada
                //No tendria que haber otro if ya que si entra es q encontro la cuenta

            //  $resultEmail = $emailResult['email'];

                $queryPassword ="SELECT * FROM $table WHERE password = '{$password}'"; //BUscando por la matricula
                    //Directo hago la consulta
                 $resultadoPassword = mysqli_query($conexion,$queryPassword);

                 //Si entra aqui es porq trae  resultados
              if ($passwordResult = mysqli_fetch_array($resultadoPassword) ) { //Aqui cambio solo esta consultado y no necesito saber los
                // valores q me regresa ya asi no los tengo q pasar a string de sql a string

                  echo "AccesesSuccesful";
              }else {
                echo "passwordIncorrect";
              }
            }else {
              echo "NoexitsAcc";
            }






 ?>
