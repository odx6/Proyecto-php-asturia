<?php
require_once("config.php");
// Importa las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga el autoloader de Composer
  include_once "../../../vendor/autoload.php";

// Crea una nueva instancia de PHPMailer
function  consultarNombre($id,$tabla,$columna,$columnaN){
    //@param $id es el id por el cual buscar
    //@param $tabla es el nombre de la tabla la cual buscar
    //@columnaN es el nombre de la columna que almacena a los ides
    //@param columna  es el nombre de la columna que tiene el nombre 

if(isset($id) && isset($tabla) && isset($columna) && isset($columnaN)){
    $id = intval($id);
   global $con;
    
    $sql="SELECT $columnaN FROM $tabla WHERE $columna='$id';";
  
    if (isset($id) && $id != NULL) {
      $resultado = mysqli_query($con,$sql);
  
      if (isset($resultado) && $resultado != NULL) {
          $tem = mysqli_fetch_array($resultado);
          if (isset($tem) && $tem != NULL) {
            $nombre = $tem[$columnaN];

         echo  $nombre;
          }else{
            echo $id;
          }
      }
  }
  
  }else{
     echo $id;
  }


}





function  verificacionDeCorreo($correo,$token){
  $mail = new PHPMailer(TRUE);
  $boleean="false";
  if(isset($correo) && isset($token)){

    try {
      // Configura el servidor de correo
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = TRUE;
      $mail->SMTPSecure = 'tls';
      $mail->Username = 'r41325833@gmail.com';
      $mail->Password = 'nfxd egav zhgn snha';
      $mail->Port = 587;
  
      // Configura los encabezados del correo electrónico
      $mail->setFrom('r41325833@gmail.com', 'Asturias');
      $mail->addAddress($correo, 'usuario');
  
      // Configura el cuerpo del correo electrónico
      $mail->isHTML(TRUE);
      $mail->Subject = 'verificacion de correo';
      //$mail->Body = "Haz clic en el siguiente enlace para verificar tu correo electrónico : HTML http://localhost:8080/proyecto/?view=validacion&token=$token&correo=$correo";
        $mail->Body = "Haz clic en el siguiente enlace para verificar tu correo electrónico : HTML https://romasa.000webhostapp.com/validacion&token=$token&correo=$correo";
      $mail->AltBody = "Haz clic en el siguiente enlace para verificar tu correo electrónico : HTML http://localhost:8080/proyecto/?view=verificar?token='$token'?correo='$correo' ";
      $mail->send();
      $boleean="true";
      return $boleean;
  } catch (Exception $e) {
      // Muestra un mensaje de error si algo sale mal
      return $boleean;
      echo "El correo electrónico no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
  }
  }
  }

  

?>

