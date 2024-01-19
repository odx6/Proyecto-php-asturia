<?php
    include("../is_logged.php");//Archivo comprueba si el usuario esta logueado	
	if (empty($_POST['pk_solicitud'])){
			$errors[] = "Id  de Orden  está vacío.";
		}  elseif (empty($_POST['fk_empleado'])) {
            $errors[] = "Empleado está vacío.";
        }  elseif (empty($_POST['NumeroFolio'])) {
            $errors[] = "No.Folio está vacío.";
        }  elseif (empty($_POST['fecha'])) {
            $errors[] = "fecha está vacío.";
        }  elseif (empty($_POST['operador'])) {
            $errors[] = "operador está vacío.";
        }/*  elseif (empty($_POST['password'])) {
            $errors[] = "Contraseña está vacío.";
        }*/  elseif (empty($_POST['NoCarro'])) {
            $errors[] = "No. de Carro está vacío.";
        }  elseif (empty($_POST['Kilometraje'])) {
            $errors[] = "Kilometraje está vacío.";
        }  elseif (empty($_POST['NoPlacas'])) {
            $errors[] = "No. de Placas está vacío.";
        }  elseif (empty($_POST['DetallesServicio'])) {
            $errors[] = "Detalles está vacío.";
        }  elseif (empty($_POST['Observaciones'])) {
            $errors[] = "Observaciones está vacío.";
        }   /* elseif (empty($_POST['kind'])) {
            $errors[] = "Kind está vacío.";
        }*/ elseif (
        	!empty($_POST['pk_solicitud'])
        	&& !empty($_POST['fk_empleado'])
        	&& !empty($_POST['NumeroFolio'])
			&& !empty($_POST['fecha'])
			&& !empty($_POST['operador'])
			/*&& !empty($_POST['password'])*/
			&& !empty($_POST['NoCarro'])
			&& !empty($_POST['Kilometraje'])
			&& !empty($_POST['NoPlacas'])
			&& !empty($_POST['DetallesServicio'])
			&& !empty($_POST['Observaciones'])
			
			/*&& !empty($_POST['kind'])*/
        ){
		require_once ("../../../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../../../config/RecuperarDatos.php");//Contiene las variables de configuracion para conectar a la base de datos
   
	// escaping, additionally removing everything that could be (html/javascript-) code
    $pk_solicitud = mysqli_real_escape_string($con,(strip_tags($_POST["pk_solicitud"],ENT_QUOTES)));
    $fk_empleado = mysqli_real_escape_string($con,(strip_tags($_POST["fk_empleado"],ENT_QUOTES)));
    $NumeroFolio = mysqli_real_escape_string($con,(strip_tags($_POST["NumeroFolio"],ENT_QUOTES)));
    $fecha = mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
    $operador = mysqli_real_escape_string($con,(strip_tags($_POST["operador"],ENT_QUOTES)));
    $NoCarro = mysqli_real_escape_string($con,(strip_tags($_POST["NoCarro"],ENT_QUOTES)));
    $Kilometraje = mysqli_real_escape_string($con,(strip_tags($_POST["Kilometraje"],ENT_QUOTES)));
    $NoPlacas = mysqli_real_escape_string($con,(strip_tags($_POST["NoPlacas"],ENT_QUOTES)));
    $DetallesServicio = mysqli_real_escape_string($con,(strip_tags($_POST["DetallesServicio"],ENT_QUOTES)));
    $Observaciones = mysqli_real_escape_string($con,(strip_tags($_POST["Observaciones"],ENT_QUOTES)));
	$id=intval($_POST['id']);
	$oldata=recuperarDatos("SELECT * from solicitud WHERE pk_solicitud='$id';");
    //variable de los permisos 


	// UPDATE data into database
    $sql = "UPDATE solicitud SET pk_solicitud='".$pk_solicitud."', fk_empleado='".$fk_empleado."', NumeroFolio='".$NumeroFolio."', fecha='".$fecha."',operador='".$operador."', NoCarro='".$NoCarro."', Kilometraje='".$Kilometraje."',NoPlacas='".$NoPlacas."',DetallesServicio='".$DetallesServicio."', Observaciones='".$Observaciones."' WHERE pk_solicitud='".$id."' ";
    $query = mysqli_query($con,$sql);

	if($query){
		$sql2=recuperarDatos("SELECT * from solicitud WHERE pk_solicitud='$id';");
		$tabla="solicitud";
		$tipo="Actualizacion";
		$fecha=date("Y-m-d H:i:s");
		
        $sqllog="INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('".$_SESSION['user_id']."','".$id."','".$tabla."','".$tipo."','".$fecha."','".$oldata."','".$sql2."');";
	     $query = mysqli_query($con, $sqllog);

	}

    //Verifico que el campo de la contraseña no este vacia by Amner Saucedo Sosa
   

   
		
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