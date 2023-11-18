<?php


session_start();
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblcatcat where INTIDCAT='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        while ($row = mysqli_fetch_array($query)) {

            $INTIDCAT = $row['INTIDCAT'];
            $STRNOMCAT = $row['STRNOMCAT'];
            $STRDESCAT = $row['STRDESCAT'];
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
<div class="card" style="width: 50rem;">
  <div class="card-header"> 
    
  </div>
  <ul class="list-group list-group-flush">
    
    <li class="list-group-item"> <strong>ID Categoria: </strong><?php echo $INTIDCAT;?></li>
    <li class="list-group-item"> <strong>Nombre : </strong><?php echo $STRNOMCAT;?></li>
    <li class="list-group-item"> <strong>Descripcion : </strong><?php echo $STRDESCAT;?></li>
    <li class="list-group-item"> <strong>Estado : </strong><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></li>
    <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $DTEHOR;?></small></p>
    
    
  </ul>
</div>