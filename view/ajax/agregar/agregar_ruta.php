<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
require '../../../vendor/autoload.php';
$gump = new GUMP('en');

$gump->validation_rules([
	'STRNOM'    => 'required|alpha_numeric',
	'DOUKM'    => 'required|numeric|min_numeric,15',
]);

$gump->set_fields_error_messages([
	'STRNOM'      => [
		'required' => 'El Nombre de la ruta es obligatorio',
		'alpha_numeric' => 'El nombre debe ser alfanumerico',
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
	require_once("../../../config/RecuperarDatos.php"); //Contiene las variables de configuracion para conectar a la base de datos


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
	
	try {
		$query_new = mysqli_query($con, $sql);
		if ($query_new) {
			if ($query_new) {
				$id = mysqli_insert_id($con);
				$sql2 = recuperarDatos("SELECT * from tblcatrut WHERE 	STRPRUT ='$id';");
				$tabla = "tblcatrut";
				$tipo = "creacion";
				$fecha = date("Y-m-d H:i:s");

				$sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
				$query = mysqli_query($con, $sqllog);
				$messages[] = "Ruta agregada correctamente";
			}
		}
	} catch (mysqli_sql_exception $e) {
        $errors[]="Error al  agregar la Ruta";
		$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
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