<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
require '../../../vendor/autoload.php';
$gump = new GUMP('en');

$gump->validation_rules([
	'IDEMP'    => 'required|numeric',
	'STRNMRSR'    => 'required|alpha_numeric',
	'STRPRUT'    => 'required|numeric',
	'DTHCAP'    => 'required',
	'KLMFIN'    => 'required|min_numeric,50',
	'KLMINI'    => 'required|min_numeric,1',
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

	],
	'KLMFIN'   => [
		'required' => 'Los kilometros finales son requeridos',
		'numeric' => 'Los kilometros deben ser numericos',
		'min_numeric,50' => 'Los kilometros deben superar los 50 km para ser validos',
	],
	'KLMINI'   => [
		'required' => 'Los kilometros iniciales son requeridos',
		'min_numeric,50' => 'Los kilometros deben superar los 1 km para ser validos',
	]

]);
$gump->filter_rules([
	'IDEMP' => 'trim|sanitize_string',
	'STRNMRSR' => 'trim|sanitize_string',
	'STRPRUT' => 'trim|sanitize_string',
	'DTHCAP' => 'trim|sanitize_string',
	'KLMFIN' => 'trim|sanitize_string',
	'KLMINI' => 'trim|sanitize_string'

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


	$IDEMP = mysqli_real_escape_string($con, (strip_tags($_POST["IDEMP"], ENT_QUOTES)));
	$STRNMRSR = mysqli_real_escape_string($con, (strip_tags($_POST["STRNMRSR"], ENT_QUOTES)));
	$STRPRUT = mysqli_real_escape_string($con, (strip_tags($_POST["STRPRUT"], ENT_QUOTES)));
	$DTHCAP = mysqli_real_escape_string($con, (strip_tags($_POST["DTHCAP"], ENT_QUOTES)));
	$KLMFIN = mysqli_real_escape_string($con, (strip_tags($_POST["KLMFIN"], ENT_QUOTES)));
	$KLMINIC = mysqli_real_escape_string($con, (strip_tags($_POST["KLMINI"], ENT_QUOTES)));
	$Fecha = date("Y-m-d");
	$min_klm = 0;

	$ultimo_registro = "SELECT * 
FROM tblreco  WHERE STRNMRSR='" . $STRNMRSR . "'
ORDER BY STRPRE DESC 
LIMIT 1;";

	try {
		$query_kilometraje = mysqli_query($con, $ultimo_registro);
	} catch (mysqli_sql_exception $e) {
		$errors[] = "Error al consultar los datos";
		$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
	}
	$num = mysqli_num_rows($query_kilometraje);
	if ($num  > 0) {
		$row = mysqli_fetch_array($query_kilometraje);
		$min_klm = $row['KLMFIN'];
	}else{
		$min_klm=0;
	}

	if ($KLMINIC > 0 && $KLMFIN > 0 && $KLMFIN >= $KLMINIC && $KLMINIC >= $min_klm) {
		$KLMRECO = $KLMFIN - $KLMINIC;
		$FINAL = $KLMFIN;
		$sql = "INSERT INTO
    `tblreco`(
        `IDEMP`,
        `STRNMRSR`,
        `STRPRUT`,
        `KLMFIN`,
        `KLMINI`,
        `KLMRECO`,
        `DOUREN`,
        `INPRT`,
        `DOUCON`,
        `DOUDIF`,
        `DOUDIFLTS`,
        `DOUDES`,
        `DTHCAP`,
        `DTHOR`
    )
VALUES
    (
        '" . $IDEMP . "',
        '" . $STRNMRSR . "',
        '" . $STRPRUT . "',
        '" . $FINAL . "',
        '" . $KLMINIC . "',
        '" . $KLMRECO . "',
        '0',
        '0',
        '0',
        '0',
        '0',
        '0',
        '" . $DTHCAP . "',
        '" . $Fecha . "'
   );";
   $mensaje = insertarLog($sql, 'tblreco', 'creacion', 'STRPRE', '', '');
   (str_contains($mensaje, 'Error')===false) ? $messages[] = $mensaje : $errors[] = $mensaje;

	} else {
		$errors[] = "Los kilometrajes no pueden ser menores al ultimo registro";
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