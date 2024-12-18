<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor

    // Configuración de la base de datos
    $host = 'localhost';
    $user = 'sa01admin_Everardo';
    $password = '+UEUx[OG8ZI#';
    $dbName = 'sa01admin_taller';

    // Nombre del archivo de copia de seguridad
    $backupFile = 'copia_de_seguridad_' . date('Y-m-d_H-i-s') . '.sql';
    $backupZipFile = $backupFile . '.gz';

    // Crear la copia de seguridad y comprimirla
    exec("mysqldump -h $host -u $user -p$password $dbName | gzip > /home/sarusa01admin/public_html/$backupZipFile");
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'mail.syscarservice.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contacto@syscarservice.com';
    $mail->Password = 'V$#i)px$(';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 465;

    // Destinatarios
    $mail->setFrom('contacto@syscarservice.com', 'Fernanda Asturias');
    $mail->addAddress('r41325833@gmail.com', 'usuario');

    // Adjuntar archivo
    $mail->addAttachment('/home/sarusa01admin/public_html/'.$backupZipFile);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Copia de Seguridad de la Base de Datos';
    $mail->Body    = 'Adjunto encontrarás la copia de seguridad de la base de datos.';

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}
