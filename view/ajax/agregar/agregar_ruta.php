<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
require '../../../vendor/autoload.php';

$gump = new GUMP('en');

$gump->validation_rules([
	'STRNOM'    => 'required',
	
]);

$gump->set_fields_error_messages([
	'STRNOM'      => [
		'required' => 'El Nombre de la ruta es obligatorio',
		
	],
	'DOUKM'   => [
		'required' => 'Los kilometros  autorizados son obligatorios',
		'numeric' => 'El valor debe ser numerico',
		'min_numeric' => 'El numero de litros autorizdos debe ser mayor que 15 lts',
	]

]);
$gump->filter_rules([
	'STRNOM' => 'trim|sanitize_string',
	'DOUKM' => 'trim|sanitize_string'

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


	$STRNOM = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOM"], ENT_QUOTES)));
	$DOUKM = mysqli_real_escape_string($con, (strip_tags($_POST["DOUKM"], ENT_QUOTES)));
	$Fecha = date("Y-m-d");

    $sql="INSERT INTO
    `tblcatrut`( `STRNOM`, `DOUKM`, `DTHCRE`, `BITSUS`)
VALUES
    (
        '".$STRNOM."',
        '".$DOUKM."',
        '".$Fecha."',
        '1'
    );";
	$mensaje = insertarLog($sql, 'tblcatrut', 'Creacion', 'STRPRUT', '', '');
		(str_contains($mensaje, 'Error')===false) ? $messages[] = $mensaje : $errors[] = $mensaje;
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