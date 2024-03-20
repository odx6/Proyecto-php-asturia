<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");
require_once("../../../config/RecuperarDatos.php");
if ($_POST['Tipo'] == 1 && isset($_POST['Tipo'])) {
    if (isset($_POST['Inicio']) && isset($_POST['Final'])) {
        $fechainicial = $_POST['Inicio'];
        $fechaFinal = $_POST['Final'];


        $query = mysqli_query($con, "SELECT tblcom.*, tblcatprov.STRNOM AS nameProveedor, tblcatemp.STRNOM as nameEmpleado FROM ((tblcom INNER JOIN tblcatprov ON tblcom.FK_PROVE=tblcatprov.pk_prov ) INNER JOIN tblcatemp ON tblcom.FK_EMP=tblcatemp.IDEMP) WHERE tblcom.DTHOR >='$fechainicial' AND tblcom.DTHOR<='$fechaFinal';");



?>
        <table id="example1" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Identificador</th>
                    <th>proveedor</th>
                    <th>Empleado</th>
                    <th>Remision</th>
                    <th>Factura</th>
                    <th>Fecha de la factura</th>
                    <th>fecha de pago</th>
                    <th>Accion</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $finales = 0;
                while ($row = mysqli_fetch_assoc($query)) {
                    $FK_COM = $row["PK_COMPRA"];
                    $FK_PROVE = $row["FK_PROVE"];
                    $nombreprove = $row['nameProveedor'];

                    $FK_EMP = $row["FK_EMP"];
                    $nameempleado = $row['nameEmpleado'];
                    $STREMI = $row["STREMI"];
                    $STRFACT = $row["STRFACTURA"];
                    $DTHORFAC = $row["DTHORFAC"];
                    $DTHOTPAG = $row["DTHORPAG"];
                    $DTHOR = $row["DTHOR"];


                    $finales++;
                ?>
                    <tr>
                        <td><?php echo $FK_COM ?></td>
                        <td><?php echo $nombreprove ?></td>
                        <td><?php echo $nameempleado ?></td>
                        <td><?php echo $STREMI ?></td>
                        <td><?php echo $STRFACT ?></td>
                        <td><?php echo  $DTHORFAC ?></td>
                        <td><?php echo $DTHOTPAG ?></td>


                        <td class="text-right">
                            <?php if (in_array(1, $_SESSION['Habilidad']['compras'])) { ?>

                                <form action="./?view=EditarCompra" method="POST" role="form">
                                    <input type="hidden" required class="form-control" id="idecompra" name="idecompra" value="<?php echo $FK_COM ?>">
                                    <button type="submit" class="btn btn-warning btn-square btn-xs"><i class="far fa-edit"></i></button>


                                </form>

                            <?php } ?>

                            <?php if (in_array(2, $_SESSION['Habilidad']['compras'])) { ?>

                                <button type="button" class="btn btn-danger btn-square btn-xs" data-toggle="modal" onclick="eliminar('<?php echo $FK_COM; ?>','view/ajax/compras_ajax.php','tblcatmov')"><i class="far fa-trash-alt"></i></button>

                            <?php } ?>
                            <?php if (in_array(3, $_SESSION['Habilidad']['compras'])) { ?>

                                <form action="./?view=mostrarCompra" method="POST" role="form">
                                    <input type="hidden" required class="form-control" id="idecompra" name="idecompra" value="<?php echo $FK_COM ?>">
                                    <button type="submit" class="btn btn-primary btn-square btn-xs"><i class="far fa-eye"></i></button>


                                </form>


                            <?php } ?>

                        </td>
                    </tr>

                <?php } ?>
            </tbody>

            <tfoot>

            </tfoot>
        </table>




    <?php

    } else {
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';;
    }
} else if ($_POST['Tipo'] == 2 && isset($_POST['Tipo'])) {
    if (isset($_POST['Inicio']) && isset($_POST['Final'])) {
        $fechainicial = $_POST['Inicio'];
        $fechaFinal = $_POST['Final'];

        $consulta = "SELECT tbldetcom.* ,tblcom.*,tblcatpro.*, tblcatuni.STRNOMUNI FROM tbldetcom INNER JOIN tblcom ON tblcom.PK_COMPRA=tbldetcom.FK_COM INNER JOIN tblcatpro ON tblcatpro.STRSKU=tbldetcom.FK_SKU INNER JOIN tblcatuni on tblcatuni.INTIDUNI=tbldetcom.FK_UNI where tbldetcom.DTHOR>='$fechainicial' and tbldetcom.DTHOR <='$fechaFinal';";

        $query = mysqli_query($con, $consulta);

    ?>
        <table id="example1" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>#id compra</th>
                    <th>Fecha</th>
                    <th>Remimision</th>
                    <th>Factura</th>
                    <th>sku</th>
                    <th>Descripcion</th>
                    <th>precio</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>PrecioAnterior</th>
                    <th>Subtotal</th>
                    <th>Accion</th>

                </tr>
            </thead>

            <tbody>
                <?php

                while ($row = mysqli_fetch_array($query)) {
                    $FK_COM = $row['FK_COM'];
                    $DTHOR = $row['DTHOR'];
                    $STREMI = $row['STREMI'];
                    $STRFACTURA = $row['STRFACTURA'];
                    $FK_SKU = $row['FK_SKU'];
                    $STRDESPRO = $row['STRDESPRO'];
                    $PCRCOST = $row['PCRCOST'];
                    $INTCANT = $row['INTCANT'];
                    $STRNOMUNI = $row['STRNOMUNI'];
                    $PCRCOSTANTE = $row['PCRCOSTANTE'];
                    $TOTAL = $row['TOTAL'];
                    $PCRCOST = "$" . number_format($PCRCOST, 2, '.', ',');
                    $PCRCOSTANTE = "$" . number_format($PCRCOSTANTE, 2, '.', ',');
                    $TOTAL = "$" . number_format($TOTAL, 2, '.', ',');


                    /*$kind=$row['kind'];*/


                ?>
                    <tr>
                        <td><?php echo $FK_COM ?></td>
                        <td><?php echo $DTHOR  ?></td>


                        <td><?php echo $STREMI ?></td>
                        <td><?php echo $STRFACTURA ?></td>
                        <td><?php echo $FK_SKU ?></td>
                        <td><?php echo $STRDESPRO ?></td>
                        <td><?php echo $PCRCOST ?></td>
                        <td><?php echo $INTCANT ?></td>
                        <td><?php echo $STRNOMUNI ?></td>
                        <td><?php echo $PCRCOSTANTE ?></td>
                        <td><?php echo $TOTAL ?></td>

                        <td class="text-right">
                            <?php if (in_array(1, $_SESSION['Habilidad']['compras'])) { ?>

                                <form action="./?view=EditarCompra" method="POST" role="form">
                                    <input type="hidden" required class="form-control" id="idecompra" name="idecompra" value="<?php echo $FK_COM ?>">
                                    <button type="submit" class="btn btn-warning btn-square btn-xs"><i class="far fa-edit"></i></button>


                                </form>

                            <?php } ?>

                            <?php if (in_array(2, $_SESSION['Habilidad']['compras'])) { ?>

                                <button type="button" class="btn btn-danger btn-square btn-xs" data-toggle="modal" onclick="eliminar('<?php echo $FK_COM; ?>','view/ajax/compras_ajax.php','tblcatmov')"><i class="far fa-trash-alt"></i></button>

                            <?php } ?>
                            <?php if (in_array(3, $_SESSION['Habilidad']['compras'])) { ?>

                                <form action="./?view=mostrarCompra" method="POST" role="form">
                                    <input type="hidden" required class="form-control" id="idecompra" name="idecompra" value="<?php echo $FK_COM ?>">
                                    <button type="submit" class="btn btn-primary btn-square btn-xs"><i class="far fa-eye"></i></button>


                                </form>


                            <?php } ?>

                        </td>


                    </tr>
                <?php } ?>
            </tbody>

            <tfoot>

            </tfoot>
        </table>




<?php

    } else {
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
    }
} else {
    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
}
