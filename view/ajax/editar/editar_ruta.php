<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
require '../../../vendor/autoload.php';
$gump = new GUMP('en');

$gump->validation_rules([
	'id'    => 'required|numeric',
	'STRNOM'    => 'required',
	'DOUKM'    => 'required|numeric|min_numeric,15',
	'BITSUS'    => 'required|numeric',
]);

$gump->set_fields_error_messages([
    'id'      => [
		'required' => 'La clave primaria de la ruta a editar es obligatoria',
		'numeric' => 'La clave primaria debe ser numerica',
	],
	'STRNOM'      => [
		'required' => 'El Nombre de la ruta es obligatorio',
	],
	'DOUKM'   => [
		'required' => 'Los kilometros  autorizados son obligatorios',
		'numeric' => 'El valor debe ser numerico',
		'min_numeric' => 'El numero de litros autorizdos debe ser mayor que 15 lts',
    ],
    'BITSUS'   => [
		'required' => 'El Estado de la ruta es requerido',
		'numeric' => 'El valor del estado  debe ser numerico',
		
	]

]);
$gump->filter_rules([
	'id' => 'trim|sanitize_string',
	'STRNOM' => 'trim|sanitize_string',
	'DOUKM' => 'trim|sanitize_string',
	'BITSUS' => 'trim|sanitize_string'

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
	$STRNOM = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOM"], ENT_QUOTES)));
	$DOUKM = mysqli_real_escape_string($con, (strip_tags($_POST["DOUKM"], ENT_QUOTES)));
	$BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));
	$Fecha = date("Y-m-d");

    $sql="UPDATE
    `tblcatrut`
SET
  
    `STRNOM` = '".$STRNOM."',
    `DOUKM` = '".$DOUKM."',
   
    `BITSUS` = '".$BITSUS."'
WHERE
    STRPRUT='".$id."' ;";
	$oldata=recuperarDatos("SELECT * from tblcatrut WHERE 	STRPRUT ='$id';");
    $mensaje = insertarLog($sql, 'tblcatrut', 'Actualizacion', 'STRPRUT', $id,$oldata);
    (str_contains($mensaje, 'Error') === false) ? $messages[] = $mensaje : $errors[] = $mensaje;
	
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