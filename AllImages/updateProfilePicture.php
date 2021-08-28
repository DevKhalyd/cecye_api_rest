<?php

  require '../mysqliconnection.php'; //Aqui esta toda la conexion ../ Noi porque esta en la misma carpeta


  //Necesitare comprobar el tamaño de la imagen y por supuesto su peso y el tipo de archivo q esta intentando subir

  $email = $_POST["email"];
  $imagecode = $_POST["img"];
  $folder = $_POST["folder"];
  $table = $_POST["table"];

  if (!empty($imagecode)) {
       //folder = carpeta donde se guaradara dependiendo del perfil y luego el email
       $path = "$folder/$email.jpg";
  //  $table = $_POST["table"]; //Hacia q tabla ira
  //Checa bien la ruta
    //si paso algun valor cambiante la foto se mantendra actualizada
          //A donde va a ir a escribir, que es lo q va a poner
    file_put_contents($path,base64_decode($imagecode)); //Esto hace todo

    //Ya esto de abajo es la figura completa

    $imageDecode = file_get_contents($path); //Va a ir a esa dirrecion y va a traer lo q este en la direccion
    //Se supone aqui ya deberia estar completa
    $image_details = getimagesize($path); //Pasarle la imagen decodificada

    $heigh = $image_details[0];
    $widht = $image_details[1];
    $type  = $image_details[2]; //2 = imgJPEG o 3 = PNG

          if ($type == 2 || $type == 3 ) {



              if ($heigh <= 3000 &&  $widht <= 3000) {//El problema es esto
                //La imagen llega como 1550 0 2000 px

              /*  $nameFile = $_FILES["$imagecode"]['name'];
                $weight = $_FILES[$imageDecode]['size']; //In bytes (110,592) 110 = kb*/
                    //Do update
                    $sql="UPDATE $table SET img = ?, url = ?  WHERE email = ? ";
                    $img="";
                    $stm=$conexion->prepare($sql);
                    $stm->bind_param('sss',$img,$img,$email);
                    //Añadiendo el
                    if($stm->execute()){

                        $sql="UPDATE $table SET img = ?, url = ?  WHERE email = ? ";
                        $stm=$conexion->prepare($sql);
                        $stm->bind_param('iss',$imageDecode,$path,$email);
                                                  //Añadiendo el
                        if($stm->execute()){
                            echo "succesful";
                         }else{
                             echo "nosuccesful";
                                  //Debo eliminar el cache del telefono para q traiga nueva info
                                }
                             mysqli_close($conexion);
                         }else{
                             echo "somethingisbad";
                                  mysqli_close($conexion);
                            }




                              //HAASTA AQ
          }else {
              echo "ImageTooLong";
          }
    }else {
      echo "NoImage"; //1000 x 10000 != OK
      //Comprabar el tamaño
    }

  }else {

    echo "NoAgain";

  }









 ?>
