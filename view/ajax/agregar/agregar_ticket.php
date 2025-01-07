<?php
//require 'vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$gump = new GUMP();

$gump->validation_rules([
    'STRPRE'    => 'required|numeric',
    'INTNO'    => 'required',
    'PCRXLIT'       => 'required|numeric|min_numeric,1',
    'LTS'      => 'required|numeric|min_numeric,1',
    'LOC' => 'required'

]);

$gump->set_fields_error_messages([
    'STRPRE'      => [
        'required' => 'El campo recorrido  es requerido',
        'numeric' => 'La clave del recorrido solo puede contener numeros'
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
    'STRPRE' => 'trim|sanitize_string',
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
    require_once("../../../config/RecuperarDatos.php");
    require_once("../../../config/funciones.php");

    $STRPRE = mysqli_real_escape_string($con, (strip_tags($valid_data["STRPRE"], ENT_QUOTES)));
    $INTNO = mysqli_real_escape_string($con, (strip_tags($valid_data["INTNO"], ENT_QUOTES)));
    $PCRXLIT = mysqli_real_escape_string($con, (strip_tags($valid_data["PCRXLIT"], ENT_QUOTES)));
    $LTS = mysqli_real_escape_string($con, (strip_tags($valid_data["LTS"], ENT_QUOTES)));
    $LOC = mysqli_real_escape_string($con, (strip_tags($valid_data["LOC"], ENT_QUOTES)));
    $DTEHOR = date("Y-m-d H:i:s");
    try {
        $recorrido = "SELECT * FROM `tblreco` WHERE STRPRE='" . $STRPRE . "'";
        $data = mysqli_query($con, $recorrido);

        $row = mysqli_fetch_array($data);
    } catch (mysqli_sql_exception $e) {
        $errors[] = " error al consultar el recorrido";
        $errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
    }
    

    try {
        $insert = "INSERT INTO
    `tblcattik`(
        `INTNO`,
        `STRPRUT`,
        `STRNMRSR`,
        `STRPRE`,
        `PCRXLIT`,
        `LTS`,
        `LOC`,
        `DTEHOR`
    )
VALUES
    (
        '" . $INTNO . "',
        '" . $row["STRPRUT"] . "',
        '" . $row["STRNMRSR"] . "',
        '" . $STRPRE . "',
        '" . $PCRXLIT . "',
        '" . $LTS . "',
        '" . $LOC . "',
        '" . $DTEHOR . "'
    );";
        $query_insert = mysqli_query($con, $insert);
        if ($query_insert) {
           
            $messages[] = "Se agrego el ticket correctamente";
            $id = mysqli_insert_id($con);
            $sql2 = recuperarDatos("SELECT * from tblcattik WHERE STRPTIK ='" . $id . "';");
            $tabla = "tblcattik";
            $tipo = "creacion";
            $fecha = date("Y-m-d H:i:s");

            $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
            $query = mysqli_query($con, $sqllog);

            ($query) ? $messages[] = "Se creo el log de resgistro" : $errors[] = "algo salio mal al crear el resgistro";

            ActualizarTickets($STRPRE,$row["STRPRUT"]);
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