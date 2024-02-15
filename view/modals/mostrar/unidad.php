<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['Unidades'])) {

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
        $STRDESUNI = $row['STRDESUNI'];
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
    <?php echo $id; ?>
    </p>

    <hr>

    <strong><i class="fas fa-book"></i> Nombre</strong>

    <p class="text-muted"><?php echo $STRNOMUNI; ?></p>

    <hr>

    <strong><i class="fas fa-th-list"></i> Descripcion </strong>

    <p class="text-muted">
      <span class="tag tag-danger"><?php echo $STRDESUNI; ?></span>

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