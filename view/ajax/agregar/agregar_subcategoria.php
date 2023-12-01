<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty($_POST['STRNOMSBC'])) {
	$errors[] = "Nombre está vacío.";
} elseif (empty($_POST['STRDESSBC'])) {
	$errors[] = "Descripcion  está vacío.";
} elseif (empty($_POST['BITSUS'])) {
	$errors[] = "Estado está vacío.";
} elseif (empty($_POST['INTIDCAT'])) {
	$errors[] = "Categoria está vacío.";
} elseif (
	!empty($_POST['STRNOMSBC'])
	&& !empty($_POST['STRDESSBC'])
	&& !empty($_POST['BITSUS'])
	&& !empty($_POST['INTIDCAT'])
) {
	require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos

	// escaping, additionally removing everything that could be (html/javascript-) code
	$STRNOMSBC = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOMSBC"], ENT_QUOTES)));
	$STRNOMSBC = strtoupper($STRNOMSBC);
	$STRDESSBC = mysqli_real_escape_string($con, (strip_tags($_POST["STRDESSBC"], ENT_QUOTES)));
	$INTIDCAT = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDCAT"], ENT_QUOTES)));
	$BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));
	$DTEHOR = date("Y-m-d H:i:s");

	//Write register in to database 
	$sql = "INSERT INTO tblcatsbc ( INTIDCAT,STRNOMSBC, STRDESBC,DTEHOR,BITSUS) 
			VALUES('" . $INTIDCAT . "','" . $STRNOMSBC . "','" . $STRDESSBC . "','" . $DTEHOR . "','" . $BITSUS . "');";
	$query_new = mysqli_query($con, $sql);
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