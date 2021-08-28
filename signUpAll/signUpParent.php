<?php


   require '../mysqliconnection.php';

  //Primero voy a ir a buscar si esta ese studiante en la tabla
  //Si algo sale mal debe ser el nombre de la $conexion
  //Solo le cambie el requiere por como lo hacia anteriormente

    $matricula = $_POST["matricula"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $idson;

    $consulta="SELECT * FROM students WHERE matricula = '{$matricula}'"; //BUscando por la matricula
    $resultadoAcc =mysqli_query($conexion,$consulta);

    if ($accbusyParent = mysqli_fetch_array($resultadoAcc)) { //Aqui va a entrar si encuentra la matricula

            $resultaccParent = $accbusyParent['accparent']; //La respuesta para ver si la cuenta del padre debe ser actualizada
            $idson = $accbusyParent['id']; //Primerohice la consulta para traerme su id del hijo
            $isaccbussyStudent =  $accbusyParent['isaccbusy'];

            if ($resultaccParent == "NO") {
                //Esta desocupada la cuenta

                if ($isaccbussyStudent == "NO") { //El alumno no se ha registrado

                  echo "shouldStudentSignUp";

                }else {
                  //Posible error should be *
                $consulta2="SELECT email FROM parents WHERE email = '{$email}'"; //BUscando por la matricula
                $resultadoEmail = mysqli_query($conexion,$consulta2);

                //Aqui en vez de hacer otra consulta lo que puedo hacer es hacer una consulta con todas las columnas que necesite para no
                //volver a hacer otra consulta tal vez hacer ese cambio imcrementaria la velocidad de respuesta

                if ($emailNoRepeat = mysqli_fetch_array($resultadoEmail) ) { //True si encontro algo else no encontro nada

                    echo "emailRegistrado"; //Email ya registrado

                     }else {

                        //En vez de hacer un into mejor hago un update para pasar menos archivos y asi si se crecen mas los campos
                        //no seria necesasrio actualizar esto
                       $sql="INSERT INTO parents VALUES (?,?,?,?,?,?,?,?) "; //Al hacer el insert ya no se puede modificar los valores
                          $id; //Fue una insercion porq todo depende de los sons asi q si quiero liberar algo tengo q borrar toda la fila
                        //Be inicializated
                          $name = "";
                          $lastname = "";
                          $stm= $conexion -> prepare($sql);

                          //Porq puse isss si debiria ser iisss //Double Integer
                          $stm->bind_param('isssssss',$id,$idson,$email,$password,$name,$lastname,$lastname,$lastname); //Posible error
                          //Añadiendo el
                          if($stm->execute()){
                            //    echo "succesful"; //succesful hasta q se haga todo
                                //UPDATE TABLE STUDENTS
                                 $sql="UPDATE students SET accparent = ?  WHERE matricula = ? ";
                                 $accbussy = "SI"; //Aqui estoy actualizando la tabala para indicar que ya hay un vinculo padre hijo
                                 $stm=$conexion->prepare($sql);
                                 $stm->bind_param('ss',$accbussy,$matricula);
                                 //Añadiendo el
                                   if($stm->execute()){
                                         echo "AllWassuccesful";

                                        }else{
                                            echo "ErroTooStrong"; //Al momento final no se executo lo cual produciria un error fatal
                                           }
                                    mysqli_close($conexion);
                                       }else{
                                           echo "nosuccesful"; //No se ejecto la inserccion aunque haya cumplido todos lo requisitos
                                               mysqli_close($conexion);
                                          }

                     }//Aqui acaba el siguiente else

               }

            }else {
              echo "bussyAcc"; //Cuenta ocupada
              mysqli_close($conexion);
            }
    }else {
      echo "stundentUserNoexits"; //Ese estudiante todavia no esta registrada
      mysqli_close($conexion);
    }







 ?>
