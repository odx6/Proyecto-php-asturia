<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty(trim($_POST['STRNOMCAT']))) {
	$errors[] = "Nombre está vacío.";
} elseif (empty(trim($_POST['STRDESCAT']))) {
	$errors[] = "Descripcion  está vacío.";
} elseif (empty(trim($_POST['BITSUS']))) {
	$errors[] = "Estado está vacío.";
} elseif (
	!empty($_POST['STRNOMCAT'])
	&& !empty($_POST['STRDESCAT'])
	&& !empty($_POST['BITSUS'])
) {
	require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../../config/funciones.php"); //Contiene las variables de configuracion para conectar a la base de datos

	// escaping, additionally removing everything that could be (html/javascript-) code
	$STRNOMCAT = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOMCAT"], ENT_QUOTES)));
	$STRNOMCAT = strtoupper($STRNOMCAT);
	$STRDESCAT = mysqli_real_escape_string($con, (strip_tags($_POST["STRDESCAT"], ENT_QUOTES)));
	$BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));

	$DTEHOR = date("Y-m-d H:i:s");

	//Write register in to database 
	$sql = "INSERT INTO tblcatcat ( STRNOMCAT, STRDESCAT,DTEHOR,BITSUS) 
			VALUES('" . $STRNOMCAT . "','" . $STRDESCAT . "','" . $DTEHOR . "','" . $BITSUS . "');";
	$mensaje=insertarLog($sql,'tblcatcat','creacion','INTIDCAT','0');
   (strpos($mensaje,'error') !== false)? $messages[]=$mensaje:$errors[]=$mensaje;
	
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

	<div class="alert alert-success">
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