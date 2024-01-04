<?php
	session_start();
	
    if (!empty($_SESSION['username'])) {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        // Guarda $user_ip en la base de datos o utilízalo como necesites
    }

	/*if (isset($_POST['token']) && $_POST['token']!=='') {*/
			
	//Contiene las variables de configuracion para conectar a la base de datos
	include "../../config/config.php";

	$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
	$password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));

    $query = mysqli_query($con,"SELECT * FROM tblcatemp WHERE   STRCOR =\"$email\" AND STRPWS = \"$password\" AND VERIFICATE_AT	 IS NOT NULL  AND BITSUS !=2;");
   // $query = mysqli_query($con,"SELECT * FROM tblcatemp WHERE   IDEMP=1");

		if ($row = mysqli_fetch_array($query)) {
			
				//$marcados = $user->list_mark($fetch->iduser);
				$idempleado=intval($row['IDEMP']);
				$marcados=mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$idempleado ");
				$valores=array();

				while ($per = mysqli_fetch_object($marcados))
				{
					array_push($valores, $per->idpermiso);
				}

				in_array(1,$valores)?$_SESSION['dashboard']=1:$_SESSION['dashboard']=0;
				
				in_array(2,$valores)?$_SESSION['empleados']=1:$_SESSION['empleados']=0;
				in_array(3,$valores)?$_SESSION['configuracion']=1:$_SESSION['configuracion']=0;
				in_array(4,$valores)?$_SESSION['productos']=1:$_SESSION['productos']=0;
				in_array(5,$valores)?$_SESSION['subcategorias']=1:$_SESSION['subcategorias']=0;
				in_array(6,$valores)?$_SESSION['solicitud']=1:$_SESSION['solicitud']=0;
				in_array(7,$valores)?$_SESSION['categorias']=1:$_SESSION['categorias']=0;
				in_array(8,$valores)?$_SESSION['unidades']=1:$_SESSION['unidades']=0;
				in_array(9,$valores)?$_SESSION['Inventario']=1:$_SESSION['Inventario']=0;
				in_array(10,$valores)?$_SESSION['Entradas']=1:$_SESSION['Entradas']=0;
				in_array(11,$valores)?$_SESSION['Control']=1:$_SESSION['Control']=0;

				$_SESSION['user_id'] = $idempleado;
				if($_SESSION['dashboard']==1){
					header("location: ../../?view=dashboard");
				}else{
					header("location: ../../?view=perfil");
				}
				
				
		}else{
			header("location: ../../index.php?invalid");
			//echo mysqli_error($con);
		}
	/*}else{
		//header("location: ../../");
	}*/

?>