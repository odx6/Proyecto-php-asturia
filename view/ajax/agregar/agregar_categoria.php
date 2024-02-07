<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty($_POST['STRNOMCAT'])) {
	$errors[] = "Nombre está vacío.";
} elseif (empty($_POST['STRDESCAT'])) {
	$errors[] = "Descripcion  está vacío.";
} elseif (empty($_POST['BITSUS'])) {
	$errors[] = "Estado está vacío.";
} elseif (
	!empty($_POST['STRNOMCAT'])
	&& !empty($_POST['STRDESCAT'])
	&& !empty($_POST['BITSUS'])
) {
	require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../../config/RecuperarDatos.php"); //Contiene las variables de configuracion para conectar a la base de datos

	// escaping, additionally removing everything that could be (html/javascript-) code
	$STRNOMCAT = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOMCAT"], ENT_QUOTES)));
	$STRNOMCAT = strtoupper($STRNOMCAT);
	$STRDESCAT = mysqli_real_escape_string($con, (strip_tags($_POST["STRDESCAT"], ENT_QUOTES)));
	$BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));

	$DTEHOR = date("Y-m-d H:i:s");

	//Write register in to database 
	$sql = "INSERT INTO tblcatcat ( STRNOMCAT, STRDESCAT,DTEHOR,BITSUS) 
			VALUES('" . $STRNOMCAT . "','" . $STRDESCAT . "','" . $DTEHOR . "','" . $BITSUS . "');";
	$query_new = mysqli_query($con, $sql);

	if ($query_new) {
		$ide = mysqli_insert_id($con);
		$sql2 = recuperarDatos("SELECT * FROM tblcatcat WHERE INTIDCAT='$ide';");
		$tabla = "tblcatcat";
		$tipo = "creacion";
		$fecha = date("Y-m-d H:i:s");

		$sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $ide . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
		$query = mysqli_query($con, $sqllog);
	}


	if (isset($messages)) {


		echo '<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Bien hecho!</strong>';

		foreach ($messages as $message) {
			echo $message;
		}

		echo '</div>';
	}
} else {
	$errors[] = "desconocido.";
	if (isset($errors)) {


		echo '<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong>';

		foreach ($errors as $error) {
			echo $error;
		}

		echo '</div>';
	}
} ?>

