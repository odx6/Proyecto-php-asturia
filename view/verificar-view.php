<?php
// Importa las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga el autoloader de Composer
require './vendor/autoload.php';

// Crea una nueva instancia de PHPMailer
$mail = new PHPMailer(TRUE);
$token = md5(rand());
$correo = "r41325833@gmail.com";
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
    $mail->setFrom('r41325833@gmail.com', 'Everardo');
    $mail->addAddress('r41325833@gmail.com', 'usuario');

    // Configura el cuerpo del correo electrónico
    $mail->isHTML(TRUE);
    $mail->Subject = 'El asunto';
    $mail->Body = "Haz clic en el siguiente enlace para verificar tu correo electrónico : HTML http://localhost:8080/proyecto/?view=validacion&token=$token&correo=$correo";
    $mail->AltBody = "Haz clic en el siguiente enlace para verificar tu correo electrónico : HTML http://localhost:8080/proyecto/?view=verificar?token='$token'?correo='$correo' ";

    $mail->send();
    echo "El correo electrónico se envió correctamente.";
} catch (Exception $e) {
    // Muestra un mensaje de error si algo sale mal
    echo "El correo electrónico no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
}
