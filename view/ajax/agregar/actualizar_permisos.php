<?php
include("../is_logged.php");
include "../../../config/config.php";
include "../../../config/funciones.php";


if (!empty($_POST['Habildades'])) {
   
    $Habilidad = $_POST['Habildades'];
    $i = 0;
    foreach ($Habilidad as $H => $valores) {

        $claves = array_keys($Habilidad);
        $data = implode(',', $valores);
        $id = $claves[$i];
        $oldata=recuperarDatos("SELECT * FROM empleado_permisos where idempleado_permiso='$id';");
        $sql = "UPDATE empleado_permisos SET Habilidades='$data'  WHERE 	idempleado_permiso='$id';";
        $mensaje = insertarLog($sql, 'empleado_permisos', 'Actualizacion', 'idempleado_permiso', $id, '');
		(str_contains($mensaje, 'Error')===false) ? $messages[] = $mensaje : $errors[] = $mensaje;
        $i += 1;

       
    }
    $_SESSION['message'] = 'Permisos modificados con exito';
    $_SESSION['color'] = 'success';
    
}else{


    $_SESSION['message'] = 'Algo salio mal , al intentar modificar los permisos';
    $_SESSION['color'] = 'danger';
    

}



header("location: ../../../?view=empleado");




	
