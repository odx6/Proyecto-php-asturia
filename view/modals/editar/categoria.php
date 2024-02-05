<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['Categorias'])) {
    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatcat where INTIDCAT='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {

                $STRNOMCAT = $row['STRNOMCAT'];
                $STRDESCAT = $row['STRDESCAT'];
                $DTEHOR = $row['DTEHOR'];
                $BITSUS = $row['BITSUS'];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="dni" class=" col-form-label">Nombre : </label>
                <input type="text" required class="form-control" id="STRNOMCAT" name="STRNOMCAT" placeholder="Nombre Categoria: " value="<?php echo $STRNOMCAT ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="estado" class="col-form-label">Estado: </label>
                <select class="form-control select2" name="BITSUS" id="BITSUS">
                    <option value="1" <?php if ($BITSUS == 1) echo "selected"; ?>>Activo</option>
                    <option value="2" <?php if ($BITSUS == 2) echo "selected"; ?>>Inactivo</option>
                </select>
            </div>

        </div>
    </div>
    <div class="form-group">

        <label for="nombre" class="col-sm-2 control-label">Descripcion: </label>

        <input type="text" required class="form-control" id="STRDESCAT" name="STRDESCAT" placeholder="Descripcion: " value="<?php echo $STRDESCAT ?>">
    </div>
<?php } ?>