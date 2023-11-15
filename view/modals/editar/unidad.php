<?php
session_start();
require_once("../../../config/config.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblcatuni where INTIDUNI='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        while ($row = mysqli_fetch_array($query)) {

            $STRNOMUNI = $row['STRNOMUNI'];
            $STRDESUNI= $row['STRDESUNI'];
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
    <label for="dni" class="col-sm-2 control-label">Nombre : </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRNOMUNI" name="STRNOMUNI" placeholder="Nombre unidad: " value="<?php echo $STRNOMUNI ?>">
    </div>
</div>
<div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Descripcion: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRDESUNI" name="STRDESUNI" placeholder="Descripcion: " value="<?php echo $STRDESUNI ?>">
    </div>
</div>


<div class="form-group">
    <label for="estado" class="col-sm-2 control-label">Estado: </label>
    <div class="col-sm-10">
        <select class="form-control" name="BITSUS" id="BITSUS">
            <option value="1" <?php if($BITSUS==1 ) echo "selected"; ?>>Activo</option>
            <option value="2"  <?php if($BITSUS==2 ) echo "selected"; ?>>Inactivo</option>
        </select>
    </div>
</div>

