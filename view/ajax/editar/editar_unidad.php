<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty(trim($_POST['STRNOMUNI']))) {
	$errors[] = "Nombre está vacío.";
} elseif (empty(trim($_POST['STRDESUNI']))) {
	$errors[] = "Descripcion  está vacío.";
} elseif (empty($_POST['BITSUS'])) {
	$errors[] = "Estado está vacío.";
} elseif (
	!empty($_POST['STRNOMUNI'])
	&& !empty($_POST['STRDESUNI'])
	&& !empty($_POST['BITSUS'])
) {
	require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../../config/funciones.php"); //Contiene las variables de configuracion para conectar a la base de datos

	// escaping, additionally removing everything that could be (html/javascript-) code
	$STRNOMUNI = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOMUNI"], ENT_QUOTES)));
	$STRDESUNI = mysqli_real_escape_string($con, (strip_tags($_POST["STRDESUNI"], ENT_QUOTES)));
	$BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));

	$DTEHOR = date("Y-m-d H:i:s");
	$id = intval($_POST['id']);
	$sql =  "UPDATE tblcatuni SET STRNOMUNI='" . $STRNOMUNI . "', STRDESUNI='" . $STRDESUNI . "', BITSUS='" . $BITSUS . "'  WHERE INTIDUNI='" . $id . "' ";
	$oldata = recuperarDatos("SELECT * from tblcatuni WHERE INTIDUNI='$id';");

	$mensaje = insertarLog($sql, 'tblcatuni', 'Actualizacion', 'INTIDUNI', $id,$oldata);
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