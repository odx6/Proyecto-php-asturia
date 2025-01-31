<?php
session_start();
if (in_array(3, $_SESSION['Habilidad']['Kilometraje'])) {

    require_once("../../../config/config.php");
    require_once("../../../config/funciones.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblreco where STRPRE ='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {
                $STRPRE = $row["STRPRE"];
                $IDEMP = $row["IDEMP"];
                $STRNMRSR = $row["STRNMRSR"];
                $STRPRUT = $row["STRPRUT"];
                $KLMAUTORIZADOS=getDato($STRPRUT,'tblcatrut','STRPRUT','DOUKM');
                $LTSAUTORIZADOS=getDato($STRPRUT,'tblcatrut','STRPRUT','DOULTS');
                $KLMINI = $row["KLMINI"];
                $KLMFIN = $row["KLMFIN"];
                $KLMRECO = $row["KLMRECO"];
                $DOUREN = $row["DOUREN"];
                $INPRT = $row["INPRT"];
                $DOUCON = $row["DOUCON"];
                $DOUDIF = $row["DOUDIF"];
                $DOUDIFLTS = $row["DOUDIFLTS"];
                $DOUDES = $row["DOUDES"];
                $DTHCAP = $row["DTHCAP"];
                $DTHOR = $row["DTHOR"];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $STRPRE  ?>" id="id" name="id" require>
    <input type="hidden" value="<?php echo $id  ?>" id="checador" name="checador" require>
    <div class="row">
        <p> esta a punto de cerrar  el registro <font color="green" s><?php echo  $STRPRE ?></font> del automovil <font color="green"><?php echo  $STRNMRSR ?></font>   con kilometraje <strong> <?php echo  $DOUDIF."/".$KLMAUTORIZADOS ?> </strong> y diferencia en litros <strong><?php echo  $DOUDIFLTS."/".$LTSAUTORIZADOS ?> </strong> .  </p>
        <div class="col-12">
        <div class="form-group">
            <label for="RFC" class=" col-form-label">Si no hay descuento deja por defecto 0 , si hay descuento proporcionalo: </label>
            <input type="number"  class="form-control" id="descuento" name="descuento" placeholder="descuento: " value="0">
        </div>
        </div>
      
    </div>

<?php } ?>