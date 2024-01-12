<?php
	session_start();
	 if(in_array(4,$_SESSION['Habilidad']['Solicitud'])){ 
	require_once ("../../../config/config.php");
	require_once ("../../../config/funciones.php");
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
?>
<input type="hidden" value="<?php echo $id;?>" name="id" id="id">

<div class="card" style="width: 50rem;">
  <div class="card-header"> 
  <strong>Id orden :<?php echo $pk_solicitud;?></strong> 
  </div>
  <ul class="list-group list-group-flush">
    
    <li class="list-group-item"> <strong>Empleado : </strong><?php consultarNombre($fk_empleado,'tblcatemp','IDEMP','STRNOM'); echo "   "; consultarNombre($fk_empleado,'tblcatemp','IDEMP','STRAPE'); ?></li>
    <li class="list-group-item"> <strong>Folio : </strong><?php echo $NumeroFolio;?></li>
    <li class="list-group-item"> <strong>Fecha : </strong><?php echo $fecha;?></li>
    <li class="list-group-item"> <strong>Operador : </strong><?php echo $operador;?></li>
    <li class="list-group-item"> <strong>Numero de carro  : </strong><?php echo $NoCarro;?></li>
    <li class="list-group-item"> <strong>Kilometraje  : </strong><?php echo $Kilometraje;?></li>
    <li class="list-group-item"> <strong>Numero de placas : </strong><?php echo $NoPlacas;?></li>
    <li class="list-group-item"> <strong>Detalles del Servicio : </strong><?php echo $DetallesServicio;?></li>
    <li class="list-group-item"> <strong>Observaciones : </strong><?php echo $Observaciones;?></li>
    
  </ul>
</div>
<?php } ?>
