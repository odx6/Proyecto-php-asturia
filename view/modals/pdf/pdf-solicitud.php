<?php
	session_start();
	require_once ("../../../config/config.php");
	if (isset($_GET["id"])){
		$id=$_GET["id"];
		$id=intval($id);
		$sql="select * from solicitud where pk_solicitud='$id'";
		$query=mysqli_query($con,$sql);
		$num=mysqli_num_rows($query);
		if ($num==1){
			$rw=mysqli_fetch_array($query);
			$pk_solicitud=$rw['pk_solicitud'];
			$fk_empleado=$rw['fk_empleado'];
			$NumeroFolio=$rw['NumeroFolio'];
			$fecha=$rw['fecha'];
			$operador=$rw['operador'];
			$NoCarro=$rw['NoCarro'];
			$Kilometraje=$rw['Kilometraje'];
			$NoPlacas=$rw['NoPlacas'];
			$DetallesServicio=$rw['DetallesServicio'];
			$Observaciones=$rw['Observaciones'];
			
		}
	}	
	else{exit;}

  $json = json_encode($rw);

  echo $json;
?>
