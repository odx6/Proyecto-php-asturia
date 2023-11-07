<?php
	include("../is_logged.php");//Archivo comprueba si el usuario esta logueado
	if (empty($_POST['sku'])){
			$errors[] = "SKU está vacío.";
		}  elseif (empty($_POST['codigo'])) {
            $errors[] = "Codigo  está vacío.";
        }  elseif (empty($_POST['descripcion'])) {
            $errors[] = "Descripcion está vacío.";
        }   elseif (empty($_POST['categoria'])) {
            $errors[] = "Categoria  está vacío.";
        }  elseif (empty($_POST['subcategoria'])) {
            $errors[] = "Subcategoria está vacío.";
        }  elseif (empty($_POST['precio'])) {
            $errors[] = "precio está vacío.";
        }  elseif (empty($_POST['unidad'])) {
            $errors[] = "Unidad de medida está vacío.";
        }  elseif (empty($_POST['Imagen'])) {
            $errors[] = "imagen está vacío.";
        }  elseif (empty($_POST['Ptaller'])) {
            $errors[] = "Pertenece al taller  está vacío.";
        } 
		elseif (empty($_POST['BITBALL'])) {
            $errors[] = "BITBALL está vacío.";
        }  elseif (empty($_POST['INITIPUSO'])) {
            $errors[] = "INITIPUSO está vacío.";
        }  elseif (empty($_POST['estado'])) {
            $errors[] = "Estado está vacío.";
        } /* elseif (empty($_POST['kind'])) {
            $errors[] = "Kind está vacío.";
        }*/ elseif (
        	!empty($_POST['sku'])
        	&& !empty($_POST['codigo'])
        	&& !empty($_POST['descripcion'])
			&& !empty($_POST['categoria'])
			&& !empty($_POST['subcategoria'])
			&& !empty($_POST['unidad'])
			&& !empty($_POST['Imagen'])
			&& !empty($_POST['Ptaller'])
			&& !empty($_POST['BITBALL'])
			&& !empty($_POST['INITIPUSO'])
			&& !empty($_POST['estado'])
			
			/*&& !empty($_POST['kind'])*/
        ){
		require_once ("../../../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			// escaping, additionally removing everything that could be (html/javascript-) code
            $sku = mysqli_real_escape_string($con,(strip_tags($_POST["sku"],ENT_QUOTES)));
            $codigo = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
            $descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
            $categoria = mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
            $subcategoria = mysqli_real_escape_string($con,(strip_tags($_POST["subcategoria"],ENT_QUOTES)));
            $unidad = mysqli_real_escape_string($con,(strip_tags($_POST["unidad"],ENT_QUOTES)));
            $imagen = mysqli_real_escape_string($con,(strip_tags($_POST["Imagen"],ENT_QUOTES)));
            $perteneceTaller = mysqli_real_escape_string($con,(strip_tags($_POST["Ptaller"],ENT_QUOTES)));
            $BITBALL = mysqli_real_escape_string($con,(strip_tags($_POST["Ptaller"],ENT_QUOTES)));
            $INITIPUSO = mysqli_real_escape_string($con,(strip_tags($_POST["INITIPUSO"],ENT_QUOTES)));
            $estado = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
           /* $kind = mysqli_real_escape_string($con,(strip_tags($_POST["kind"],ENT_QUOTES)));*/
			//$created_at=date("Y-m-d H:i:s");
			//$imagen="view/resources/images/default.png";

			//variable de los permisos 
            //$permisos = $_POST["permisos"];

			//Write register in to database 
			$sql = "INSERT INTO tblcatpro (SKU, STRCODINT, STRDESPRO, INTIDCAT, INTIDSUBCAT, MONPCOS, INTIDUNI, STRIMG, BITTALL, INTTIPUSO, BITSUS) 
			VALUES('".$sku."','".$codigo."','".$descripcion."','".$categoria."','".$subcategoria."','".$unidad."','".$imagen."','".$perteneceTaller."','".$BITBALL."','".$INITIPUSO."','".$estado."');";
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