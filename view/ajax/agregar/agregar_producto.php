<?php
	include("../is_logged.php");//Archivo comprueba si el usuario esta logueado
	if (empty($_POST['sku'])){
			$errors[] = "SKU está vacío.";
		}  elseif (empty($_POST['codigo'])) {
            $errors[] = "Codigo  está vacío.";
        }  elseif (empty($_POST['descripcion'])) {
            $errors[] = "Descripcion está vacío.";
        }   elseif (empty($_POST['categoria'])) {
            $errors[] = "categoria  está vacío.";
        }  elseif (empty($_POST['Subcategoria'])) {
            $errors[] = "Subcategoria está vacío.";
        }  elseif (empty($_POST['precio'])) {
            $errors[] = "precio está vacío.";
        }  elseif (empty($_POST['unidad'])) {
            $errors[] = "Unidad de medida está vacío.";
        }  elseif (empty($_FILES["imagefile"])) {
            $errors[] = "imagen está vacío.";
        } 
		  elseif (empty($_POST['INTIDPUSO'])) {
            $errors[] = " Tipo de uso está vacío.";
        }  elseif (empty($_POST['estado'])) {
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
			&& !empty($_FILES["imagefile"])
			&& !empty($_POST['INTIDPUSO'])
			&& !empty($_POST['estado'])
			
			/*&& !empty($_POST['kind'])*/
        ){
		require_once ("../../../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			// escaping, additionally removing everything that could be (html/javascript-) code
            $sku = mysqli_real_escape_string($con,(strip_tags($_POST["sku"],ENT_QUOTES)));
            $codigo = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
            $descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
            $categoria = mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
            $subcategoria = mysqli_real_escape_string($con,(strip_tags($_POST["Subcategoria"],ENT_QUOTES)));
            $precio= mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));
            $unidad = mysqli_real_escape_string($con,(strip_tags($_POST["unidad"],ENT_QUOTES)));

			//Agregar imagen
			$target_dir="../../resources/images/Productos/";
	        $image_name = time()."_".basename($_FILES["imagefile"]["name"]);
	        $target_file = $target_dir .$image_name ;
	        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	        $imageFileZise=$_FILES["imagefile"]["size"];

			if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) and $imageFileZise>0) {
				$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
				} else if ($imageFileZise > 1048576) {//1048576 byte=1MB
				$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
				}  else{
					/* Fin Validacion*/
					if ($imageFileZise>0){
					move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
					$imagen=basename($_FILES["imagefile"]["name"]);
					$img_insert="view/resources/images/Productos/$image_name";
					}
				}

			//

           // $Imagen =$img_insert;
		   $Imagen =$img_insert;

            $perteneceTaller = mysqli_real_escape_string($con,(strip_tags($_POST["INTIDPUSO"],ENT_QUOTES)));
          
           
            $estado = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
           /* $kind = mysqli_real_escape_string($con,(strip_tags($_POST["kind"],ENT_QUOTES)));*/
			$created_at=date("Y-m-d H:i:s");
			//$imagen="view/resources/images/default.png";

			//variable de los permisos 
            //$permisos = $_POST["permisos"];

			//Write register in to database 
			$sql = "INSERT INTO tblcatpro (STRSKU, STRCOD, STRDESPRO, INTIDCAT, INTIDSBC, MONPCOS, INTIDUNI, STRIMG, INTTIPUSO, BITSUS,CREATE_AT) 
			VALUES('".$sku."','".$codigo."','".$descripcion."','".$categoria."','".$subcategoria."','".$precio."','".$unidad."','".$Imagen."','".$perteneceTaller."','".$estado."','".$created_at."');";
			$query_new = mysqli_query($con,$sql);

	        if(!$query_new)$errors[]="no se agrego el producto";
           
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