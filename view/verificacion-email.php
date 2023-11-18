<?php


$mail = trim($_POST['mail']);
$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errores .= "Correo electrónico no válido </br>";
} else {
    $destinatario = $mail;
    $titulo = 'Verifica tu correo';
    $mensaje = "<html><head><title>Verifica tu correo</title></head><body><p>Bienvenido,</p></body></html>";
    $cabeceras = 'MIME-Version: 1.0' . "\\r\\n";
    $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\\r\\n";
    $cabeceras .= "To: $para" . "\\r\\n";
    $cabeceras .= 'From: LaXtore <noreply@laXtore.com>' . "\\r\\n";

    mail($para, $titulo, $mensaje, $cabeceras);
}


?>
<?php
// Genera un token único
$token = md5(rand());

// Guarda el token en la base de datos

// Envía un correo electrónico de verificación al usuario
$to = $email;
$subject = "Verificación de correo electrónico";
$message = "Haz clic en el siguiente enlace para verificar tu correo electrónico: www.tusitio.com/verificar.php?token=".$token;
$headers = "From: noreply@tusitio.com";

mail($to, $subject, $message, $headers);

echo "Se ha enviado un correo electrónico de verificación a tu dirección de correo electrónico. Por favor, verifica tu correo electrónico.";
?>