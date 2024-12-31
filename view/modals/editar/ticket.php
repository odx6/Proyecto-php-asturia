<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['Unidades'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcattik where STRPTIK='".$id."'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {
                $STRPTIK = $row["STRPTIK"];
                $INTNO = $row["INTNO"];
                $STRPRUT = $row["STRPRUT"];
                $STRNMRSR = $row["STRNMRSR"];
                $STRPRE = $row["STRPRE"];
                $PCRXLIT = $row["PCRXLIT"];
                $LTS = $row["LTS"];
                $LOC = $row["LOC"];
                $DTEHOR = $row["DTEHOR"];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">

    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="INTNO" class="col-form-label">N°.ticket: </label>
                <input type="text" required class="form-control" id="INTNO" name="INTNO" placeholder="N°.ticket : " value="<?php echo $INTNO?>">

            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="PCRXLIT" class="col-form-label">Preciopor litro : </label>
                <input type="text" required class="form-control" id="PCRXLIT" name="PCRXLIT" placeholder="precio : " value="<?php echo $PCRXLIT?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="" class="col-form-label">N°Litros : </label>
                <input type="text" required class="form-control" id="LTS" name="LTS" placeholder="litros : " value="<?php echo $LTS?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="Localidad" class="col-form-label">Localidad: </label>
                <input type="text" required class="form-control" id="LOC" name="LOC" placeholder="Localidad: " value="<?php echo $LOC?>" >
            </div>


        </div>




    <?php } ?>