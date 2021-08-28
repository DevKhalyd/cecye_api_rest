<?php



  require '../mysqliconnection.php'; //Aqui esta toda la conexion ../ Noi porque esta en la misma carpeta


  //Necesitare comprobar el tamaño de la imagen y por supuesto su peso y el tipo de archivo q esta intentando subir

  $img1 = $_POST["Image1"];
  $img2 = $_POST["Image2"];

  $id1 = 1;



   $path = "imgsBackGroundApp/imageFondo1.jpg"; //Esto si lovoy a controlar io


  file_put_contents($path,base64_decode($img1)); //Esto hace todo

  //Ya esto de abajo es la figura completa

  $imageDecode = file_get_contents($path); //Va a ir a esa dirrecion y va a traer lo q este en la direccion
  //Se supone aqui ya deberia estar completa
  $image_details = getimagesize($path); //Pasarle la imagen decodificada


  $widht = $image_details[0];//Ancho
  $heigh = $image_details[1];//Alto
  $type  = $image_details[2];//2 = imgJPEG o 3 = PNG

        if ($type == 2 || $type == 3 ) {

                 if ($heigh > $widht ) {//Is correct
                   //Tal vez pueda poner $heigh = $heigh+100 oa lgo asi para ser mas exactos

                         $sql="UPDATE filesapp SET name  = ?, img = ?, url = ?  WHERE id = ? ";
                         $name = "FirtsPic";
                         $stm=$conexion->prepare($sql);
                         $stm->bind_param('sssi',$name,$imageDecode,$path,$id1);
                         //Añadiendo el

                         if($stm->execute()){ //A partir de aqui empieza el segundo

                          $path = "imgsBackGroundApp/imageFondo2.jpg"; //Esto si lo voy a controlar io

                          file_put_contents($path,base64_decode($img2)); //Esto hace todo

                          //Ya esto de abajo es la figura completa

                          $imageDecode = file_get_contents($path); //Va a ir a esa dirrecion y va a traer lo q este en la direccion
                          //Se supone aqui ya deberia estar completa
                          $image_details = getimagesize($path); //Pasarle la imagen decodificada


                            $widht = $image_details[0];//Ancho
                            $heigh = $image_details[1];//Alto
                            $type  = $image_details[2];//2 = imgJPEG o 3 = PNG

                            if ($type == 2 || $type == 3 ) {

                                  if ($heigh > $widht ) {//Is correct


                                    $sql="UPDATE filesapp SET name  = ?, img = ?, url = ?  WHERE id = ? ";
                                    $name = "SecondPic";
                                    $id1  = 2;
                                    $stm=$conexion->prepare($sql);
                                    $stm->bind_param('sssi',$name,$imageDecode,$path,$id1);

                                       if($stm->execute()){ //A pa

                                         echo "allSuccesful";

                                       }else {
                                         echo "SecondPicIsBad"; //Algo salio mal
                                       }


                                  }else {


                                       echo "NoCorrectSecondImage"; //La iamgen esta mal

                                  }
                            }else {
                                 echo "NoImage"; //1000
                            }

                                 }else{

                                        echo "firtsPicNOValid"; //Durante la inserccion algo salio mal o la setencia sql esta mal
                                         mysqli_close($conexion);

                                           }

                                       }else {
                                       echo "NoCorrectFirtsImage";
                                      }
                          }else {
                             echo "NoImage"; //1000 x 10000 != OK
                          //Comprabar el tamaño
                           }
 ?>
