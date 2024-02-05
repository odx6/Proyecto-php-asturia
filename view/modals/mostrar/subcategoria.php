<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['Subcategorias'])) {
    require_once("../../../config/config.php");
    require_once("../../../config/funciones.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatsbc where INTIDSBC='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {
                $INTIDSBC = $row['INTIDSBC'];
                $INTIDCAT = $row['INTIDCAT'];
                if (isset($INTIDCAT) && $INTIDCAT != NULL) {
                    $Categoria = mysqli_query($con, "SELECT * FROM tblcatcat WHERE  INTIDCAT='$INTIDCAT'");
                    if (isset($Categoria) && $Categoria != NULL) {
                        $tem = mysqli_fetch_array($Categoria);
                        if (isset($tem) && $tem != NULL) $NombreCategoria = $tem['STRNOMCAT'];
                    }
                }
                $STRNOMSBC = $row['STRNOMSBC'];
                $STRDESBC = $row['STRDESBC'];
                $DTEHOR = $row['DTEHOR'];
                $BITSUS = $row['BITSUS'];
                if ($BITSUS == 1) {
                    $lbl_status = "Activo";
                    $lbl_class = 'label label-success';
                } else {
                    $lbl_status = "Inactivo";
                    $lbl_class = 'label label-danger';
                }
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
    <div class="card-body">
        <strong><i class="fas fa-key"></i> ID</strong>

        <p class="text-muted">
            <?php echo $INTIDSBC ?>
        </p>
        <strong><i class="fas fa-clipboard-list"></i>Categoria</strong>

        <p class="text-muted">
            <?php echo $NombreCategoria ?>
        </p>

        <hr>

        <strong><i class="fas fa-book"></i> Nombre</strong>

        <p class="text-muted"><?php echo $STRNOMSBC; ?></p>

        <hr>

        <strong><i class="fas fa-th-list"></i> Descripcion </strong>

        <p class="text-muted">
            <span class="tag tag-danger"><?php echo $STRDESBC; ?></span>

        </p>

        <hr>
        <?php $icon;
        ($BITSUS == 1) ?  $icon = '<i class="fas fa-toggle-on"></i>' : $icon = '<i class="fas fa-toggle-off"></i>'; ?>
        <strong><?php echo $icon ?> Estado</strong>

        <p class="text-muted"> <?php $status;
                                ($BITSUS == 1) ? $status = 'Activo' : $status = 'Inactivo';
                                echo $status ?></p>

        <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $DTEHOR; ?></small></p>
    </div>

<?php } ?>