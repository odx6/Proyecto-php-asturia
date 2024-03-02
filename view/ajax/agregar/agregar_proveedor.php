<?php
//require './vendor/autoload.php';
require '../../../vendor/autoload.php';
session_start();
$gump = new GUMP('en');

$gump->validation_rules([
    'STRRFC'    => 'required|alpha_numeric|max_len,13|min_len,12',
    'STRNOM'    => 'required|max_len,100|min_len,3',
    'STRDOM'       => 'required|alpha_numeric',
    'STRTEL'       => 'required|alpha_numeric',
    'STRNUMCUN'       => 'required|alpha_numeric',
    'STRNOMBAN'       => 'required|alpha_numeric',
    'STRCOR'       => 'required|valid_email',
    'STRCONT'       => 'required',
    'BITSUS' => 'required'
]);

$gump->set_fields_error_messages([
    'STRRFC'      => [
        'required' => 'El campo rfc es requerido',
        'alpha_numeric' => 'El campo solo puede contener letras y numeros',
        'min-len' => 'el minimo de caracteres para modelo es 12',
        'max-len' => 'el maximo de caracteres para modelo es 13'
    ],
    'STRNOM'   => [
        'required' => 'El campo nombre  es requerido',
        'min_len' => 'El minimo de caracteres para modelo es 3',
        'max_len' => 'El maximo  de caracteres para modelo es 100'
    ],

    'STRDOM'=>[
        'required'=>'El campo domicilio es requerido',
        'alpha_numeric'=>'El campo solo puede contener letras y numeros',

    ]
]);
$gump->filter_rules([
    'STRRFC' => 'trim|sanitize_string',
    'STRNOM' => 'trim|sanitize_string',
    'STRDOM' => 'trim|sanitize_string'

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
            echo $error."<br>";
        }
        ?>
    </div>

<?php


} else {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once("../../../config/RecuperarDatos.php");

    $STRRFC = mysqli_real_escape_string($con, (strip_tags($valid_data["STRRFC"], ENT_QUOTES)));
    $STRNOM = mysqli_real_escape_string($con, (strip_tags($valid_data["STRNOM"], ENT_QUOTES)));
    $STRDOM = mysqli_real_escape_string($con, (strip_tags($valid_data["STRDOM"], ENT_QUOTES)));
    $STRTEL = mysqli_real_escape_string($con, (strip_tags($valid_data["STRTEL"], ENT_QUOTES)));
    $STRNUMCUN = mysqli_real_escape_string($con, (strip_tags($valid_data["STRNUMCUN"], ENT_QUOTES)));
    $STRNOMBAN = mysqli_real_escape_string($con, (strip_tags($valid_data["STRNOMBAN"], ENT_QUOTES)));
    $STRCOR = mysqli_real_escape_string($con, (strip_tags($valid_data["STRCOR"], ENT_QUOTES)));
    $STRCONT = mysqli_real_escape_string($con, (strip_tags($valid_data["STRCONT"], ENT_QUOTES)));
    $BITSUS = mysqli_real_escape_string($con, (strip_tags($valid_data["BITSUS"], ENT_QUOTES)));
    $DTEHOR = date("Y-m-d H:i:s");

    try {
        $insert="INSERT INTO `tblcatprov`( `STRRFC`, `STRNOM`, `STRDOM`, `STRTEL`, `STRNUMCUN`, `STRNOMBAN`, `STRCOR`, `STRCONT`, `BITSUS`, `DTHOR`)
         VALUES ('".$STRRFC."','".$STRNOM."','".$STRDOM."','".$STRTEL."','".$STRNUMCUN."','".$STRNOMBAN."','".$STRCOR."','".$STRCONT."','".$BITSUS."','".$DTEHOR."');";
        $query_insert = mysqli_query($con, $insert);
        if ($query_insert) {
            $messages[] = "Se agrego provedor";
            $id = mysqli_insert_id($con);
            $sql2 = recuperarDatos("SELECT * from tblcatprov WHERE pk_prov='$id';");
            $tabla = "tblcatprov";
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
                    echo $error."<br>";
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
                    echo $message."<br>";
                }
                ?>
            </div>
        <?php
        }
}
?>