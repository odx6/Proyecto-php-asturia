<?php
	include("../is_logged.php");//Archivo comprueba si el usuario esta logueado
	if (empty($_POST['IDEMPLEADO'])){
			$errors[] = "IDEMPLEADO está vacío.";
		}  elseif (empty($_POST['Folio'])) {
            $errors[] = "Folio está vacío.";
        }  elseif (empty($_POST['Operador'])) {
            $errors[] = "Operador está vacío.";
        }  elseif (empty($_POST['Carro'])) {
            $errors[] = "No.carro  está vacío.";
        }  elseif (empty($_POST['Kilometraje'])) {
            $errors[] = "Kilometraj está vacío.";
        }  elseif (empty($_POST['Placas'])) {
            $errors[] = "No.Placa está vacío.";
        }   elseif (empty($_POST['Detalles'])) {
            $errors[] = "Detalles  está vacío.";
        }  elseif (empty($_POST['Observaciones'])) {
            $errors[] = "Observaciones está vacío.";
        }  elseif (empty($_POST['IDORDEN'])) {
            $errors[] = "Id orden  está vacío.";
        } /* elseif (empty($_POST['registro'])) {
            $errors[] = "Registro está vacío.";
        }  elseif (empty($_POST['estado'])) {
            $errors[] = "Estado está vacío.";
        }  elseif (empty($_POST['kind'])) {
            $errors[] = "Kind está vacío.";
        }*/ elseif (
        	!empty($_POST['IDEMPLEADO'])
        	&& !empty($_POST['Folio'])
        	&& !empty($_POST['Operador'])
			&& !empty($_POST['Carro'])
			&& !empty($_POST['Kilometraje'])
			&& !empty($_POST['Placas'])
			&& !empty($_POST['Detalles'])
			&& !empty($_POST['Observaciones'])
			&& !empty($_POST['IDORDEN'])
			/*
			&& !empty($_POST['celular'])
			&& !empty($_POST['registro'])
			&& !empty($_POST['estado'])
			&& !empty($_POST['kind'])*/
        ){
		require_once ("../../../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			// escaping, additionally removing everything that could be (html/javascript-) code
            $dni = mysqli_real_escape_string($con,(strip_tags($_POST["IDORDEN"],ENT_QUOTES)));
            $IDEMPLEADO = mysqli_real_escape_string($con,(strip_tags($_POST["IDEMPLEADO"],ENT_QUOTES)));
            $Folio = mysqli_real_escape_string($con,(strip_tags($_POST["Folio"],ENT_QUOTES)));
			$Fecha=date("Y-m-d H:i:s");
            $Operador = mysqli_real_escape_string($con,(strip_tags($_POST["Operador"],ENT_QUOTES)));
            $Carro = mysqli_real_escape_string($con,(strip_tags($_POST["Carro"],ENT_QUOTES)));
            $Kilometaje = mysqli_real_escape_string($con,(strip_tags($_POST["Kilometraje"],ENT_QUOTES)));

            /*$password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));*/

            $Placa = mysqli_real_escape_string($con,(strip_tags($_POST["Placas"],ENT_QUOTES)));
            $Detalles = mysqli_real_escape_string($con,(strip_tags($_POST["Detalles"],ENT_QUOTES)));
            $Observaciones = mysqli_real_escape_string($con,(strip_tags($_POST["Observaciones"],ENT_QUOTES)));
           /* $celular = mysqli_real_escape_string($con,(strip_tags($_POST["celular"],ENT_QUOTES)));
            $registro = mysqli_real_escape_string($con,(strip_tags($_POST["registro"],ENT_QUOTES)));
            $estado = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
            $kind = mysqli_real_escape_string($con,(strip_tags($_POST["kind"],ENT_QUOTES)));
			$created_at=date("Y-m-d H:i:s");
			$imagen="view/resources/images/default.png";*/

			//variable de los permisos 
           // $permisos = $_POST["permisos"];

			//Write register in to database 
			//$sql = "INSERT INTO empleado (dni, imagen, nombre, apellido, username, email, password, domicilio, localidad, telefono, celular, registro, status, created_at) VALUES('".$dni."','".$imagen."','".$nombre."','".$apellido."','".$usuario."','".$email."','".$password."','".$domicilio."','".$localidad."','".$telefono."','".$celular."','".$registro."','".$estado."','".$created_at."');";
			

			$sql = "INSERT INTO solicitud (pk_solicitud, fk_empleado, NumeroFolio, fecha, operador,NoCarro,Kilometraje,NoPlacas,DetallesServicio,Observaciones)
			 VALUES('".$dni."','".$IDEMPLEADO."','".$Folio."','".$Fecha."','".  $Operador."','".$Carro."','".$Kilometaje."','". $Placa."','".$Detalles."','". $Observaciones."');";
		
			$query_new = mysqli_query($con,$sql);



            // if has been added successfully
          /* if ($query_new) {

            		$numeroMaximo="select max(id) as nuevo_empleado from empleado";
            		$idusernew_sql=mysqli_query($con,$numeroMaximo);
            		$idusernew_rw=mysqli_fetch_array($idusernew_sql);
            		$idusernew=$idusernew_rw['nuevo_empleado'];	
            		//agrego los permisos by amner saucedo sosa
            		$num_element=0;
					$sw=true;

					while ($num_element < count($permisos))
					{
						$sql_detalle = "INSERT INTO empleado_permisos(idempleado, idpermiso) VALUES($idusernew, $permisos[$num_element])";
						mysqli_query($con,$sql_detalle) or $sw = false;
						$num_element=$num_element + 1;
					}

                $messages[] = "Empleado ha sido agregado con éxito.";
              } else {
                $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
            }*/
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