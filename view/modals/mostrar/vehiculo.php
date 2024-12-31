<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['vehiculos'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        //$id = intval($id);
        $sql = "SELECT
    tblcatveh.*,
    tbltpveh.STRNOM AS tipo,
    tblcatorg.STRDSCORG AS origen
FROM
    tblcatveh
    INNER JOIN tbltpveh ON tblcatveh.STRTPVH = tbltpveh.STRTPVH
    INNER JOIN tblcatorg ON tblcatveh.LNGIDNORG = tblcatorg.LNGIDNORG
WHERE
    tblcatveh.STRNMRSR ='$id';";

        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {

                $STRNMRSR = $row["STRNMRSR"];
                $STRNMR = $row["STRNMR"];
                $STRMRC = $row["STRMRC"];
                $STRMDL = $row["STRMDL"];
                $STRPLC = $row["STRPLC"];
                $STRTPVH = $row["tipo"];
                $LNGIDNORG = $row["origen"];
                $DOKLM = $row["DOKLM"];
                $BITSUS = $row["BITSUS"];
                $DTHOR = $row["DTHOR"];
            }
        }
    } else {
        exit;
    }
?>
    <div class="card-body">
        <strong><i class="fas fa-key"></i> ID</strong>

        <p class="text-muted">
            <?php echo $STRNMRSR; ?>
        </p>

        <hr>

        <strong><i class="fas fa-mars"></i>Numero</strong>

        <p class="text-muted"><?php echo $STRNMR; ?></p>

        <hr>

        <strong><i class="fab fa-buromobelexperte"></i> Marca </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRMRC; ?></span>

        </p>
        <hr>
        <strong><i class="far fa-id-card"></i> Modelo </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRMDL; ?></span>

        </p>
        <hr>
        <strong><i class="fas fa-atom"></i> Placas </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRPLC; ?></span>

        </p>
        <hr>
        <strong><i class="fas fa-atom"></i> Tipo </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRTPVH; ?></span>

        </p>
        <hr>
        <strong><i class="fas fa-atom"></i>Origen </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $LNGIDNORG; ?></span>

        </p>
        <strong><i class="fas fa-tachometer-alt"></i><p>Kilometros</p> </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $DOKLM; ?></span>

        </p>
        <hr>
        <?php $icon;
        ($BITSUS == 1) ?  $icon = '<i class="fas fa-toggle-on"></i>' : $icon = '<i class="fas fa-toggle-off"></i>'; ?>
        <strong><?php echo $icon ?> Estado</strong>

        <p class="text-muted"> <?php $status;
                                ($BITSUS == 1) ? $status = 'Activo' : $status = 'Inactivo';
                                echo $status ?></p>

        <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $DTHOR; ?></small></p>
    </div>


<?php } ?>