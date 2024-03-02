<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['proveedores'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatprov where pk_prov='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {
                $pk_prov = $row["pk_prov"];
                $STRRFC = $row["STRRFC"];
                $STRNOM = $row["STRNOM"];
                $STRDOM = $row["STRDOM"];
                $STRTEL = $row["STRTEL"];
                $STRNUMCUN = $row["STRNUMCUN"];
                $STRNOMBAN = $row["STRNOMBAN"];
                $STRCOR = $row["STRCOR"];
                $STRCONT = $row["STRCONT"];
                $BITSUS = $row["BITSUS"];
                $DTHOR = $row["DTHOR"];
            }
        }
    } else {
        exit;
    }
?>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <strong><i class="fas fa-key"></i> ID</strong>

                <p class="text-muted">
                    <?php echo $pk_prov; ?>
                </p>

                <hr>
            </div>
            <div class="col-4"> <strong><i class="far fa-id-card"></i> RFC</strong>

                <p class="text-muted"><?php echo $STRRFC; ?></p>

                <hr>
            </div>
            <div class="col-4">

                <strong><i class="fas fa-signature"></i> Nombre </strong>

                <p class="text-muted">
                    <span class="tag tag-danger"><?php echo $STRNOM; ?></span>

                </p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-6"><i class="far fa-address-card"></i> Domicilio </strong>

                <p class="text-muted">
                    <span class="tag tag-danger"><?php echo $STRDOM; ?></span>

                </p>
                <hr>
            </div>
            <div class="col-6"> <strong><i class="fas fa-phone"></i> Telefono</strong>

                <p class="text-muted">
                    <span class="tag tag-danger"><?php echo $STRTEL; ?></span>

                </p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-6"><strong><i class="fas fa-money-check-alt"></i> Cuenta</strong>

                <p class="text-muted">
                    <span class="tag tag-danger"><?php echo $STRNUMCUN; ?></span>

                </p>
                <hr>
            </div>
            <div class="col-6">

                <strong><i class="fas fa-university"></i> Nombre del banco</strong>

                <p class="text-muted">
                    <span class="tag tag-danger"><?php echo $STRNOMBAN; ?></span>

                </p>
                <hr>
                </i>
            </div>
        </div>
        <div class="row">
            <div class="col-6"> <strong><i class="fas fa-at"></i> Correo </strong>

                <p class="text-muted">
                    <span class="tag tag-danger"><?php echo $STRCOR; ?></span>

                </p>
                <hr>
            </div>
            <div class="col-6">
                <div class="col-6"><strong> <i class="fas fa-id-card-alt"></i>Contacto </strong>

                    <p class="text-muted">
                        <span class="tag tag-danger"><?php echo $STRCONT; ?></span>

                    </p>
                    <hr>
                </div>
            </div>




            <?php $icon;
            ($BITSUS == 1) ?  $icon = '<i class="fas fa-toggle-on"></i>' : $icon = '<i class="fas fa-toggle-off"></i>'; ?>
            <strong><?php echo $icon ?> Estado</strong>

            <p class="text-muted"> <?php $status;
                                    ($BITSUS == 1) ? $status = 'Activo' : $status = 'Inactivo';
                                    echo $status ?></p>

            <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $DTHOR; ?></small></p>
        </div>


    <?php } ?>