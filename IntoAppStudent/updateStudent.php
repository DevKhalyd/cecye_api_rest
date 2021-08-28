<?php


 require '../mysqliconnection.php'; //Con esta linea estoy llamando a mi conexion para no estar haciendola a cada rato

  //Necesitare el email que ya estara en las shared preferences para actualizar esa fila
  //Me llegaran los names, lastnames, semestres

  $email = $_POST["email"];
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];
  $group = $_POST["group"];

//Solo estos seran rellenados


  $queryProfile="SELECT isUpdateProfile FROM students WHERE email = '{$email}'"; //BUscando por la matricula
  $resultadoEmail = mysqli_query($conexion,$queryProfile);


  if ($emailResult = mysqli_fetch_array($resultadoEmail) ) { //encontro algo si devuelve true

            $isUpdatedProfileStudent = $emailResult['isUpdateProfile'];

            if ($isUpdatedProfileStudent == "NO") { //El perfil puede ser actualizado

              //Cambiar semestre a groupStudent que recive int (3)y crear la columna isUpdateProfile
              //Al momento de q se registre un nuevo alumno poner el "NO" (?)

              $sql="UPDATE students SET groupStudent = ?, nombre = ?, lastname = ?, isUpdateProfile = ?  WHERE email = ? ";
              //Semestre = group where Recive Int
              $isUpdateProfileAccStudent = "SI";

              $stm=$conexion->prepare($sql);
              //Esto debe de ir en orden asi como esta arriba
              $stm->bind_param('issss',$group,$name,$lastname,$isUpdateProfileAccStudent,$email);
                                //Añadiendo el
                                 if($stm->execute()){
                                    echo "succesful";
                                }else{
                                     echo "nosuccesful";
                                    }
                     mysqli_close($conexion);

            }else {
              echo "ProfileUpdated";
            }

  }else {
             echo "ERRORFATAL"; //Esto no deberia de ocurrir
}


 ?>
