<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");
require_once("../../config/RecuperarDatos.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
    $id = $_REQUEST["id"];

	$sql2 = recuperarDatos("SELECT * from tblcatprov WHERE pk_prov='$id'");
    try {
        if (($delete = mysqli_query($con, "DELETE FROM tblcatprov WHERE pk_prov='$id'"))) {
            $aviso = "Bien hecho!";
            $msj = "Datos eliminados satisfactoriamente.";
            $classM = "alert alert-success";
            $times = "&times;";
            if ($delete) {

				$tabla = "tblcatprov";
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
    $tables = "tblcatprov";
    $campos = "*";
    $sWhere = " STRMAR LIKE '%" . $query . "%'";
   

    $reload = './productos-view.php';
    //main query to fetch the data
    $query = mysqli_query($con, "SELECT $campos FROM  $tables;");
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
                    <th>#Identificador</th>
                    <th>RFC</th>
                    <th>Nombre</th>
                    <th>Domicilio</th>
                    <th>Telefono</th>
                    <th>Numero de cuenta</th>
                    <th>Nombre del banco</th>
                    <th>Correo</th>
                    <th>Contacto</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $finales = 0;
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


                    $finales++;
                ?>
                    <tr>
                        <td><?php echo $pk_prov ?></td>
                        <td><?php echo $STRRFC ?></td>
                        <td><?php echo $STRNOM ?></td>
                        <td><?php echo $STRDOM ?></td>
                        <td><?php echo $STRTEL ?></td>
                        <td><?php echo $STRNUMCUN ?></td>
                        <td><?php echo $STRNOMBAN ?></td>
                        <td><?php echo $STRCOR?></td>
                        <td><?php echo $STRCONT?></td>
                        <td><?php echo $BITSUS ?></td>
                      
                        <td class="text-right">
                            <?php if (in_array(1, $_SESSION['Habilidad']['proveedores'])) { ?>

                                <button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal"  data-target="#modal_update" onclick="editar('<?php echo $pk_prov; ?>','view/modals/editar/proveedor.php')"><i class="fa fa-edit"></i></button>

                            <?php } ?>
                            <?php if (in_array(2, $_SESSION['Habilidad']['proveedores'])) { ?>

                                <button type="button" class="btn btn-danger btn-square btn-xs" data-toggle="modal" onclick="eliminar('<?php echo $pk_prov; ?>','view/ajax/proveedores_ajax.php','tblcatprov')"><i class="far fa-trash-alt"></i></button>

                            <?php } ?>
                            <?php if (in_array(3, $_SESSION['Habilidad']['proveedores'])) { ?>

                                <button type="button" class="btn btn-primary btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $pk_prov; ?>','view/modals/mostrar/proveedor.php')"><i class="fa fa-eye"></i></button>

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