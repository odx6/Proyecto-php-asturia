<?php
    include("../is_logged.php");//Archivo comprueba si el usuario esta logueado	
	if (empty($_POST['sku'])){
			$errors[] = "sku está vacío.";
		}  elseif (empty($_POST['Codigo'])) {
            $errors[] = "Codigo está vacío.";
        }  elseif (empty($_POST['Descripcion'])) {
            $errors[] = "Descripcion está vacío.";
        }  elseif (empty($_POST['Categoria'])) {
            $errors[] = "Categoria está vacío.";
        }  elseif (empty($_POST['Subcategoria'])) {
            $errors[] = "Subcategoria está vacío.";
        }/*  elseif (empty($_POST['password'])) {
            $errors[] = "Contraseña está vacío.";
        }*/  elseif (empty($_POST['Precio'])) {
            $errors[] = "Precio está vacío.";
        }  elseif (empty($_POST['Unidad'])) {
            $errors[] = "Unidad de medida  está vacío.";
        }   elseif (empty($_FILES['imagefile'])) {
            $errors[] = "Imagen está vacía.";
        }  elseif (empty($_POST['PTaller'])) {
            $errors[] = "Estado de taller está vacío.";
        }
        elseif (empty($_POST['estado'])) {
            $errors[] = "estado  está vacío.";
        } /* elseif (empty($_POST['kind'])) {
            $errors[] = "Kind está vacío.";
        }*/ elseif (
        	!empty($_POST['sku'])
        	&& !empty($_POST['Codigo'])
        	&& !empty($_POST['Descripcion'])
			&& !empty($_POST['Categoria'])
			&& !empty($_POST['Subcategoria'])
			/*&& !empty($_POST['password'])*/
			&& !empty($_POST['Precio'])
			&& !empty($_POST['Unidad'])
			&& !empty($_FILES['imagefile'])
			&& !empty($_POST['PTaller'])
			&& !empty($_POST['estado'])
			/*&& !empty($_POST['kind'])*/
        ){
		require_once ("../../../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos

	// escaping, additionally removing everything that could be (html/javascript-) code
    $sku = mysqli_real_escape_string($con,(strip_tags($_POST["sku"],ENT_QUOTES)));
    $Codigo = mysqli_real_escape_string($con,(strip_tags($_POST["Codigo"],ENT_QUOTES)));
    $Descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["Descripcion"],ENT_QUOTES)));
    $Categoria = mysqli_real_escape_string($con,(strip_tags($_POST["Categoria"],ENT_QUOTES)));
    $Subcategoria = mysqli_real_escape_string($con,(strip_tags($_POST["Subcategoria"],ENT_QUOTES)));
    $Precio = mysqli_real_escape_string($con,(strip_tags($_POST["Precio"],ENT_QUOTES)));
    $Unidad = mysqli_real_escape_string($con,(strip_tags($_POST["Unidad"],ENT_QUOTES)));
	
	$sqlimg="SELECT STRIMG FROM `tblcatpro` WHERE STRSKU=$sku;";
	$queyimg=mysqli_query($con,$sqlimg);
	$num = mysqli_num_rows($queyimg);
    if ($num == 1) {
        $row = mysqli_fetch_array($queyimg);
        $pathimg = $row['STRIMG'];
		
	}
	
    
    //UPDATE IMG 
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
	//END UPDATE IMG 

    $Imagen = $img_insert;
    $PTAller = mysqli_real_escape_string($con,(strip_tags($_POST["PTaller"],ENT_QUOTES)));
    $estado = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
	$id=intval($_POST['id']);
    //variable de los permisos 
   // $permisos = $_POST["permisos"];


	// UPDATE data into database
    $sql = "UPDATE tblcatpro SET STRSKU='".$sku."', STRCOD='".$Codigo."', STRDESPRO='".$Descripcion."', INTIDCAT='".$Categoria."', INTIDSBC='".$Subcategoria."', MONPCOS='".$Precio."', INTIDUNI='".$Unidad."', STRIMG='".$Imagen."',INTTIPUSO='".$PTAller."', BITSUS='".$estado."' WHERE STRSKU='".$id."' ";
    $query = mysqli_query($con,$sql);
  //codigo para eliminar una img
  if($query && file_exists("../../../".$pathimg))unlink("../../../".$pathimg);
//
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