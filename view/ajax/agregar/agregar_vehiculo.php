<?php
//require './vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$gump = new GUMP();

$gump->validation_rules([
    'STRMAR'    => 'required|alpha_numeric|max_len,100|min_len,3',
    'STRMOD'    => 'required|max_len,100|min_len,3',
    'STRPLACAS'       => 'required',
    'STRTIPO'      => 'required',
    'BITSUS' => 'required'
]);

$gump->set_fields_error_messages([
    'STRMAR'      => [
        'required' => 'El campo marca es requerido',
        'alpha_numeric' => 'El campo solo puede contener letras y numeros',
        'min-len' => 'el minimo de caracteres para modelo es 3'
    ],
    'STRMOD'   => [
        'required' => 'El campo modelo es requerido',
        'min_len' => 'El minimo de caracteres para modelo es 3'
    ]
]);
$gump->filter_rules([
    'STRMAR' => 'trim|sanitize_string',
    'STRMOD' => 'trim|sanitize_string',
    'STRPLACAS' => 'trim|sanitize_string'

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

    $STRMAR = mysqli_real_escape_string($con, (strip_tags($valid_data["STRMAR"], ENT_QUOTES)));
    $STRMOD = mysqli_real_escape_string($con, (strip_tags($valid_data["STRMOD"], ENT_QUOTES)));
    $STRPLACAS = mysqli_real_escape_string($con, (strip_tags($valid_data["STRPLACAS"], ENT_QUOTES)));
    $STRTIPO = mysqli_real_escape_string($con, (strip_tags($valid_data["STRTIPO"], ENT_QUOTES)));
    $BITSUS = mysqli_real_escape_string($con, (strip_tags($valid_data["BITSUS"], ENT_QUOTES)));
    $DTEHOR = date("Y-m-d H:i:s");

    try {
        $insert = "INSERT INTO `tblcatmov`(`STRMAR`, `STRMOD`, `STRPLACAS`, `STRTIPO`, `BITSUS`, `DTHOR`) VALUES ('" . $STRMAR . "','" . $STRMOD . "','" . $STRPLACAS . "','" . $STRTIPO . "','" . $BITSUS . "','" . $DTEHOR . "');";
        $query_insert = mysqli_query($con, $insert);
        if ($query_insert) {
            $messages[] = "Se agrego el automovil";
            $id = mysqli_insert_id($con);
            $sql2 = recuperarDatos("SELECT * from tblcatmov WHERE pk_mov='$id';");
            $tabla = "tblcatmov";
            $tipo = "creacion";
            $fecha = date("Y-m-d H:i:s");

            $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
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