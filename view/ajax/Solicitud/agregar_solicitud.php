<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty($_POST['IDEMPLEADO'])) {
	$errors[] = "IDEMPLEADO está vacío.";
} elseif (empty($_POST['Folio'])) {
	$errors[] = "Folio está vacío.";
} elseif (empty($_POST['Operador'])) {
	$errors[] = "Operador está vacío.";
} elseif (empty($_POST['Carro'])) {
	$errors[] = "No.carro  está vacío.";
} elseif (empty($_POST['Kilometraje'])) {
	$errors[] = "Kilometraj está vacío.";
} elseif (empty($_POST['Placas'])) {
	$errors[] = "No.Placa está vacío.";
} elseif (empty($_POST['Detalles'])) {
	$errors[] = "Detalles  está vacío.";
} elseif (empty($_POST['Observaciones'])) {
	$errors[] = "Observaciones está vacío.";
} elseif (empty($_POST['IDORDEN'])) {
	$errors[] = "Id orden  está vacío.";
} elseif (
	!empty($_POST['IDEMPLEADO'])
	&& !empty($_POST['Folio'])
	&& !empty($_POST['Operador'])
	&& !empty($_POST['Carro'])
	&& !empty($_POST['Kilometraje'])
	&& !empty($_POST['Placas'])
	&& !empty($_POST['Detalles'])
	&& !empty($_POST['Observaciones'])
	&& !empty($_POST['IDORDEN'])

) {
	require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos

	// escaping, additionally removing everything that could be (html/javascript-) code
	$dni = mysqli_real_escape_string($con, (strip_tags($_POST["IDORDEN"], ENT_QUOTES)));
	$IDEMPLEADO = mysqli_real_escape_string($con, (strip_tags($_POST["IDEMPLEADO"], ENT_QUOTES)));
	$Folio = mysqli_real_escape_string($con, (strip_tags($_POST["Folio"], ENT_QUOTES)));
	$Fecha = date("Y-m-d H:i:s");
	$Operador = mysqli_real_escape_string($con, (strip_tags($_POST["Operador"], ENT_QUOTES)));
	$Carro = mysqli_real_escape_string($con, (strip_tags($_POST["Carro"], ENT_QUOTES)));
	$Kilometaje = mysqli_real_escape_string($con, (strip_tags($_POST["Kilometraje"], ENT_QUOTES)));



	$Placa = mysqli_real_escape_string($con, (strip_tags($_POST["Placas"], ENT_QUOTES)));
	$Detalles = mysqli_real_escape_string($con, (strip_tags($_POST["Detalles"], ENT_QUOTES)));
	$Observaciones = mysqli_real_escape_string($con, (strip_tags($_POST["Observaciones"], ENT_QUOTES)));


	$sql = "INSERT INTO solicitud (pk_solicitud, fk_empleado, NumeroFolio, fecha, operador,NoCarro,Kilometraje,NoPlacas,DetallesServicio,Observaciones)
			 VALUES('" . $dni . "','" . $IDEMPLEADO . "','" . $Folio . "','" . $Fecha . "','" .  $Operador . "','" . $Carro . "','" . $Kilometaje . "','" . $Placa . "','" . $Detalles . "','" . $Observaciones . "');";

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