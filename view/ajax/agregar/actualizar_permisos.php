<?php
include("../is_logged.php");
include "../../../config/config.php";
include "../../../config/RecuperarDatos.php";


if (!empty($_POST['Habildades'])) {
   
    $Habilidad = $_POST['Habildades'];
    $i = 0;
    foreach ($Habilidad as $H => $valores) {

        $claves = array_keys($Habilidad);
        $data = implode(',', $valores);
        $id = $claves[$i];
        $oldata=recuperarDatos("SELECT * FROM empleado_permisos where idempleado_permiso='$id';");
        $sql = "UPDATE empleado_permisos SET Habilidades='$data'  WHERE 	idempleado_permiso='$id';";
        $query = mysqli_query($con, $sql);

        if($query){
            $sql2=recuperarDatos("SELECT * from empleado_permisos WHERE idempleado_permiso='$id';");
            $tabla="empleado_permisos";
            $tipo="Actualizacion";
            $fecha=date("Y-m-d H:i:s");
            
         $sqllog="INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`,`newvalue`) VALUES('".$_SESSION['user_id']."','".$id."','".$tabla."','".$tipo."','".$fecha."','".$oldata."','".$sql2."');";
         $query = mysqli_query($con, $sqllog);

        }
        
        $i += 1;
    }
    $_SESSION['message'] = 'Permisos modificados con exito';
    $_SESSION['color'] = 'success';
    
}else{


    $_SESSION['message'] = 'Algo salio mal , al intentar modificar los permisos';
    $_SESSION['color'] = 'danger';
    

}



header("location: ../../../?view=empleados");




	
