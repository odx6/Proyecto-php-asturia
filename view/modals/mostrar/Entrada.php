<?php
session_start();
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");
if (isset($_GET["id"])) {
    $idempleado = $_SESSION['user_id'];
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblinv where INTIDINV='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        while ($row = mysqli_fetch_array($query)) {
            $INTIDINV = $row['INTIDINV'];
            $DTEFEC = $row['DTEFEC'];
            $INTIDTOP = $row['INTIDTOP'];
            $INTTIPMOV = $row['INTTIPMOV'];
            $INTTIPMOV = $row['INTTIPMOV'];
            $INTFOL = $row['INTFOL'];
            $IDEMP = $row['IDEMP'];
            $STROBS = $row['STROBS'];
            $INTALM = $row['INTALM'];
            $DTEHOR = $row['DTEHOR'];
        }

        $sql2 = "SELECT * FROM tblinvdet WHERE INTIDINV='$INTIDINV';";
        $consulta = mysqli_query($con, $sql2);
    }
} else {
    exit;
}
?>

<div class="col-sm-6">
   
    <div class="col-sm-6"> <STROng><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;Fecha :</STROng></div>
    <div class="col-sm-6"><?php echo $DTEFEC ?></div>
    <div class="col-sm-6"><STRong><i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp;Folio :</STRong></div>
    <div class="col-sm-6"><?php echo $INTFOL ?></div>

</div>
<div class="col-sm-6">
    <div class="col-sm-6"> <STROng><i class="fa fa-comments" aria-hidden="true"></i> &nbsp;Descripcion :</STROng></div>
    <div class="col-sm-6"><?php echo $STROBS ?></div>
    <div class="col-sm-6"><STRong><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;Almacen :</STRong></div>
    <div class="col-sm-6"><?php consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM'); ?></div>
</div>
<div class="col-md-12">

<p>&nbsp;</p>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#id</th>
            <th>#id inventario</th>
            <th>Sku</th>
            <th>Referencia</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Fecha de creacion</th>


        </tr>
    </thead>
    <?php
    $finales = 0;
    while ($row = mysqli_fetch_array($consulta)) {

        $INTIDDET = $row['INTIDDET'];
        $INTIDINV = $row['INTIDINV'];
        $SKU = $row['SKU'];
        $STRREF = $row['STRREF'];
        $INTCAN = $row['INTCAN'];
        $INTIDUNI = $row['INTIDUNI'];
        $MONPRCOS = $row['MONPRCOS'];
        $MONCTOPRO = $row['MONCTOPRO'];
        $DTEHOR = $row['DTEHOR'];

        $finales++;
    ?>
        <tbody>
            <tr>
                <td><?php echo $INTIDDET ?></td>
                <td><?php echo $INTIDINV ?></td>
                <td><?php echo $SKU ?></td>
                <td><?php echo $STRREF ?></td>
                <td><?php echo $INTCAN ?></td>
                <td><?php consultarNombre($INTIDUNI, 'tblcatuni', 'INTIDUNI', 'STRNOMUNI'); ?></td>
                <td><?php echo $MONPRCOS ?></td>
                <td><?php echo $MONCTOPRO ?></td>
                <td><?php echo $DTEHOR ?></td>


            </tr>
        </tbody>
    <?php } ?>

</table>