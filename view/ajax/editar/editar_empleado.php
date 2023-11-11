<?php
    include("../is_logged.php");//Archivo comprueba si el usuario esta logueado	
    if (empty($_POST['STRNSS'])){
        $errors[] = "NSS está vacío.";
    }  elseif (empty($_POST['STRRFC'])) {
        $errors[] = "RFC está vacío.";
    }  elseif (empty($_POST['STRCUR'])) {
        $errors[] = "CURP está vacío.";
    }  elseif (empty($_POST['STRNOM'])) {
        $errors[] = "Nombre está vacío.";
    }  elseif (empty($_POST['STRAPE'])) {
        $errors[] = "Apellidos está vacío.";
    }  elseif (empty($_POST['STRDOM'])) {
        $errors[] = "Domicilio está vacío.";
    }  elseif (empty($_POST['STRLOC'])) {
        $errors[] = "Localidad está vacío.";
    }  elseif (empty($_POST['STRMUN'])) {
        $errors[] = "Municipio está vacío.";
    }  elseif (empty($_POST['STREST'])) {
        $errors[] = "Estado está vacío.";
    }  elseif (empty($_POST['STRCP'])) {
        $errors[] = "Codigo Postal esta vacio.";
    }  elseif (empty($_POST['STRPAI'])) {
        $errors[] = "Pais está vacío.";
    } 
    elseif (empty($_POST['STRTEL'])) {
        $errors[] = "Telefono está vacío.";
    }  elseif (empty($_POST['STRCOR'])) {
        $errors[] = "Correo Electronico está vacío.";
    } elseif (empty($_POST['STRPWS'])) {
        $errors[] = "Contraseña  está vacío.";
    } elseif (empty($_FILES['STRIMG'])) {
        $errors[] = "Imagen está vacío.";
    } elseif (empty($_POST['BITSUS'])) {
        $errors[] = "Estado está vacío.";
    } /* elseif (empty($_POST['kind'])) {
        $errors[] = "Kind está vacío.";
    }*/ elseif (
        !empty($_POST['STRNSS'])
        && !empty($_POST['STRRFC'])
        && !empty($_POST['STRCUR'])
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
        && !empty($_FILES['STRIMG'])
        /*&& !empty($_POST['kind'])*/
    ){
    require_once ("../../../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos
        
        // escaping, additionally removing everything that could be (html/javascript-) code
        //$IDEMP = mysqli_real_escape_string($con,(strip_tags($_POST["IDEMP"],ENT_QUOTES)));
        $STRNSS = mysqli_real_escape_string($con,(strip_tags($_POST["STRNSS"],ENT_QUOTES)));
        $STRRFC = mysqli_real_escape_string($con,(strip_tags($_POST["STRRFC"],ENT_QUOTES)));
        $STRCUR = mysqli_real_escape_string($con,(strip_tags($_POST["STRCUR"],ENT_QUOTES)));
        $STRNOM = mysqli_real_escape_string($con,(strip_tags($_POST["STRNOM"],ENT_QUOTES)));
        $STRAPE = mysqli_real_escape_string($con,(strip_tags($_POST["STRAPE"],ENT_QUOTES)));
        $STRDOM = mysqli_real_escape_string($con,(strip_tags($_POST["STRDOM"],ENT_QUOTES)));
        $STRLOC = mysqli_real_escape_string($con,(strip_tags($_POST["STRLOC"],ENT_QUOTES)));
        $STRMUN = mysqli_real_escape_string($con,(strip_tags($_POST["STRMUN"],ENT_QUOTES)));
        $STREST = mysqli_real_escape_string($con,(strip_tags($_POST["STREST"],ENT_QUOTES)));
        $STRCP = mysqli_real_escape_string($con,(strip_tags($_POST["STRCP"],ENT_QUOTES)));
        $STRPAI = mysqli_real_escape_string($con,(strip_tags($_POST["STRPAI"],ENT_QUOTES)));
        $STRTEL = mysqli_real_escape_string($con,(strip_tags($_POST["STRTEL"],ENT_QUOTES)));
        $STRCOR = mysqli_real_escape_string($con,(strip_tags($_POST["STRCOR"],ENT_QUOTES)));
        $STRPWS = sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["STRPWS"],ENT_QUOTES)))));
        $BITSUS = mysqli_real_escape_string($con,(strip_tags($_POST["BITSUS"],ENT_QUOTES)));

	$id=intval($_POST['id']);
    //variable de los permisos 
    $permisos = $_POST["permisos"];


	// UPDATE data into database
    $sql = "UPDATE tblcatemp SET STRNSS='".$STRNSS."', STRRFC='".$STRRFC."', STRCUR='".$STRCUR."', STRAPE='".$STRAPE."', STRDOM='".$STRDOM."', STRLOC
    ='".$STRLOC
    ."', STRMUN='".$STRMUN."', STREST='".$STREST."', STRCP='".$STRCP."', STRPAI='".$STRPAI."', STRTEL='".$STRTEL."',STRCOR='".$STRCOR."',STRPWS='".$STRPWS."',BITSUS='".$BITSUS."' WHERE IDEMP='".$id."' ";
    $query = mysqli_query($con,$sql);

    //Verifico que el campo de la contraseña no este vacia by Amner Saucedo Sosa
    if(!empty(($password))){
    	$sql_password = "UPDATE empleado SET password='".$password."' WHERE id='".$id."' ";
    	$query_password = mysqli_query($con,$sql_password);
    }

    if($query){

        $sqldel="DELETE FROM empleado_permisos WHERE idempleado='$id'";
        if(mysqli_query($con, $sqldel)){

            $num_element=0;
            $sw=true;

            while ($num_element < count($permisos))
            {
                $sql_detalle = "INSERT INTO empleado_permisos(idempleado, idpermiso) VALUES('$id', '$permisos[$num_element]')";
                mysqli_query($con, $sql_detalle) or $sw = false;
                $num_element=$num_element + 1;
            }
            $return = $sw;
        }

        $messages[] = "El empleado ha sido actualizado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else {
		$errors[] = "desconocido.";
	}
if (isset($errors)){
			
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
			if (isset($messages)){
				
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