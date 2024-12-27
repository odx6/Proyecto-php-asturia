<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado	
require '../../../vendor/autoload.php';
$gump = new GUMP('en');

$gump->validation_rules([
	'LNGIDNSLC'    => 'required|numeric',
	'OLDLNGIDNSLC'    => 'required|numeric',
	'LNGIDNUSR'    => 'required|numeric',
	'LNGIDNCNT'       => 'required|numeric',
	'LNGIDNMCN'       => 'required|numeric',
	'LNGIDNORG'       => 'required|numeric',
	'STRNMRSR'       => 'required|alpha_numeric',
	'DTFCHSLC'       => 'required',
	'DTFCHDGN'       => 'required',
	'STRKLM' => 'required|numeric',
	'STROBSRPT' => 'required',
	'STRDGN' => 'required',
	'BITCNCSLC' => 'required',
]);

$gump->set_fields_error_messages([
	'LNGIDNSLC'      => [
		'required' => 'El campo de quien hace el registro es requerido es requerido',
		'numeric' => 'el capturista es invalido',
	],
	'LNGIDNUSR'   => [
		'required' => 'El campo capturista  es requerido',
		'numeric' => 'El capturista es invalido',
	],

	'LNGIDNCNT' => [
		'required' => 'El campo contacto es requerido',
		'numeric' => 'Clave de contacto debe ser numerico',

	],
	'LNGIDNMCN' => [
		'required' => 'la clave del mecanico es obligatoria',
		'numeric' => 'Clave de mecanico debe ser numerico',

	],
	'LNGIDNORG' => [
		'required' => 'la clave de la organizacion  es obligatoria',
		'numeric' => 'Clave de organizacion   debe ser numerico',

	],
	'STRNMRSR' => [
		'required' => 'El NO. de serie del vehiculo es requerido',
		'alpha_numeric' => 'La clave del vehiculo debe ser alphanumerica',

	],
	'DTFCHSLC' => [
		'required' => 'El diagnostico es requerido'

	],
	'DTFCHDGN' => [
		'required' => 'La fecha de diagnostico es requerida'

	],
	'STRKLM' => [
		'required' => 'Los kilometros son obligatorios',
		'numeric' => 'Los kilometros deben ser numericos'

	],
	'STROBSRPT' => [
		'required' => 'Las observaciones son obligatorias',


	],

	'BITCNCSLC' => [
		'required' => 'El Estado de la solicitud  es requerido',


	],
	'OLDLNGIDNSLC' => [
		'required' => 'Se requiere  la organizacion antigua para poder actualizar el registro',
		'numeric' => 'El valor de la clave primaria debe ser numerico'



	],
	'OLDFOL' => [
		'required' => 'Se requiere  el folio para la cancelacion antigua para poder actualizar el registro',
		'numeric' => 'El valor de la clave del folio  primaria debe ser numerico'



	],
	
]);
$gump->filter_rules([
	'LNGIDNSLC' => 'trim|sanitize_string',
	'LNGIDNUSR' => 'trim|sanitize_string',
	'LNGIDNCNT' => 'trim|sanitize_string',
	'LNGIDNMCN' => 'trim|sanitize_string',
	'LNGIDNORG' => 'trim|sanitize_string',
	'STRNMRSR' => 'trim|sanitize_string',
	'DTFCHSLC' => 'trim|sanitize_string',
	'DTFCHDGN' => 'trim|sanitize_string',
	'STRKLM' => 'trim|sanitize_string',
	'STROBSRPT' => 'trim|sanitize_string',
	'STRDGN' => 'trim|sanitize_string',
	'BITCNCSLC' => 'trim|sanitize_string',
	'OLDLNGIDNSLC' => 'trim|sanitize_string',
	'OLDFOL' => 'trim|sanitize_string',

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

	// escaping, additionally removing everything that could be (html/javascript-) code
	$LNGIDNSLC = mysqli_real_escape_string($con, (strip_tags($_POST["LNGIDNSLC"], ENT_QUOTES)));
	$LNGIDNUSR = mysqli_real_escape_string($con, (strip_tags($_POST["LNGIDNUSR"], ENT_QUOTES)));
	$LNGIDNCNT = mysqli_real_escape_string($con, (strip_tags($_POST["LNGIDNCNT"], ENT_QUOTES)));
	$LNGIDNMCN = mysqli_real_escape_string($con, (strip_tags($_POST["LNGIDNMCN"], ENT_QUOTES)));
	$LNGIDNORG = mysqli_real_escape_string($con, (strip_tags($_POST["LNGIDNORG"], ENT_QUOTES)));
	$STRNMRSR = mysqli_real_escape_string($con, (strip_tags($_POST["STRNMRSR"], ENT_QUOTES)));
	$DTFCHSLC = mysqli_real_escape_string($con, (strip_tags($_POST["DTFCHSLC"], ENT_QUOTES)));
	$DTFCHDGN = mysqli_real_escape_string($con, (strip_tags($_POST["DTFCHDGN"], ENT_QUOTES)));
	$STRKLM = mysqli_real_escape_string($con, (strip_tags($_POST["STRKLM"], ENT_QUOTES)));
	$STROBSRPT = mysqli_real_escape_string($con, (strip_tags($_POST["STROBSRPT"], ENT_QUOTES)));
	$STRDGN = mysqli_real_escape_string($con, (strip_tags($_POST["STRDGN"], ENT_QUOTES)));
	$BITCNCSLC = mysqli_real_escape_string($con, (strip_tags($_POST["BITCNCSLC"], ENT_QUOTES)));
	$OLDLNGIDNSLC = mysqli_real_escape_string($con, (strip_tags($_POST["OLDLNGIDNSLC"], ENT_QUOTES)));
	$OLDFOL = mysqli_real_escape_string($con, (strip_tags($_POST["OLDFOL"], ENT_QUOTES)));
	$Fecha = date("Y-m-d H:i:s");
	$id = intval($_POST['LNGIDNSLC']);

	$oldata = recuperarDatos("SELECT * from tblcatslc WHERE LNGIDNSLC='$id';");

	if ($OLDLNGIDNSLC == $LNGIDNORG) {
		$sql = "UPDATE tblcatslc SET LNGIDNUSR='" . $LNGIDNUSR . "',
	LNGIDNCNT='" . $LNGIDNCNT . "', 
	LNGIDNMCN='" . $LNGIDNMCN . "', 
	LNGIDNORG='" . $LNGIDNORG . "',
	STRNMRSR='" . $STRNMRSR . "',
	 DTFCHSLC='" . $DTFCHSLC . "',
	  DTFCHDGN='" . $DTFCHDGN . "',
	  STRKLM='" . $STRKLM . "',
	  STROBSRPT='" . $STROBSRPT . "',
	   STRDGN='" . $STRDGN . "',
	   BITCNCSLC='" . $BITCNCSLC . "',
		WHERE LNGIDNSLC='" . $id . "' ";
	} else {
		//cancel folio
		$cancelarFolio="UPDATE `tblcatfol` SET `estado`='0' WHERE id_folio='".$OLDFOL."'";
		try {
			$FolioCancelado = mysqli_query($con, $cancelarFolio);
		} catch (mysqli_sql_exception $e) {
			$error[]="error al cancelar el folio";
			$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
		}

		//
		//insertar folio specific
		$sqlNumFolEsp = "SELECT COUNT(*) AS Especifico FROM tblcatfol WHERE tipo_folio= 'ESPECIFICO' and id_empresa='" . $LNGIDNORG . "';";
		try {
			$query_folios_especificos = mysqli_query($con, $sqlNumFolEsp);
		} catch (mysqli_sql_exception $e) {
			$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
		}
		if ($query_folios_especificos && mysqli_num_rows($query_folios_especificos) > 0) {
			$fila = mysqli_fetch_assoc($query_folios_especificos);
			$FolioEspecifico = $fila['Especifico'];
			$FolioEspecifico = $FolioEspecifico + 1;
		} else {
			$error[] = "Error al consultar  Folio Especifico";
		}
		$sqlEspecifico = "INSERT INTO 
		`tblcatfol`(`id_empresa`, `folio`, `tipo_folio`, `fecha_creacion`) 
		VALUES ('" . $LNGIDNORG . "','" . $FolioEspecifico . "','ESPECIFICO','" . $Fecha . "');";
		try {
			$sqlFolioE = mysqli_query($con, $sqlEspecifico);
		} catch (mysqli_sql_exception $e) {
			$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
		}

		if ($sqlFolioE) {
			$idFolioEspecifico = mysqli_insert_id($con);
		}
		//endfolioEspecifico 


		$sql = "UPDATE
  `tblcatslc`
SET
  `LNGIDNUSR` = '" . $LNGIDNUSR . "',
  `INTFOLSLCE` = '" . $idFolioEspecifico . "',
  `DTFCHSLC` = '" . $DTFCHSLC . "',
  `LNGIDNORG` = '" . $LNGIDNORG . "',
  `STRNMRSR` = '" . $STRNMRSR . "',
  `STRKLM` = '" . $STRKLM . "',
  `STROBSRPT` = '" . $STROBSRPT . "',
  `STRDGN` = '" . $STRDGN . "',
  `LNGIDNMCN` = '".$LNGIDNMCN."',
  `DTFCHDGN` = '".$DTFCHDGN."',
  `BITCNCSLC` = '" . $BITCNCSLC . "',
  `LNGIDNCNT` = '" . $LNGIDNCNT . "'
 WHERE LNGIDNSLC='" . $id . "'";
	}


	try {
		$query = mysqli_query($con, $sql);
	} catch (mysqli_sql_exception $e) {

		$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
	}

	//
	if ($query) {
		$sql2 = recuperarDatos("SELECT * from tblcatslc WHERE LNGIDNSLC='$id';");
		$tabla = "tblcatslc";
		$tipo = "Actualizacion";
		$fecha = date("Y-m-d H:i:s");

		$sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $oldata . "','" . $sql2 . "');";
		$query = mysqli_query($con, $sqllog);
		$messages[] = "Producto actualizado correctamente";
	}

	//Verifico que el campo de la contraseña no este vacia by Amner Saucedo Sosa





	
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