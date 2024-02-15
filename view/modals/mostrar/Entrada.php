<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['Entradas'])) {

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


    <input type="hidden" required class="form-control" id="INTIDINV" name="INTIDINV" placeholder="Folio:" value="<?php echo $id ?>">
    <div class="row">
        <div class="col-4"><STROng "><i class=" fas fa-warehouse"></i> &nbsp;Inventario : &nbsp;</STROng><?php echo $INTIDINV ?></div>
        <div class="col-4"><STROng "><i class=" fas fa-calendar-minus"></i> &nbsp;Fecha : &nbsp;</STROng><?php echo $DTEFEC ?></div>
        <div class="col-4"><STRong "><i class=" fas fa-newspaper"></i> &nbsp;Folio : &nbsp;</STRong><?php echo $INTFOL ?></div>
    </div>
    <div class="row">
        <div class="col-12"> <STROng "><i class=" fa fa-comments" aria-hidden="true"></i> &nbsp;Descripcion: &nbsp;</STROng><?php echo $STROBS ?></div>
       
    </div>


   
    <div class="col-md-12">

        <p>&nbsp;</p>
    </div>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <!-- <th>#id</th>
            <th>#id inventario</th>-->
                <th>Sku</th>
                <th>Descripcion</th>
                <th>Referencia</th>
                <th>Cantidad</th>
                <th>Unidad</th>
                <th>Precio</th>
                <th>Total</th>
                <!-- <th>Fecha de creacion</th>-->


            </tr>
        </thead>

        <tbody>
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
                <tr>
                    <!--<td ><?php echo $INTIDDET ?></td>
                <td><?php echo $INTIDINV ?></td>-->
                    <td><?php echo $SKU ?></td>
                    <td><?php consultarNombre($SKU, 'tblcatpro', 'STRSKU', 'STRDESPRO'); ?></td>
                    <td><?php echo $STRREF ?></td>
                    <td><?php echo $INTCAN ?></td>
                    <td><?php consultarNombre($INTIDUNI, 'tblcatuni', 'INTIDUNI', 'STRNOMUNI'); ?></td>
                    <td><?php echo     "$ " . number_format($MONPRCOS, 2, '.', ','); ?> </td>
                    <td><?php echo     "$ " . number_format($MONCTOPRO, 2, '.', ','); ?></td>
                    <!--  <td><?php echo $DTEHOR ?></td>-->


                </tr>
            <?php } ?>
        </tbody>


    </table>

    <?php if (in_array(1, $_SESSION['Habilidad']['Entradas'])) { ?>
        <form action="?view=Pdf" method="post">
            <input type="hidden" name="ide" value="<?php echo $id ?>">
            <button type="submit" class="btn btn-success btn-square btn-xs" data-toggle="modal" data-target="#"><i class="fas fa-file-alt"></i></button>
        </form>
    <?php } ?>
<?php } ?>