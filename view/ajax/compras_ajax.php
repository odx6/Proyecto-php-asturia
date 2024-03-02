<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");
require_once("../../config/RecuperarDatos.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
    $id = $_REQUEST["id"];

    $sql2 = recuperarDatos("SELECT * from tblcom WHERE PK_COMPRA='$id'");
    try {
        if (($delete = mysqli_query($con, "DELETE FROM tblcom WHERE PK_COMPRA='$id'"))) {
            $aviso = "Bien hecho!";
            $msj = "Datos eliminados satisfactoriamente.";
            $classM = "alert alert-success";
            $times = "&times;";
            if ($delete) {

                $tabla = "tblcom";
                $tipo = "Eliminacion";
                $fecha = date("Y-m-d H:i:s");

                $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                $query = mysqli_query($con, $sqllog);
            }
        } else {
            $aviso = "Aviso!";
            $msj = "Error al eliminar los datos " . mysqli_error($con);
            $classM = "alert alert-danger";
            $times = "&times;";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            $aviso = "Aviso!";
            $msj = "El dato que intentas eliminar tiene relacion con otros registros por favor verifica que no dependa de otros registros Codigo de Error:" . $e->getCode();
            $classM = "alert alert-danger";
            $times = "&times;";
        } else {
            $aviso = "Aviso!";
            $msj = "Error al eliminar los datos " . $e->getMessage() . " " . $e->getCode();
            $classM = "alert alert-danger";
            $times = "&times;";
        }
    }
}

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $query = mysqli_real_escape_string($con, (strip_tags($_REQUEST['query'], ENT_QUOTES)));
    $tables = "tblcom";
    $campos = "*";
    $sWhere = " FK_PROVE LIKE '%" . $query . "%'";


    $reload = './productos-view.php';
    //main query to fetch the data
    //$query = mysqli_query($con, "SELECT $campos FROM  $tables;");
    $query=mysqli_query($con,"SELECT tblcom.*, tblcatprov.STRNOM AS nameProveedor, tblcatemp.STRNOM as nameEmpleado FROM ((tblcom INNER JOIN tblcatprov ON tblcom.FK_PROVE=tblcatprov.pk_prov ) INNER JOIN tblcatemp ON tblcom.FK_EMP=tblcatemp.IDEMP);");
    //loop through fetched data

    if (isset($_REQUEST["id"])) {
?>
        <div class="<?php echo $classM; ?>">
            <button type="button" class="close" data-dismiss="alert"><?php echo $times; ?></button>
            <strong><?php echo $aviso ?> </strong>
            <?php echo $msj; ?>
        </div>
    <?php
    }
    //  if ($numrows > 0) {
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
                $PK_COMPRA = $row["PK_COMPRA"];
                $FK_PROVE = $row["FK_PROVE"];
                $nombreprove=$row['nameProveedor'];
               
                $FK_EMP = $row["FK_EMP"];
                $nameempleado=$row['nameEmpleado'];
                $STREMI = $row["STREMI"];
                $STRFACT = $row["STRFACTURA"];
                $DTHORFAC = $row["DTHORFAC"];
                $DTHOTPAG = $row["DTHORPAG"];
                $DTHOR = $row["DTHOR"];


                $finales++;
            ?>
                <tr>
                    <td><?php echo $PK_COMPRA ?></td>
                    <td><?php echo $nombreprove ?></td>
                    <td><?php echo $nameempleado ?></td>
                    <td><?php echo $STREMI ?></td>
                    <td><?php echo $STRFACT ?></td>
                    <td><?php echo  $DTHORFAC ?></td>
                    <td><?php echo $DTHOTPAG ?></td>

                  
                    <td class="text-right">
                        <?php if (in_array(1, $_SESSION['Habilidad']['compras'])) { ?>

                            <form action="./?view=EditarCompra" method="POST" role="form">
                              <input type="hidden" required class="form-control" id="idecompra" name="idecompra"  value="<?php echo $PK_COMPRA ?>">
							  <button type="submit" class="btn btn-warning btn-square btn-xs" ><i class="far fa-edit"></i></button>


							  </form>

                        <?php } ?>
                        
                        <?php if (in_array(2, $_SESSION['Habilidad']['compras'])) { ?>

                            <button type="button" class="btn btn-danger btn-square btn-xs" data-toggle="modal" onclick="eliminar('<?php echo $PK_COMPRA; ?>','view/ajax/compras_ajax.php','tblcatmov')"><i class="far fa-trash-alt"></i></button>

                        <?php } ?>
                        <?php if (in_array(3, $_SESSION['Habilidad']['compras'])) { ?>

                            <form action="./?view=mostrarCompra" method="POST" role="form">
                              <input type="hidden" required class="form-control" id="idecompra" name="idecompra"  value="<?php echo $PK_COMPRA ?>">
							  <button type="submit" class="btn btn-primary btn-square btn-xs" ><i class="far fa-eye"></i></button>


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
//}
?>