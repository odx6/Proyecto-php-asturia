<?php
//require './vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$gump = new GUMP();

$gump->validation_rules([
     'id' => 'required',
    'STRMAR'    => 'required|alpha_numeric|max_len,100|min_len,3',
    'STRMOD'    => 'required|max_len,100|min_len,3',
    'STRPLACAS'       => 'required',
    'STRTIPO'      => 'required',
    'BITSUS' => 'required'
]);

$gump->set_fields_error_messages([
    'id'=>['required'=>'Campo requerido para la actualizacion de datos'],
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


    $id=intval($valid_data["id"]);
    $STRMAR = mysqli_real_escape_string($con, (strip_tags($valid_data["STRMAR"], ENT_QUOTES)));
    $STRMOD = mysqli_real_escape_string($con, (strip_tags($valid_data["STRMOD"], ENT_QUOTES)));
    $STRPLACAS = mysqli_real_escape_string($con, (strip_tags($valid_data["STRPLACAS"], ENT_QUOTES)));
    $STRTIPO = mysqli_real_escape_string($con, (strip_tags($valid_data["STRTIPO"], ENT_QUOTES)));
    $BITSUS = mysqli_real_escape_string($con, (strip_tags($valid_data["BITSUS"], ENT_QUOTES)));
    $DTEHOR = date("Y-m-d H:i:s");
    $oldata=recuperarDatos("SELECT * from tblcatmov WHERE pk_mov='$id';");

    try {
        $update = "UPDATE `tblcatmov` SET `STRMAR`='".$STRMAR."',`STRMOD`='".$STRMOD."',`STRPLACAS`='".$STRPLACAS."',`STRTIPO`='".$STRTIPO."',`BITSUS`='".$BITSUS."' WHERE pk_mov='$id';";
        $query_update = mysqli_query($con, $update);
        if ($query_update) {
            $messages[] = "Se actualizo el vehiculo";
            $ide=$id;
            $sql2 = recuperarDatos("SELECT * from tblcatmov WHERE pk_mov='$id';");
            $tabla = "tblcatmov";
            $tipo = "Actualizacion";
            $fecha = date("Y-m-d H:i:s");

            $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha .  "','".$oldata."','" . $sql2 . "');";
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