<?php
//require 'vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$gump = new GUMP();

$gump->validation_rules([
    'id'    => 'required|numeric',
    'INTNO'    => 'required',
    'PCRXLIT'       => 'required|numeric|min_numeric,1',
    'LTS'      => 'required|numeric|min_numeric,1',
    'LOC' => 'required'

]);

$gump->set_fields_error_messages([
    'id'      => [
        'required' => 'La clave primaria del ticket  es requerido',
        'numeric' => 'La clave del ticket solo puede contener numeros'
    ],
    'INTNO'   => [
        'required' => 'El campo N° de ticket es requerido'

    ],
    'PCRXLIT' => [
        'required' => 'el campo precio por litro  es requerido',
        'numeric' => 'el valor debe ser numerico',
        'min_numeric' => 'el valor debe ser mayor a 1 numerico'



    ],
    'LTS' => [
        'required' => 'El capmpo N° de litros es requerido',
        'numeric' => 'El capmpo N° debe ser numerico',
        'numeric' => 'El capmpo N° debe litros debe ser mayor a 1lt'
    ],
    'numeric' => 'El capmpo N° debe ser numerico',
    'LOC' => [
        'required' => 'El capmpo modelo es requerido',

    ],


]);
$gump->filter_rules([
    'id' => 'trim|sanitize_string',
    'INTNO' => 'trim|sanitize_string',
    'PCRXLIT' => 'trim|sanitize_string',
    'LTS' => 'trim|sanitize_string',
    'LOC' => 'trim|sanitize_string'

]);
$valid_data = $gump->run($_POST);


?>
<?php
if ($gump->errors()) {
?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        $array = $gump->get_readable_errors();
        foreach ($array as $error) {
            echo $error;
        }
        ?>
    </div>

    <?php


} else {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once("../../../config/funciones.php");

    $id = mysqli_real_escape_string($con, (strip_tags($valid_data["id"], ENT_QUOTES)));
    $INTNO = mysqli_real_escape_string($con, (strip_tags($valid_data["INTNO"], ENT_QUOTES)));
    $PCRXLIT = mysqli_real_escape_string($con, (strip_tags($valid_data["PCRXLIT"], ENT_QUOTES)));
    $LTS = mysqli_real_escape_string($con, (strip_tags($valid_data["LTS"], ENT_QUOTES)));
    $LOC = mysqli_real_escape_string($con, (strip_tags($valid_data["LOC"], ENT_QUOTES)));

        $insert = "UPDATE
    `tblcattik`
SET
    `INTNO` = '" . $INTNO . "',
    `PCRXLIT` = '" . $PCRXLIT . "',
    `LTS` = '" . $LTS . "',
    `LOC` = '" . $LOC . "'
WHERE
     STRPTIK='" . $id . "'";
     $oldata=recuperarDatos("SELECT * from tblcattik WHERE STRPTIK ='" . $id . "';");
     $mensaje = insertarLog($insert, 'tblcattik', 'Actualizacion', 'STRPTIK', $id,$oldata);
     (str_contains($mensaje, 'Error') === false) ? $messages[] = $mensaje : $errors[] = $mensaje;

    if (isset($errors)) {

    ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong>
            <?php
            foreach ($errors as $error) {
                echo $error;
            }
            ?>
        </div>
    <?php
    }
    if (isset($messages)) {

    ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Bien hecho!</strong>
            <?php
            foreach ($messages as $message) {
                echo $message;
            }
            ?>
        </div>
<?php
    }
}
?>