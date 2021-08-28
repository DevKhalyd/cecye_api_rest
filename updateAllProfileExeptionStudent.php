<?php


 require 'mysqliconnection.php'; //Con esta linea estoy llamando a mi conexion para no estar haciendola a cada rato

  //Necesitare el email que ya estara en las shared preferences para actualizar esa fila
  //Me llegaran los names, lastnames

  $email = $_POST["email"];
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];
  $table = $_POST["table"];

   //Comprabando q ya esten
  if (isset($email) && isset($name) && isset($lastname) && isset($table) && isset($_POST["position"]) ) {
      //Inserccion a la base de datos direct
      $position = $_POST["position"];


      $sql="UPDATE $table SET name = ?, lastname = ?, position = ? WHERE email = ? ";

      $stm=$conexion->prepare($sql);
      //Esto debe de ir en orden asi como esta arriba
      $stm->bind_param('ssss',$name,$lastname,$position,$email);
                        //Añadiendo el
                         if($stm->execute()){
                            echo "succesful";
                        }else{
                             echo "nosuccesful";
                            }
             mysqli_close($conexion);

  }else {

        $sql="UPDATE $table SET name = ?, lastname = ?  WHERE email = ? ";

        $stm=$conexion->prepare($sql);
        //Esto debe de ir en orden asi como esta arriba
        $stm->bind_param('sss',$name,$lastname,$email);
                          //Añadiendo el
                           if($stm->execute()){
                              echo "succesful";
                          }else{
                               echo "nosuccesful";
                              }
               mysqli_close($conexion);

               //Comprobe q ya sirve para el padre y los profesores
  }




          //Debo de checar el nombre de las columnas ya q eso tambien puede producir un error


 ?>
