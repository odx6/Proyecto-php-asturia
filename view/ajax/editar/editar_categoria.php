<?php
	include("../is_logged.php");//Archivo comprueba si el usuario esta logueado
	if (empty($_POST['STRNOMCAT'])){
			$errors[] = "Nombre está vacío.";
		}  elseif (empty($_POST['STRDESCAT'])) {
            $errors[] = "Descripcion  está vacío.";
        }  elseif (empty($_POST['BITSUS'])) {
            $errors[] = "Estado está vacío.";
        }   elseif (
        	!empty($_POST['STRNOMCAT'])
        	&& !empty($_POST['STRDESCAT'])
        	&& !empty($_POST['BITSUS'])
        ){
		require_once ("../../../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			// escaping, additionally removing everything that could be (html/javascript-) code
            $STRNOMCAT = mysqli_real_escape_string($con,(strip_tags($_POST["STRNOMCAT"],ENT_QUOTES)));
            $STRDESCAT = mysqli_real_escape_string($con,(strip_tags($_POST["STRDESCAT"],ENT_QUOTES)));
            $BITSUS = mysqli_real_escape_string($con,(strip_tags($_POST["BITSUS"],ENT_QUOTES)));
            
            $DTEHOR=date("Y-m-d H:i:s");
            $id=intval($_POST['id']);
			//Write register in to database 

           
			$sql =  "UPDATE tblcatcat SET STRNOMCAT='".$STRNOMCAT."', STRDESCAT='".$STRDESCAT."', BITSUS='".$BITSUS."'  WHERE INTIDCAT='".$id."' ";
			$query_new = mysqli_query($con,$sql);
			if($query_new){
				$sql2="se Actualizo la categoria con Nombre: ".$STRNOMCAT." Descripcion :".$STRDESCAT." En  la fecha : ".$DTEHOR;
				$tabla="tblcatcat";
				$tipo="Actualizacion";
				$fecha=date("Y-m-d H:i:s");
				
			 $sqllog="INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('".$_SESSION['user_id']."','".$id."','".$tabla."','".$tipo."','".$fecha."','".$sql2."');";
			 $query = mysqli_query($con, $sqllog);
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