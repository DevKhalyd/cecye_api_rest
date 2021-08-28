<?php


//PotsDirectivo

require '../mysqliconnection.php';



     $email = $_POST["email"];
     $title = $_POST["title"];
     $description = $_POST["description"];
     $imagecode = $_POST["img"]; //Puede venir vacio //Esta definida asi q tengo q usar empty
     $folder = $_POST["folder"];//Donde se guardaran las imagenes
     $profile = $_POST["profile"]; //Solo llegan códigos(grupos)


     $consulta ="SELECT name,position,url FROM directivo WHERE email = '{$email}'"; //BUscando por la matricula
     $resultadoAcc =mysqli_query($conexion,$consulta);

     if ($data = mysqli_fetch_array($resultadoAcc)) { //Aqui va a entrar si encuentra la matricula

             $name = $data ['name']; //La respuesta
             $cargo = $data ['position']; //Primerohice la consulta para traerme su id
             $imgurl =  $data ['url'];
             $dateforApp = functionGetDateCustom();
             $timestamp;


           if (empty($imagecode)) { //NO viene con imagen

             $idpost;
             $noImage = "";
             $path = "";
             $sql = "INSERT INTO postallprofiles VALUES (?,?,?,?,?,?,?,?,?,?,?)"; //posible error ya q me falto el timestamp
             $stm = $conexion -> prepare ($sql);
               //i falta la i
             $stm -> bind_param('issssssssss',$idpost,$title,$description,$noImage,$path,$timestamp,$dateforApp,$name,$cargo,$imgurl,$profile); //11 columnas y -1 sin contar el timestamp
             //Solo ingrese 10 columnas

             if ($stm -> execute()) {

               echo "succesful";

             }else {
                   echo "nosuccesful";
             }


          }else {

            //el valor folder sera siguiendo el mismo que le llegara solo cambia el valor del profile

            $timeForPic = time();

            $path = "$folder/$email$timeForPic.jpg";
             //A donde va a ir a escribir, que es lo q va a poner
            file_put_contents($path,base64_decode($imagecode)); //Esto hace todo
           //Ya esto de abajo es la figura completa
            $imageDecode = file_get_contents($path); //Algo esta mal a largo plazo puede ser q este sea un error un fatal

             $id;

             $sql = "INSERT INTO postallprofiles VALUES (?,?,?,?,?,?,?,?,?,?,?)";//11 columnas

             $stm = $conexion -> prepare ($sql);
               //i falta la i
                 $stm -> bind_param('issssssssss',$idpost,$title,$description,$imageDecode,$path,$timestamp,$dateforApp,$name,$cargo,$imgurl,$profile);

             if ($stm -> execute()) {//True si hizo la inserccion

               echo "succesful";

             }else {
                   echo "nosuccesful"; //La sintaxis esta mal o no se conecto al servidor
             }

          }


       }else {

         echo "SomethingIsBadBad"; //Un error fatal de seguridad

       }

     function functionGetDateCustom(){ //FuncionDate

    date_default_timezone_set('America/Mexico_City');

    $dayMonthNumber =  date('j \d\e ');
    $yearinnumber =  date(' \d\e\l Y');
    $hour = date(' \a \l\a\s h:i A');

    switch ($day = date('l')) {
      case "Monday":
         $thisday = "Lunes";
        break;
      case "Tuesday":
           $thisday = "Martes";
          break;
      case "Wednesday":
             $thisday = "Miércoles";
            break;
      case "Thursday":
               $thisday = "Jueves";
              break;
      case "Friday":
              $thisday = "Viernes";
                break;
      case "Saturday":
             $thisday = "Sábado";
                break;
      case "Sunday":
            $thisday = "Domingo";
            break;
      default:
        echo "Day?";
        break;
    }

    switch ($Month = date('F')) {

      case "January":
         $thisMonth = "Enero";
        break;
      case "February":
           $thisMonth = "Febrero";
          break;
      case "March":
           $thisMonth = "Marzo";
              break;
      case "April":
             $thisMonth = "Abril";
            break;
      case "May":
               $thisMonth = "Mayo";
              break;
      case "June":
              $thisMonth = "Junio";
                break;
      case "July":
             $thisMonth = "Julio";
                break;
      case "August":
            $thisMonth = "Agosto";
            break;
      case "September":
             $thisMonth = "Septiembre";
            break;
        case "October":
            $thisMonth = "Octubre";
            break;
        case "November":
          $thisMonth = "Noviembre";
            break;
        case "December":
             $thisMonth = "Diciembre";
              break;
      default:
        echo "Month?";
           break;

    }

    return $thisday ." ". $dayMonthNumber .$thisMonth. $yearinnumber . $hour;

    //Retorna un string

}





 ?>
