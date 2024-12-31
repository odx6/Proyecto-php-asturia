<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");
require_once("../../config/RecuperarDatos.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
    $id = $_REQUEST["id"];

    $sql2 = recuperarDatos("SELECT * from tblreco WHERE STRPRE='$id'");
    try {
        if (($delete = mysqli_query($con, "DELETE FROM tblreco WHERE STRPRE='$id'"))) {
            $aviso = "Bien hecho!";
            $msj = "Datos eliminados satisfactoriamente.";
            $classM = "alert alert-success";
            $times = "&times;";
            if ($delete) {

                $tabla = "tblreco";
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
    $tables = "tblreco";
    $campos = "*";
    $sWhere = " STRPRE LIKE '%" . $query . "%'";


    $reload = './productos-view.php';
    //main query to fetch the data
    // $query = mysqli_query($con, "SELECT $campos FROM  $tables;");
    $query = mysqli_query($con, "SELECT tblreco.*, tblcatemp.STRNOM AS Operador, tblcatemp.STRAPE AS Aoperador, tblcatveh.STRNMR AS NCar, tblcatveh.STRMRC AS Mcar, tblcatrut.STRNOM AS ruta FROM tblreco INNER JOIN tblcatemp ON tblcatemp.IDEMP=tblreco.IDEMP INNER JOIN tblcatveh ON tblcatveh.STRNMRSR=tblreco.STRNMRSR INNER JOIN tblcatrut ON tblcatrut.STRPRUT=tblreco.STRPRUT;");
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
                <th>#CLAVE</th>
                <th>OPERADOR</th>
                <th>VEHICULO</th>
                <th>Ticket</th>

                <th>RUTA</th>
                <th>KILOMETRAJE DE INICIO</th>
                <th>KILOMETRAJE FINAL</th>
                <th>KILOMETRAJE RECORRIDO</th>
                <th>RENDIMIENTO POR LITRO</th>
                <th>IMPORTE</th>
                <th>CONSUMO</th>
                <th>DIFERENCIA</th>
                <th>SALDO</th>
                <th>CAPTURA</th>
                <th>Creacion</th>

                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $finales = 0;
            while ($row = mysqli_fetch_array($query)) {

                $STRPRE = $row["STRPRE"];
                $IDEMP = $row["IDEMP"];
                $STRNMRSR = $row["STRNMRSR"];
                $STRPRUT = $row["STRPRUT"];
                $KLMINI = $row["KLMINI"];
                $KLMFIN = $row["KLMFIN"];
                $KLMRECO = $row["KLMRECO"];
                $DOUREN = $row["DOUREN"];
                $INPRT = $row["INPRT"];
                $DOUCON = $row["DOUCON"];
                $DOUDIF = $row["DOUDIF"];
                $DOUDES = $row["DOUDES"];
                $DTHCAP = $row["DTHCAP"];
                $DTHOR = $row["DTHOR"];
                //datos

                $NameOp = $row["Operador"] . " " . $row["Aoperador"];
                $ruta = $row["ruta"];





                $finales++;
            ?>
                <tr>
                    <td><?php echo $STRPRE ?></td>
                    <td><?php echo $NameOp ?></td>
                    <td><?php echo $STRNMRSR ?></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-square btn-xs" onclick="MostrarTickets('<?php echo $STRPRE ?>')"><i class="far fa-plus-square"></i></button>
                        <table id="table_tickets<?php echo $STRPRE ?>" class="table table-head-fixed text-nowrap" style="display: none;">

                            <thead>
                                <tr>

                                    <th>N°</th>
                                    <th>Precio</th>
                                    <th>N° litros</th>
                                    <th>Localidad</th>
                                    <th>Fecha</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $importe = 0;
                                $totalts = 0;

                                $tickets = " SELECT * FROM `tblcattik` WHERE STRPRE='" . $STRPRE . "';";
                                $query_tickets = mysqli_query($con, $tickets);
                                if( mysqli_num_rows($query_tickets) > 0){

                                while ($row = mysqli_fetch_array($query_tickets)) {

                                    $STRPTIK = $row["STRPTIK"];
                                    $INTNO = $row["INTNO"];
                                    $STRPRUT = $row["STRPRUT"];
                                    $STRNMRSR = $row["STRNMRSR"];
                                    $STRPRE = $row["STRPRE"];
                                    $PCRXLIT = $row["PCRXLIT"];
                                    $LTS = $row["LTS"];
                                    $LOC = $row["LOC"];
                                    $DTEHOR = $row["DTEHOR"];

                                    $autorizado=getDato($STRPRUT,'tblcatrut','STRPRUT','DOUKM');
                                    //datos

                                    $importe += $PCRXLIT * $LTS;
                                    $totalts += $LTS;



                                    $finales++;
                                ?>
                                    <tr>

                                        <td><?php echo $INTNO ?></td>
                                        <td><?php echo $PCRXLIT ?></td>
                                        <td><?php echo $LTS ?></td>
                                        <td><?php echo $LOC ?></td>
                                        <td><?php echo $DTHOR ?></td>
                                        <td class="text-right">
                                            <?php if (in_array(2, $_SESSION['Habilidad']['Kilometraje'])) { ?>

                                                <button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update_ticket" onclick="editar('<?php echo $STRPTIK; ?>','view/modals/editar/ticket.php')"><i class="fa fa-edit"></i></button>

                                            <?php } ?>
                                            <?php if (in_array(3, $_SESSION['Habilidad']['Kilometraje'])) { ?>

                                                <button type="button" class="btn btn-danger btn-square btn-xs" data-toggle="modal" onclick="eliminar('<?php echo $STRPTIK; ?>','view/ajax/agregar/eliminar_ticket.php','tblcatmov')"><i class="far fa-trash-alt"></i></button>

                                            <?php } ?>
                                            <?php if (in_array(4, $_SESSION['Habilidad']['Kilometraje'])) { ?>

                                                 <!--<button type="button" class="btn btn-primary btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $STRPTIK; ?>','view/modals/mostrar/vehiculo.php')"><i class="fa fa-eye"></i></button>-->

                                            <?php } ?>


                                        </td>
                                    </tr>

                                <?php }
                                }else{

                                }
                                ?>
                            </tbody>

                            <tfoot>

                            </tfoot>
                        </table>
                    </td>
                    <td><?php echo $ruta ?></td>
                    <td><?php echo $KLMINI . "km" ?></td>
                    <td><?php echo $KLMFIN . "km" ?></td>
                    <td><?php echo $KLMRECO . "km" ?></td>
                    <td><?php $DOUDIF=$KLMFIN-$KLMINI;
                        // $rendimiento = $DOUDIF / $totalts;
                        //echo $rendimiento ?></td>
                    <td><?php echo $importe ?></td>
                    <td><?php echo $totalts ?></td>
                    <td><?php $DOUDIF=$KLMFIN-$KLMINI;
                        //$rendimiento = $DOUDIF / $totalts;
                        //echo $rendimiento ?></td>
                    <td><?php $DOUDES=$autorizado-$KLMRECO; echo $DOUDES ?></td>
                    <td><?php echo $DTHCAP ?></td>
                    <td><?php echo $DTHOR ?></td>
                    <td class="text-right">
                        <?php if (in_array(2, $_SESSION['Habilidad']['Kilometraje'])) { ?>

                            <button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $STRPRE; ?>','view/modals/editar/Recorrido.php')"><i class="fa fa-edit"></i></button>

                        <?php } ?>
                        <?php if (in_array(3, $_SESSION['Habilidad']['Kilometraje'])) { ?>

                            <button type="button" class="btn btn-danger btn-square btn-xs" data-toggle="modal" onclick="eliminar('<?php echo $STRPRE; ?>','view/ajax/recorrido_ajax.php','tblcatmov')"><i class="far fa-trash-alt"></i></button>

                        <?php } ?>
                        <?php if (in_array(4, $_SESSION['Habilidad']['Kilometraje'])) { ?>

                             <!--<button type="button" class="btn btn-primary btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $STRPRE; ?>','view/modals/mostrar/vehiculo.php')"><i class="fa fa-eye"></i></button>-->

                        <?php } ?>
                        <?php if (in_array(1, $_SESSION['Habilidad']['Kilometraje'])) { ?>

                           <button type="button" class="btn btn-primary btn-square btn-xs" data-toggle="modal" data-target="#ticket_modal" onclick="ChangeValue('<?php echo $STRPRE; ?>','view/modals/agregar/agregar_ticket.php')"><i class="fas fa-ticket-alt"></i></button>
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