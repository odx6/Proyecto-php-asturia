<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
require '../../../vendor/autoload.php';
$gump = new GUMP('en');

$gump->validation_rules([
    'id'    => 'required|numeric',
    'checador'    => 'required|numeric',
    'descuento'    => 'required',

]);

$gump->set_fields_error_messages([
    'id'      => [
        'required' => 'La clave es requerida',
        'numeric' => 'La clave del recorrido  debe ser numerica',
    ],
    'checador'      => [
        'required' => 'El  auditor es requerido',
        'numeric' => 'La clave del auditor es requerida debe ser numerica',
    ],
    'descuento'      => [
        'required' => 'El  descuento   es requerido',
       
    ]
]);
$gump->filter_rules([
    'id' => 'trim|sanitize_string',
    'checador' => 'trim|sanitize_string',
    'descuento' => 'trim|sanitize_string',

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
            echo $error . "<br>";
        }
        ?>
    </div>

<?php


} else {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once("../../../config/funciones.php"); //Contiene las variables de configuracion para conectar a la base de datos


    $id = mysqli_real_escape_string($con, (strip_tags($_POST["id"], ENT_QUOTES)));
    $checador = mysqli_real_escape_string($con, (strip_tags($_POST["checador"], ENT_QUOTES)));
    $descuento = mysqli_real_escape_string($con, (strip_tags($_POST["descuento"], ENT_QUOTES)));
     
    $sql="UPDATE
    `tblreco`
SET
   
    `FINISH` = '1',
    `EVALUATOR` = '".$checador."',
    `DOUDES` = '".$descuento."' 
  
WHERE
    
    `STRPRE` = '".$id."'";



  if(isset($sql)){
    $oldata=recuperarDatos("SELECT * from tblreco WHERE 	 STRPRE='$id';");
    $mensaje = insertarLog($sql, 'tblreco', 'closed', 'STRPRE', $id,$oldata);
    (str_contains($mensaje, 'Error') === false) ? $messages[] = $mensaje : $errors[] = $mensaje;
  }else{
  $errors[]="Verificar  que el kilometraje inicial sea menor al final o el kilometraje inicial sea mayor a ".$min_klm;
  }
    
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
?>