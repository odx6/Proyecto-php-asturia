<?php
session_start();
require_once("../../../config/config.php");
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
        }
    }
} else {
    exit;
}
?>
<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
<div class="form-group">
    <label for="dni" class="col-sm-2 control-label"> IdCategoria : </label>
    <div class="col-sm-10">
        <span><?php echo $id ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dni" class="col-sm-2 control-label"> CATEGORIA: </label>
    <div class="col-sm-10">
    <?php  echo (isset($NombreCategoria)) ? $NombreCategoria : $INTIDCAT; ?>
    </div>
</div>
<div class="form-group">
    <label for="dni" class="col-sm-2 control-label"> Nombre: </label>
    <div class="col-sm-10">
        <?php echo $STRNOMSBC ?>
    </div>
</div>
<div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Descripcion: </label>
    <div class="col-sm-10">
        <?php echo $STRDESBC ?>
    </div>
</div>
<div class="form-group">
    <label for="dni" class="col-sm-2 control-label"> Fecha de creacion: </label>
    <div class="col-sm-10">
        <?php echo $DTEHOR ?>
    </div>
</div>


<div class="form-group">
    <label for="estado" class="col-sm-2 control-label">Estado: </label>
    <div class="col-sm-10">
        <select class="form-control" name="BITSUS" id="BITSUS">
            <option value="1" ($BITSUS="1" ) selected>Activo</option>
            <option value="2" ($BITSUS="2" ) selected>Inactivo</option>
        </select>
    </div>
</div>