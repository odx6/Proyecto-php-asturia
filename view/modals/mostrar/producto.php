<?php
	session_start();
	require_once ("../../../config/config.php");
	if (isset($_GET["id"])){
		$id=$_GET["id"];
		$id=intval($id);
		$sql="select * from tblcatpro where STRSKU='$id'";
		$query=mysqli_query($con,$sql);
		$num=mysqli_num_rows($query);
		if ($num==1){
			$rw=mysqli_fetch_array($query);
			$SKU=$rw['STRSKU'];
			$STRCODINT=$rw['STRCOD'];
			//$nombre=$rw['nombre'];
			$STRDESPRO=$rw['STRDESPRO'];
			$INTIDCAT=$rw['INTIDCAT'];
            
			$INTIDSUBCAT=$rw['INTIDSBC'];
			$MONPCOS=$rw['MONPCOS'];
			$INTIDUNI=$rw['INTIDUNI'];
			$STRIMG=$rw['STRIMG'];
			$INTTIPUSO=$rw['INTTIPUSO'];
			$BITSUS=$rw['BITSUS'];
			//$status=$rw['status'];
			//$created_at=$rw['created_at'];
		}
	}	
	else{exit;}
?>
<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
<div class="form-group">
<img width="300px" height="300px" src="<?php echo $STRIMG ?>" alt="Imagen Producto">
</div>
<div class="form-group">
    <label for="dni" class="col-sm-4 control-label">SKU: </label>
    <div class="col-sm-8">
        <?php echo $SKU;?>
    </div>
</div>
<div class="form-group">
    <label for="nombre" class="col-sm-4 control-label">Codigo: </label>
    <div class="col-sm-8">
        <?php echo $STRCODINT;?>
    </div>
</div>
<div class="form-group">
    <label for="apellido" class="col-sm-4 control-label">Descripcion: </label>
    <div class="col-sm-8">
        <?php echo $STRDESPRO;?>
    </div>
</div>
<?php  ?>
<div class="form-group">
    <label for="usuario" class="col-sm-4 control-label">Categoria : </label>
    <div class="col-sm-8">
        <?php echo $INTIDCAT;?>
    </div>
</div>
<div class="form-group">
    <label for="email" class="col-sm-4 control-label">SubCategoria: </label>
    <div class="col-sm-8">
       <?php echo $INTIDSUBCAT;?>
    </div>
</div>
<!-- <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Contraseña: </label>
    <div class="col-sm-8">
        <input type="password" class="form-control" id="password" name="password" placeholder="*******">
        <p class="text-right text-muted">La contraseña solo se modifica si escribes algo!.</p>
    </div>
</div> -->
<div class="form-group">
    <label for="domicilio" class="col-sm-4 control-label">Precio: </label>
    <div class="col-sm-8">
        <?php echo $MONPCOS;?>
    </div>
</div>
<div class="form-group">
    <label for="localidad" class="col-sm-4 control-label">Unidad de medida: </label>
    <div class="col-sm-8">
        <?php echo $INTIDUNI;?>
    </div>
</div>
<div class="form-group">
    <label for="telefono" class="col-sm-4 control-label">Imagen</label>
    <div class="col-sm-8">
        <?php echo $STRIMG;?>
    </div>
</div>
<div class="form-group">
    <label for="celular" class="col-sm-4 control-label">Pertenece al taller : </label>
    <div class="col-sm-8">
        <?php echo $INTTIPUSO;?>
    </div>
</div>

<div class="form-group">
    <label for="estado" class="col-sm-4 control-label">Estado: </label>
    <div class="col-sm-8">
        <?php echo ($BITSUS==1)?  "Activo" :  "Inactivo";?>
    </div>
</div>
