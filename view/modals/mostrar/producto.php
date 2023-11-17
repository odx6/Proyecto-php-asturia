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
			$CREATE_AT=$rw['CREATE_AT'];
			//$status=$rw['status'];
			//$created_at=$rw['created_at'];
		}
	}	
	else{exit;}
?>
<input type="hidden" value="<?php echo $id;?>" name="id" id="id">

<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?php echo $STRIMG ?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"> <strong>SKU</strong>  :   <?php echo $SKU;?> </h5>
        <p class="card-text"><strong>Codigo           :</strong> <?php echo $STRCODINT;?> </p>
        <p class="card-text"><strong>Descripcion      :</strong> <?php echo $STRDESPRO;?> </p>
        <p class="card-text"><strong>Categoria        : </strong><?php echo $INTIDCAT?> </p>
        <p class="card-text"><strong>Subategoria      :</strong> <?php echo $INTIDSUBCAT;?> </p>
        <p class="card-text"><strong>Precio           : </strong><?php echo $INTIDSUBCAT;?> </p>
        <p class="card-text"><strong>Unidad de medida :</strong> <?php echo $INTIDSUBCAT;?> </p>
        <p class="card-text"><strong>Tipo de uso      :</strong> <?php echo $INTIDSUBCAT;?> </p>
        <p class="card-text"><strong>Estado           :</strong> <?php echo $INTIDSUBCAT;?> </p>
        <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $CREATE_AT;?></small></p>
      </div>
    </div>
  </div>
</div>

