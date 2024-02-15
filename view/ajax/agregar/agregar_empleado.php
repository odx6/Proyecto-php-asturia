<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
include("../../../config/funciones.php");
include("../../../config/verificarCorreo.php");
if (empty($_POST['STRNSS'])) {
	$errors[] = "NSS está vacío.";
} elseif (empty($_POST['STRRFC'])) {
	$errors[] = "RFC está vacío.";
} elseif (empty($_POST['STRCUR'])) {
	$errors[] = "CURP está vacío.";
} 
elseif (empty($_POST['STRNDL'])) {
	$errors[] = "Licencia está vacío.";
} elseif (empty($_POST['STRNOM'])) {
	$errors[] = "Nombre está vacío.";
} elseif (empty($_POST['STRAPE'])) {
	$errors[] = "Apellidos está vacío.";
} elseif (empty($_POST['STRDOM'])) {
	$errors[] = "Domicilio está vacío.";
} elseif (empty($_POST['STRLOC'])) {
	$errors[] = "Localidad está vacío.";
} elseif (empty($_POST['STRMUN'])) {
	$errors[] = "Municipio está vacío.";
} elseif (empty($_POST['STREST'])) {
	$errors[] = "Estado está vacío.";
} elseif (empty($_POST['STRCP'])) {
	$errors[] = "Codigo Postal esta vacio.";
} elseif (empty($_POST['STRPAI'])) {
	$errors[] = "Pais está vacío.";
} elseif (empty($_POST['STRTEL'])) {
	$errors[] = "Telefono está vacío.";
} elseif (empty($_POST['STRCOR'])) {
	$errors[] = "Correo Electronico está vacío.";
} elseif (empty($_POST['STRPWS'])) {
	$errors[] = "Contraseña  está vacío.";
} elseif (empty($_POST['BITSUS'])) {
	$errors[] = "Estado está vacío.";
} elseif (
	!empty($_POST['STRNSS'])
	&& !empty($_POST['STRRFC'])
	&& !empty($_POST['STRCUR'])
	&& !empty($_POST['STRNDL'])
	&& !empty($_POST['STRNOM'])
	&& !empty($_POST['STRAPE'])
	&& !empty($_POST['STRDOM'])
	&& !empty($_POST['STRLOC'])
	&& !empty($_POST['STRMUN'])
	&& !empty($_POST['STREST'])
	&& !empty($_POST['STRCP'])
	&& !empty($_POST['STRPAI'])
	&& !empty($_POST['STRTEL'])
	&& !empty($_POST['STRCOR'])
	&& !empty($_POST['STRPWS'])
	&& !empty($_POST['BITSUS'])


	/*&& !empty($_POST['kind'])*/
) {
	require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../../config/RecuperarDatos.php"); 

	// escaping, additionally removing everything that could be (html/javascript-) code
	//$IDEMP = mysqli_real_escape_string($con,(strip_tags($_POST["IDEMP"],ENT_QUOTES)));
	$STRNSS = mysqli_real_escape_string($con, (strip_tags($_POST["STRNSS"], ENT_QUOTES)));
	$STRRFC = mysqli_real_escape_string($con, (strip_tags($_POST["STRRFC"], ENT_QUOTES)));
	$STRCUR = mysqli_real_escape_string($con, (strip_tags($_POST["STRCUR"], ENT_QUOTES)));
	$STRNDL = mysqli_real_escape_string($con, (strip_tags($_POST["STRNDL"], ENT_QUOTES)));
	$STRNOM = mysqli_real_escape_string($con, (strip_tags($_POST["STRNOM"], ENT_QUOTES)));
	$STRAPE = mysqli_real_escape_string($con, (strip_tags($_POST["STRAPE"], ENT_QUOTES)));
	$STRDOM = mysqli_real_escape_string($con, (strip_tags($_POST["STRDOM"], ENT_QUOTES)));
	$STRLOC = mysqli_real_escape_string($con, (strip_tags($_POST["STRLOC"], ENT_QUOTES)));
	$STRMUN = mysqli_real_escape_string($con, (strip_tags($_POST["STRMUN"], ENT_QUOTES)));
	$STREST = mysqli_real_escape_string($con, (strip_tags($_POST["STREST"], ENT_QUOTES)));
	$STRCP = mysqli_real_escape_string($con, (strip_tags($_POST["STRCP"], ENT_QUOTES)));
	$STRPAI = mysqli_real_escape_string($con, (strip_tags($_POST["STRPAI"], ENT_QUOTES)));
	$STRTEL = mysqli_real_escape_string($con, (strip_tags($_POST["STRTEL"], ENT_QUOTES)));
	$STRCOR = mysqli_real_escape_string($con, (strip_tags($_POST["STRCOR"], ENT_QUOTES)));
	$STRPWS = sha1(md5(mysqli_real_escape_string($con, (strip_tags($_POST["STRPWS"], ENT_QUOTES)))));
	$BITSUS = mysqli_real_escape_string($con, (strip_tags($_POST["BITSUS"], ENT_QUOTES)));
	$CREATED_AT = date("Y-m-d H:i:s");
	if (empty($_FILES["STRIMGE"]['name'])) {
		$STRIMG = "view/resources/images/Default/perfil.png";
	} else {


		//UPDATE IMG 
		//Agregar imagen
		$target_dir = "../../resources/images/Empleados/";
		$image_name = time() . "_" . basename($_FILES["STRIMGE"]["name"]);
		$target_file = $target_dir . $image_name;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		$imageFileZise = $_FILES["STRIMGE"]["size"];

		if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") and $imageFileZise > 0) {
			$errors[] = "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
		} else if ($imageFileZise > 1048576) { //1048576 byte=1MB
			$errors[] = "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
		} else {
			/* Fin Validacion*/
			if ($imageFileZise > 0) {
				move_uploaded_file($_FILES["STRIMGE"]["tmp_name"], $target_file);
				$imagen = basename($_FILES["STRIMGE"]["name"]);
				$STRIMG = "view/resources/images/Empleados/$image_name";
			}
		}
		//END UPDATE IMG 

	}


	// $STRIMG = mysqli_real_escape_string($con,(strip_tags($_POST["STRIMG"],ENT_QUOTES)));
	/* $kind = mysqli_real_escape_string($con,(strip_tags($_POST["kind"],ENT_QUOTES)));*/
	$CREATED_AT = date("Y-m-d H:i:s");
	//verificacion de correo 
	$token = md5(rand());



	//variable de los permisos 
	if (empty($_POST['permisos'])) {
		$BITSUS = 2;
	} else {

		$permisos = $_POST["permisos"];
	}


	//Write register in to database 
	if (verificacionDeCorreo($STRCOR, $token) == "true") $sql = "INSERT INTO tblcatemp (STRNSS,STRRFC,STRCUR,STRNDL, STRNOM,STRAPE, STRDOM,STRLOC, STRMUN,STREST, STRCP,STRPAI,STRTEL,STRCOR,STRPWS,BITSUS,STRIMG , CREATE_AT,TOKEN) 
	VALUES('" . $STRNSS . "','" . $STRRFC . "','" . $STRCUR . "','" . $STRNDL . "','" . $STRNOM . "','" . $STRAPE . "','" . $STRDOM . "','" . $STRLOC . "','" . $STRMUN . "','" . $STREST . "','" . $STRCP . "','" . $STRPAI . "','" . $STRTEL . "','" . $STRCOR . "','" . $STRPWS . "','" . $BITSUS . "','" . $STRIMG . "','" . $CREATED_AT . "','" . $token . "');";
	$query_new = mysqli_query($con, $sql);

	if($query_new){
	$id=mysqli_insert_id($con);
		$sql2=recuperarDatos("SELECT * from tblcatemp WHERE IDEMP='$id';");
		$tabla="tblcatemp";
		$tipo="creacion";
		$fecha=date("Y-m-d H:i:s");
		
     $sqllog="INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('".$_SESSION['user_id']."','".$id."','".$tabla."','".$tipo."','".$fecha."','".$sql2."');";
	 $query = mysqli_query($con, $sqllog);

	}
	// if has been added successfully
	if ($query_new) {
		if (!empty($_POST['permisos'])) {
			$numeroMaximo = "select max(IDEMP) as nuevo_empleado from tblcatemp";
			$idusernew_sql = mysqli_query($con, $numeroMaximo);
			$idusernew_rw = mysqli_fetch_array($idusernew_sql);
			$idusernew = $idusernew_rw['nuevo_empleado'];
			//agrego los permisos by amner saucedo sosa
			$num_element = 0;
			$sw = true;

			while ($num_element < count($permisos)) {
				$sql_detalle = "INSERT INTO empleado_permisos(idempleado, idpermiso) VALUES($idusernew, $permisos[$num_element])";

				mysqli_query($con, $sql_detalle) or $sw = false;
				$id=mysqli_insert_id($con);
				$sql2=recuperarDatos("SELECT * from empleado_permisos WHERE idempleado_permiso='$id';");
				$tabla="empleado_permisos";
				$tipo="creacion";
				$fecha=date("Y-m-d H:i:s");
				
			 $sqllog="INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('".$_SESSION['user_id']."','".$id."','".$tabla."','".$tipo."','".$fecha."','".$sql2."');";
			 $query = mysqli_query($con, $sqllog);
				$num_element = $num_element + 1;
			}

			$messages[] = "Empleado ha sido agregado con éxito.";
		} else {

			$messages[] = "Empleado ha sido agregado con éxito, sin permisos.";
		}
	} else {
		$errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
	}
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
	
		<div class="alert alert-success" >
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