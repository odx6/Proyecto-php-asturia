<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty(trim($_POST['STRNOMSBC']))) {
	$errors[] = "Nombre está vacío.";
} elseif (empty(trim($_POST['STRDESBC']))) {
	$errors[] = "Descripcion  está vacío.";
} elseif (empty($_POST['BITSUS'])) {
	$errors[] = "Estado está vacío.";
} elseif (empty($_POST['INTIDCAT'])) {
	$errors[] = "Estado está vacío.";
} elseif (
	!empty($_POST['STRNOMSBC'])
	&& !empty($_POST['STRDESBC'])
	&& !empty($_POST['BITSUS'])
	&& !empty($_POST['INTIDCAT'])
) {
	require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../../config/funciones.php"); //Contiene las variables de configuracion para conectar a la base de datos

	// escaping, additionally removing everything that could be (html/javascript-) code
	$INTIDCAT = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDCAT"], ENT_QUOTES)));
	$STRNOMSBC = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOMSBC"], ENT_QUOTES)));
	$STRDESBC = mysqli_real_escape_string($con, (strip_tags($_POST["STRDESBC"], ENT_QUOTES)));
	$BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));

	$DTEHOR = date("Y-m-d H:i:s");
	$id = intval($_POST['id']);

		//Write register in to database 
		$oldata = recuperarDatos("SELECT * from tblcatsbc WHERE INTIDSBC='$id';");

		$sql =  "UPDATE tblcatsbc SET INTIDCAT='" . $INTIDCAT . "', STRNOMSBC='" . $STRNOMSBC . "', STRDESBC='" . $STRDESBC . "', BITSUS='" . $BITSUS . "'  WHERE INTIDSBC='" . $id . "' ";
		$mensaje = insertarLog($sql, 'tblcatsbc', 'Actualizacion', 'INTIDSBC', $id, $oldata);
		(str_contains($mensaje, 'Error') === false) ? $messages[] = $mensaje : $errors[] = $mensaje;
		
} else {
	$errors[] = "desconocido.";
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