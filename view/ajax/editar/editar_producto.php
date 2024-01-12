<?php

include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (in_array(2, $_SESSION['Habilidad']['Productos'])) {
	if (empty($_POST['sku'])) {
		$errors[] = "SKU está vacío.";
	} elseif (empty($_POST['codigo'])) {
		$errors[] = "Codigo  está vacío.";
	} elseif (empty($_POST['descripcion'])) {
		$errors[] = "Descripcion está vacío.";
	} elseif (empty($_POST['categoria'])) {
		$errors[] = "categoria  está vacío.";
	} elseif (empty($_POST['Subcategoria'])) {
		$errors[] = "Subcategoria está vacío.";
	} elseif (empty($_POST['precio'])) {
		$errors[] = "precio está vacío.";
	} elseif (empty($_POST['unidad'])) {
		$errors[] = "Unidad de medida está vacío.";
	} elseif (empty($_POST['INTIDPUSO'])) {
		$errors[] = " Tipo de uso está vacío.";
	} elseif (empty($_POST['estado'])) {
		$errors[] = "Estado está vacío.";
	} /* elseif (empty($_POST['kind'])) {
		   $errors[] = "Kind está vacío.";
	   }*/ elseif (
		!empty($_POST['sku'])
		&& !empty($_POST['codigo'])
		&& !empty($_POST['descripcion'])
		&& !empty($_POST['categoria'])
		&& !empty($_POST['Subcategoria'])
		&& !empty($_POST['precio'])
		&& !empty($_POST['unidad'])
		&& !empty($_POST['INTIDPUSO'])
		&& !empty($_POST['estado'])

		/*&& !empty($_POST['kind'])*/
	) {
		require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
		//$id = $_POST["id"];
		$id = mysqli_real_escape_string($con, (strip_tags($_POST["id"], ENT_QUOTES)));
		// escaping, additionally removing everything that could be (html/javascript-) code
		$sku = mysqli_real_escape_string($con, (strip_tags($_POST["sku"], ENT_QUOTES)));
		$codigo = mysqli_real_escape_string($con, (strip_tags($_POST["codigo"], ENT_QUOTES)));
		$descripcion = mysqli_real_escape_string($con, (strip_tags($_POST["descripcion"], ENT_QUOTES)));
		$categoria = mysqli_real_escape_string($con, (strip_tags($_POST["categoria"], ENT_QUOTES)));
		$subcategoria = mysqli_real_escape_string($con, (strip_tags($_POST["Subcategoria"], ENT_QUOTES)));
		$precio = mysqli_real_escape_string($con, (strip_tags($_POST["precio"], ENT_QUOTES)));
		$unidad = mysqli_real_escape_string($con, (strip_tags($_POST["unidad"], ENT_QUOTES)));
		$Imagen = "";
		$pathimg = "";
		if (empty($_FILES["STRIMG"]['name'])) {
			$sqlimg = "SELECT STRIMG FROM tblcatpro WHERE STRSKU='$id';";
			$queyimg = mysqli_query($con, $sqlimg);
			$num = mysqli_num_rows($queyimg);
			if ($num == 1) {
				$row = mysqli_fetch_array($queyimg);
				$Imagen = $row['STRIMG'];
			}
		} else {
			$sqlimg = "SELECT STRIMG FROM tblcatpro WHERE STRSKU='$id';";
			$queyimg = mysqli_query($con, $sqlimg);
			$num = mysqli_num_rows($queyimg);
			if ($num == 1) {
				$row = mysqli_fetch_array($queyimg);
				$pathimg = $row['STRIMG'];
			}


			//UPDATE IMG 
			//Agregar imagen
			$target_dir = "../../resources/images/Productos/";
			$image_name = time() . "_" . basename($_FILES["STRIMG"]["name"]);
			$target_file = $target_dir . $image_name;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			$imageFileZise = $_FILES["STRIMG"]["size"];

			if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") and $imageFileZise > 0) {
				$errors[] = "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
			} else if ($imageFileZise > 1048576) { //1048576 byte=1MB
				$errors[] = "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
			} else {
				/* Fin Validacion*/
				if ($imageFileZise > 0) {
					move_uploaded_file($_FILES["STRIMG"]["tmp_name"], $target_file);
					$imagen = basename($_FILES["STRIMG"]["name"]);
					$Imagen = "view/resources/images/Productos/$image_name";
				}
			}
			//END UPDATE IMG 


		}
		$PTAller = mysqli_real_escape_string($con, (strip_tags($_POST["INTIDPUSO"], ENT_QUOTES)));
		$estado = mysqli_real_escape_string($con, (strip_tags($_POST["estado"], ENT_QUOTES)));

		//variable de los permisos 
		// $permisos = $_POST["permisos"];

		$Editflag = "1";
		// UPDATE data into database
		$sql = "UPDATE tblcatpro SET STRSKU='" . $sku . "', STRCOD='" . $codigo . "', STRDESPRO='" . $descripcion . "', INTIDCAT='" . $categoria . "', INTIDSBC='" . $subcategoria . "', MONPCOS='" . $precio . "', INTIDUNI='" . $unidad . "', STRIMG='" . $Imagen . "',INTTIPUSO='" . $PTAller . "', BITSUS='" . $estado . "',loked='" . $Editflag .  "', Editor=0  WHERE STRSKU='" . $id . "' ";
		$query = mysqli_query($con, $sql);
		//codigo para eliminar una img
		if ($query && !empty($pathimg) && $pathimg != "view/resources/images/Default/productoDefault.png") {
			if (file_exists("../../../" . $pathimg))
				unlink("../../../" . $pathimg);
		}
		//
		//Verifico que el campo de la contraseña no este vacia by Amner Saucedo Sosa


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
}
?>