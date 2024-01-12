<?php
session_start();
if(in_array(4,$_SESSION['Habilidad']['Subcategorias'])){ 
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblcatsbc where INTIDSBC='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        while ($row = mysqli_fetch_array($query)) {
            $INTIDSBC =$row['INTIDSBC'];
            $INTIDCAT = $row['INTIDCAT'];
            if (isset($INTIDCAT) && $INTIDCAT != NULL) {
                $Categoria = mysqli_query($con, "SELECT * FROM tblcatcat WHERE  INTIDCAT='$INTIDCAT'");
                if (isset($Categoria) && $Categoria != NULL) {
                $tem = mysqli_fetch_array($Categoria);
                if(isset($tem) && $tem != NULL)$NombreCategoria = $tem['STRNOMCAT'];
                }
            }
            $STRNOMSBC = $row['STRNOMSBC'];
            $STRDESBC = $row['STRDESBC'];
            $DTEHOR = $row['DTEHOR'];
            $BITSUS = $row['BITSUS'];
            if ($BITSUS == 1) {
				$lbl_status = "Activo";
				$lbl_class = 'label label-success';
			} else {
				$lbl_status = "Inactivo";
				$lbl_class = 'label label-danger';
			}
        }
    }
} else {
    exit;
}
?>
<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
<div class="card" style="width: 50rem;">
  <div class="card-header"> 
    
  </div>
  <ul class="list-group list-group-flush">
    
    <li class="list-group-item"> <strong>ID Subategoria: </strong><?php echo $INTIDSBC;?></li>
   
    <li class="list-group-item"> <strong>Categoria : </strong><?php  consultarNombre($INTIDCAT,'tblcatcat','INTIDCAT','STRNOMCAT'); ?></li>
    <li class="list-group-item"> <strong>Nombre : </strong><?php echo $STRNOMSBC;?></li>
    <li class="list-group-item"> <strong>Descripcion : </strong><?php echo $STRDESBC;?></li>
    <li class="list-group-item"> <strong>Estado : </strong><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></li>
    <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $DTEHOR;?></small></p>
    
    
  </ul>
</div>
 <?php }?>