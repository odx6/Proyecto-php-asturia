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
?>
<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
<div class="form-group">
    <label for="dni" class="col-sm-4 control-label">Id Orden: </label>
    <div class="col-sm-8">
        <?php echo $pk_solicitud;?>
    </div>
</div>
<div class="form-group">
    <label for="nombre" class="col-sm-4 control-label">Empleado: </label>
    <div class="col-sm-8">
        <?php echo $fk_empleado;?>
    </div>
</div>
<div class="form-group">
    <label for="apellido" class="col-sm-4 control-label">Numero De Folio: </label>
    <div class="col-sm-8">
        <?php echo $NumeroFolio;?>
    </div>
</div>
<div class="form-group">
    <label for="usuario" class="col-sm-4 control-label">Fecha: </label>
    <div class="col-sm-8">
        <?php echo $fecha;?>
    </div>
</div>
<div class="form-group">
    <label for="email" class="col-sm-4 control-label">Operador: </label>
    <div class="col-sm-8">
       <?php echo $operador;?>
    </div>
</div>

<div class="form-group">
    <label for="domicilio" class="col-sm-4 control-label">Numero De Carro: </label>
    <div class="col-sm-8">
        <?php echo $NoCarro;?>
    </div>
</div>
<div class="form-group">
    <label for="localidad" class="col-sm-4 control-label">Kilometraje: </label>
    <div class="col-sm-8">
        <?php echo $Kilometraje;?>
    </div>
</div>
<div class="form-group">
    <label for="telefono" class="col-sm-4 control-label">Placas</label>
    <div class="col-sm-8">
        <?php echo $NoPlacas;?>
    </div>
</div>
<div class="form-group">
    <label for="celular" class="col-sm-4 control-label">Detalles Del Servicio: </label>
    <div class="col-sm-8">
        <?php echo $DetallesServicio;?>
    </div>
</div>
<div class="form-group">
    <label for="registro" class="col-sm-4 control-label">Observaciones: </label>
    <div class="col-sm-8">
       <?php echo $Observaciones;?>
    </div>
</div>
