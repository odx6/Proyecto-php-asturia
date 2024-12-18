<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");
require_once("../../config/RecuperarDatos.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
    $id = $_REQUEST["id"];

    $sql2 = recuperarDatos("SELECT * from tblcatveh WHERE STRNMRSR='$id'");
    try {
        if (($delete = mysqli_query($con, "DELETE FROM tblcatveh WHERE STRNMRSR='$id'"))) {
            $aviso = "Bien hecho!";
            $msj = "Datos eliminados satisfactoriamente.";
            $classM = "alert alert-success";
            $times = "&times;";
            if ($delete) {

                $tabla = "tblcatveh";
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
    $tables = "tblcatveh";
    $campos = "*";
    $sWhere = " STRMRC LIKE '%" . $query . "%'";


    $reload = './productos-view.php';
    //main query to fetch the data
   // $query = mysqli_query($con, "SELECT $campos FROM  $tables;");
     $query = mysqli_query($con, "SELECT tblcatveh.*, tbltpveh.STRNOM AS tipo,tblcatorg.STRDSCORG AS origen FROM tblcatveh INNER JOIN tbltpveh ON tblcatveh.STRTPVH = tbltpveh.STRTPVH INNER JOIN tblcatorg ON tblcatveh.LNGIDNORG=tblcatorg.LNGIDNORG;");
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
                <th>Número</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Placas</th>
                <th>Tipo</th>
                <th>Origen</th>
                <th>Estado</th>
                <th>fecha</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $finales = 0;
            while ($row = mysqli_fetch_array($query)) {
              
                $STRNMRSR = $row["STRNMRSR"];
                $STRNMR = $row["STRNMR"];
                $STRMRC = $row["STRMRC"];
                $STRMDL = $row["STRMDL"];
                $STRPLC = $row["STRPLC"];
                $STRTPVH=$row["tipo"];
                $LNGIDNORG=$row["origen"];
                $BITSUS = $row["BITSUS"];
                $DTHOR = $row["DTHOR"];
                


                ($BITSUS == 1) ? $BITSUS = "Activo" : $BITSUS = "Inactivo";

                $finales++;
            ?>
                <tr>
                    <td><?php echo $STRNMRSR ?></td>
                    <td><?php echo $STRNMR ?></td>
                    <td><?php echo $STRMRC ?></td>
                    <td><?php echo $STRMDL ?></td>
                    <td><?php echo $STRPLC ?></td>
                    <td><?php echo $STRTPVH ?></td>
                    <td><?php echo $LNGIDNORG ?></td>
                    <td><?php echo $BITSUS ?></td>
                    <td><?php echo $DTHOR ?></td>
                    <td class="text-right">
                        <?php if (in_array(2, $_SESSION['Habilidad']['vehiculos'])) { ?>

                            <button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $STRNMRSR; ?>','view/modals/editar/vehiculo.php')"><i class="fa fa-edit"></i></button>

                        <?php } ?>
                        <?php if (in_array(3, $_SESSION['Habilidad']['vehiculos'])) { ?>

                            <button type="button" class="btn btn-danger btn-square btn-xs" data-toggle="modal" onclick="eliminar('<?php echo $STRNMRSR; ?>','view/ajax/vehiculos_ajax.php','tblcatmov')"><i class="far fa-trash-alt"></i></button>

                        <?php } ?>
                        <?php if (in_array(4, $_SESSION['Habilidad']['vehiculos'])) { ?>

                            <button type="button" class="btn btn-primary btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $STRNMRSR; ?>','view/modals/mostrar/vehiculo.php')"><i class="fa fa-eye"></i></button>

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