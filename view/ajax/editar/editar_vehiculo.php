<?php
//require './vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$gump = new GUMP();

$gump->validation_rules([
    'STRNMRSR'    => 'required|alpha_numeric|max_len,100|min_len,3',
    'STRNMR'    => 'required|alpha_numeric|max_len,100|min_len,3',
    'STRMRC'       => 'required',
    'STRMDL'      => 'required',
    'STRPLC' => 'required',
    'DOKLM' => 'required|numeric|min_numeric,1'
]);

$gump->set_fields_error_messages([
    'STRNMRSR'      => [
        'required' => 'El campo marca es requerido',
        'alpha_numeric' => 'El campo solo puede contener letras y numeros',
        'min-len' => 'el minimo de caracteres para modelo es 3'
    ],
    'STRNMR'   => [
        'required' => 'El campo modelo es requerido',
        'min_len' => 'El minimo de caracteres para modelo es 3'
    ],
    'STRMRC' => [
        'required' => 'el campo numero es requerido',
        'numeric' => 'el valor debe ser numerico'



    ],
    'DOKLM'=>[
         'required'=>'El capmpo modelo es requerido',
         'numeric'=>'El campo kilometros debe ser numerico',
         'min_numeric'=>'El campo kilometros debe ser mayor a 1',
    ],


]);
$gump->filter_rules([
    'STRNMRSR' => 'trim|sanitize_string',
    'STRNMR' => 'trim|sanitize_string',
    'STRPLC' => 'trim|sanitize_string'

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
    require_once("../../../config/RecuperarDatos.php");


    $id = $valid_data["id"];
    $STRNMRSR = mysqli_real_escape_string($con, (strip_tags($valid_data["STRNMRSR"], ENT_QUOTES)));
    $STRNMR = mysqli_real_escape_string($con, (strip_tags($valid_data["STRNMR"], ENT_QUOTES)));
    $STRMRC = mysqli_real_escape_string($con, (strip_tags($valid_data["STRMRC"], ENT_QUOTES)));
    $STRMDL = mysqli_real_escape_string($con, (strip_tags($valid_data["STRMDL"], ENT_QUOTES)));
    $STRPLC = mysqli_real_escape_string($con, (strip_tags($valid_data["STRPLC"], ENT_QUOTES)));
    $STRTPVH = mysqli_real_escape_string($con, (strip_tags($valid_data["STRTPVH"], ENT_QUOTES)));
    $LNGIDNORG = mysqli_real_escape_string($con, (strip_tags($valid_data["LNGIDNORG"], ENT_QUOTES)));
    $DOKLM = mysqli_real_escape_string($con, (strip_tags($valid_data["DOKLM"], ENT_QUOTES)));
    $BITSUS = mysqli_real_escape_string($con, (strip_tags($valid_data["BITSUS"], ENT_QUOTES)));
    $DTEHOR = date("Y-m-d H:i:s");
    $oldata = recuperarDatos("SELECT * from tblcatveh WHERE STRNMRSR='$id';");

    try {
      
            $update = "UPDATE `tblcatveh` SET
             `STRNMRSR`='" . $STRNMRSR . "',
             `STRNMR`='" . $STRNMR . "',
            `STRMRC`='" . $STRMRC . "',
            `STRMDL`='" . $STRMDL . "',
            `STRPLC`='" . $STRPLC . "',
            `STRTPVH`='" . $STRTPVH . "',
            `LNGIDNORG`='" . $LNGIDNORG . "',
            `DOKLM`='" . $DOKLM . "',
            `BITSUS`='" . $BITSUS . "' 
             WHERE STRNMRSR='$id';";
            
      

        $query_update = mysqli_query($con, $update);
        if ($query_update) {
            $messages[] = "Se actualizo el vehiculo";
            $ide = $STRNMRSR;
            $sql2 = recuperarDatos("SELECT * from tblcatveh WHERE STRNMRSR='$ide';");
            $tabla = "tblcatveh";
            $tipo = "Actualizacion";
            $fecha = date("Y-m-d H:i:s");

            $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha .  "','" . $oldata . "','" . $sql2 . "');";
            $query = mysqli_query($con, $sqllog);

            ($query) ? $messages[] = "Se creo el log de resgistro" : $errors[] = "algo salio mal al crear el resgistro";
        } else {

            $errors[] = "No se pudo agregar el vehiculo";
        }
    } catch (mysqli_sql_exception $e) {

        $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
    }

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