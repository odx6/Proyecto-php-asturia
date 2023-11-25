<?php require_once("config.php");
// Importa las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once "../../../vendor/autoload.php";

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