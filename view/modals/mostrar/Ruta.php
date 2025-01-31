<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['Rutas'])) {
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
        $DOULTS = $row["DOULTS"];
        $BITSUS = $row["BITSUS"];
        $DTHCRE = $row["DTHCRE"];
      }
    }
  } else {
    exit;
  }
?>

  <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
  <div class="card-body">
    <strong><i class="fas fa-key"></i>
      <P>ID</P>
    </strong>

    <p class="text-muted">
      <?php echo $id; ?>
    </p>

    <hr>

    <strong><i class="fas fa-book"></i>
      <P>Nombre</P>
    </strong>

    <p class="text-muted"><?php echo $STRNOM; ?></p>

    <hr>

    <strong><i class="fas fa-th-list"></i>
      <P>Kilometros Autorizados</P>
    </strong>

    <p class="text-muted">
      <span class="tag tag-danger"><?php echo $DOUKM . " KM"; ?></span>

    </p>
    <hr>

    <strong><i class="fas fa-th-list"></i>
      <P>Litros Autorizados</P>
    </strong>

    <p class="text-muted">
      <span class="tag tag-danger"><?php echo $DOULTS . " lts"; ?></span>

    </p>


    <hr>
    <?php $icon;
    ($BITSUS == 1) ?  $icon = '<i class="fas fa-toggle-on"></i>' : $icon = '<i class="fas fa-toggle-off"></i>'; ?>
    <strong><?php echo $icon ?> <P>Estado</P></strong>

    <p class="text-muted"> <?php $status;
                            ($BITSUS == 1) ? $status = 'Activo' : $status = 'Inactivo';
                            echo $status ?></p>

    <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $DTHCRE; ?></small></p>
  </div>


<?php } ?>