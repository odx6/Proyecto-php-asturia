<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['vehiculos'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatmov where pk_mov='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {

                $pk_mov = $row['pk_mov'];
                $STRMAR = $row['STRMAR'];
                $STRMOD = $row['STRMOD'];
                $STRPLACAS = $row['STRPLACAS'];
                $STRTIPO = $row['STRTIPO'];
                $DTHOR = $row['DTHOR'];
                $BITSUS = $row['BITSUS'];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $pk_mov ?>" id="id" name="id" require>

    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="marca" class=" col-form-label">Marca: </label>
                <input type="text" required class="form-control" id="STRMAR" name="STRMAR" placeholder="Marca: " value="<?php echo $STRMAR ?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="modelo" class=" col-form-label">Modelo: </label>
                <input type="text" required class="form-control" id="STRMOD" name="STRMOD" placeholder="Modelo: " value="<?php echo $STRMOD ?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="placas" class=" col-form-label">Numero de Placas: </label>
                <input type="text" required class="form-control" id="STRPLACAS" name="STRPLACAS" placeholder="Numero de placas : " value="<?php echo $STRPLACAS ?>">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label for="Tipo" class="col-form-label">Tipo: </label>

                <select class="form-control select2" name="STRTIPO" id="STRTIPO">
                    <option value="1" <?php if ($STRTIPO == 1) echo 'selected' ?>>Moto</option>
                    <option value="2" <?php if ($STRTIPO == 2) echo 'selected' ?>>Carro</option>
                    <option value="3" <?php if ($STRTIPO == 3) echo 'selected' ?>>motocarro</option>
                </select>
            </div>

        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="BITSUS" class="col-form-label">Estado: </label>

                <select class="form-control select2" name="BITSUS" id="BITSUS">
                    <option value="1" <?php if ($STRTIPO == 1) echo 'selected' ?>>Activo</option>
                    <option value="2" <?php if ($STRTIPO == 2) echo 'selected' ?>>Inactivo</option>
                </select>
            </div>

        </div>
    </div>










<?php } ?>