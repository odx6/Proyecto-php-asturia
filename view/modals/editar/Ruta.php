<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['Rutas'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatrut where STRPRUT ='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {
                $STRPRUT  = $row["STRPRUT"];
                $STRNOM  = $row["STRNOM"];
                $DOUKM = $row["DOUKM"];
                $BITSUS = $row["BITSUS"];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $STRPRUT  ?>" id="id" name="id" require>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="Nombre" class=" col-form-label">Nombre: </label>
                <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: " value="<?php echo $STRNOM  ?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group"><label for="Telefono" class=" col-form-label">Telefono: </label>
                <input type="number" required class="form-control" id="DOUKM" name="DOUKM" placeholder="Telefono" value="<?php echo $DOUKM ?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="estado" class="col-form-label">Estado: </label>
                <select class="form-control select2" name="BITSUS" id="BITSUS">
                    <option value="1" <?php if ($BITSUS == 1) echo "selected" ?>>Activo</option>
                    <option value="0" <?php if ($BITSUS == 0) echo "selected" ?>>Inactivo</option>
                </select>
            </div>
        </div>
    </div>

 
      
    <?php } ?>