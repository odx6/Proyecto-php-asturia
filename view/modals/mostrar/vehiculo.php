<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['vehiculos'])) {

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
    <div class="card-body">
        <strong><i class="fas fa-key"></i> ID</strong>

        <p class="text-muted">
            <?php echo $pk_mov; ?>
        </p>

        <hr>

        <strong><i class="fas fa-mars"></i> Marca</strong>

        <p class="text-muted"><?php echo $STRMAR; ?></p>

        <hr>

        <strong><i class="fab fa-buromobelexperte"></i> Modelo </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRMOD; ?></span>

        </p>
        <hr>
        <strong><i class="far fa-id-card"></i> Placas </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRPLACAS; ?></span>

        </p>
        <hr>
        <strong><i class="fas fa-atom"></i> Tipo </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRTIPO; ?></span>

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