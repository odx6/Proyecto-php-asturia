<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
require '../../../vendor/autoload.php';
$gump = new GUMP('en');

$gump->validation_rules([
	'IDEMP'    => 'required|numeric',
	'STRNMRSR'    => 'required|alpha_numeric',
	'STRPRUT'    => 'required|numeric',
	'DTHCAP'    => 'required|date,Y/m/d',
	'KLMFIN'    => 'required|numeric|min_numeric,50'
]);

$gump->set_fields_error_messages([
	'IDEMP'      => [
		'required' => 'El operador es requerido',
		'numeric' => 'La clave del operador debe ser numerica',
	],
	'STRNMRSR'   => [
		'required' => 'El automovil es obligatorio',
		'alpha_numeric' => 'La clave del automovil debe ser alfa numerica'
    ],
    'STRPRUT'   => [
		'required' => 'La  ruta es requerida y obligatoria',
		'alpha_numeric' => 'La clave de la ruta debe ser numerica'
	],
    'DTHCAP'   => [
		'required' => 'La  fecha es obligatoria',
		'date' => 'La fecha debe estar en formato aaa/mm/dd'
    ],
    'KLMFIN'   => [
		'required' => 'Los kilometros finales son requeridos',
		'numeric' => 'Los kilometros deben ser numericos',
		'min_numeric,50' => 'Los kilometros deben superar los 50 km para ser validos',
	]

]);
$gump->filter_rules([
	'IDEMP' => 'trim|sanitize_string',
	'STRNMRSR' => 'trim|sanitize_string',
	'STRPRUT' => 'trim|sanitize_string',
	'DTHCAP' => 'trim|sanitize_string',
	'KLMFIN' => 'trim|sanitize_string'

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


	$IDEMP = mysqli_real_escape_string($con, (strip_tags($_POST["IDEMP"], ENT_QUOTES)));
	$STRNMRSR = mysqli_real_escape_string($con, (strip_tags($_POST["STRNMRSR"], ENT_QUOTES)));
	$STRPRUT = mysqli_real_escape_string($con, (strip_tags($_POST["STRPRUT"], ENT_QUOTES)));
	$DTHCAP = mysqli_real_escape_string($con, (strip_tags($_POST["DTHCAP"], ENT_QUOTES)));
	$KLMFIN = mysqli_real_escape_string($con, (strip_tags($_POST["KLMFIN"], ENT_QUOTES)));
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