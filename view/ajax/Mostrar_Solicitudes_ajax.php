<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/RecuperarDatos.php");
require_once("../../config/funciones.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];

	$id = intval($id);
	$sql2 = recuperarDatos("SELECT * from tblcatslc WHERE LNGIDNSLC='$id';");
	//cancelar folio 
	$folRecuperado="SELECT `INTFOLSLC`, `INTFOLSLCE` FROM `tblcatslc` WHERE  LNGIDNSLC='".$id."'";
	try{
		$Folios=mysqli_query($con,$folRecuperado);
	} catch (mysqli_sql_exception $e) {
		$error[]="error al ejecutar la consulta de cancelacion de folios";
		$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
	}

	if($Folios){
		$filas=mysqli_fetch_assoc($Folios);
        $cancelarFolio="UPDATE `tblcatfol` SET `estado`='0' WHERE id_folio='".$filas['INTFOLSLC']."'";
		try {
			$FolioCancelado = mysqli_query($con, $cancelarFolio);
		} catch (mysqli_sql_exception $e) {
			$error[]="error al cancelar el folio General";
			$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
		} 
		$cancelarFolioE="UPDATE `tblcatfol` SET `estado`='0' WHERE id_folio='".$filas['INTFOLSLCE']."'";
		try {
			$FolioCanceladoE = mysqli_query($con, $cancelarFolioE);
		} catch (mysqli_sql_exception $e) {
			$error[]="error al cancelar el folio Especifico";
			$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
		} 



	}else{
		$error[]="error al cancelar el folios";
	}

	//



	try {
		if (($delete = mysqli_query($con, "DELETE FROM tblcatslc WHERE LNGIDNSLC='$id'"))) {
			$aviso = "Bien hecho!";
			$msj = "Datos eliminados satisfactoriamente.";
			$classM = "alert alert-success";
			$times = "&times;";
			if ($delete) {

				$tabla = "tblcatslc";
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
	//$query = mysqli_real_escape_string($con, (strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query ='';
	$column = (isset($_REQUEST['column']) && $_REQUEST['column'] != NULL) ? $_REQUEST['column'] : '';
	$Table = (isset($_REQUEST['table']) && $_REQUEST['table'] != NULL) ? $_REQUEST['table'] : '';
	$Reload = (isset($_REQUEST['reload']) && $_REQUEST['reload'] != NULL) ? $_REQUEST['reload'] : '';

	$tables = "tblcatslc";
	$campos = "*";
	//dependiendo de por que se quiera filtrar
	//$sWhere=$column." LIKE '%".$query."%'";
	$sWhere = "LNGIDNSLC LIKE '%" . $query . "%'";

	include 'pagination.php'; //include pagination file
	//pagination variables
	//$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	//$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	//$adjacents  = 4; //gap between pages after number of adjacents
	//$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row = mysqli_fetch_array($count_query)) {
		$numrows = $row['numrows'];
	} else {
		echo mysqli_error($con);
	}
	//$total_pages = ceil($numrows / $per_page);
	$reload = $Reload;
	//main query to fetch the data
	//$query = mysqli_query($con, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	$query = mysqli_query($con, "SELECT $campos FROM  $tables where $sWhere");
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
	//if ($numrows > 0) {
	?>
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#ID </th>
					<th>Capturista</th>
					<th>No.Folio general</th>
					<th>No.Folio de empresa</th>
					<th>Fecha de solicitud</th>
					<th>Contacto</th>
					<th>Organizacion</th>
					<th>Vehiculo</th>
					<th>Kilometraje</th>
					<th>Observaciones</th>
					<th>Diagnostico</th>
					<th>Mecanico</th>
					<th>Fecha Diagnostico</th>
					<th>Estado</th>
					<th>Accion</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$finales = 0;
				while ($row = mysqli_fetch_array($query)) {
					$LNGIDNSLC = $row['LNGIDNSLC'];
					$LNGIDNUSR = $row['LNGIDNUSR'];
					$INTFOLSLC = $row['INTFOLSLC'];
					$INTFOLSLCE = $row['INTFOLSLCE'];
					$DTFCHSLC = $row['DTFCHSLC'];

					$LNGIDNCNT = $row['LNGIDNCNT'];
					$LNGIDNORG = $row['LNGIDNORG'];
					$STRNMRSR = $row['STRNMRSR'];
					$STRKLM = $row['STRKLM'];
					$STROBSRPT = $row['STROBSRPT'];
					$STRDGN = $row['STRDGN'];
					$LNGIDNMCN = $row['LNGIDNMCN'];
					$DTFCHDGN = $row['DTFCHDGN'];
					$BITCNCSLC = $row['BITCNCSLC'];


					if ($BITCNCSLC == 1) {
						$lbl_status = "registrada ";
						$lbl_class = 'label label-success';
					} else {
						$lbl_status = "Cancelado";
						$lbl_class = 'label label-danger';
					}



					$finales++;
				?>
					<tr>
						<td><?php echo $LNGIDNSLC ?></td>
						<td><?php consultarNombre($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRNOM');  echo " " ; consultarNombre($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRAPE'); ?></td>
						<td><?php consultarNombre($INTFOLSLC, 'tblcatfol', 'id_folio', 'folio'); ?></td>
						<td><?php consultarNombre($INTFOLSLCE, 'tblcatfol', 'id_folio', 'folio'); ?></td>
						<td><?php echo $DTFCHSLC ?></td>
						<td><?php consultarNombre($LNGIDNCNT, 'tblcatemp', 'IDEMP', 'STRNOM');  echo " " ; consultarNombre($LNGIDNCNT, 'tblcatemp', 'IDEMP', 'STRAPE'); ?></td>
						<td><?php consultarNombre($LNGIDNORG, 'tblcatorg', 'LNGIDNORG', 'STRDSCORG'); ?></td>
						<td><?php echo $STRNMRSR ?></td>
						<td><?php echo $STRKLM." KM" ?></td>
						<td><?php echo $STROBSRPT ?></td>
						<td><?php echo $STRDGN ?></td>
						<td><?php consultarNombre($LNGIDNMCN, 'tblcatemp', 'IDEMP', 'STRNOM');  echo " " ; consultarNombre($LNGIDNMCN, 'tblcatemp', 'IDEMP', 'STRAPE'); ?></td>
						<td><?php echo $DTFCHDGN ?></td>
						<td><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>

						<td class="text-right">
							<?php if (in_array(2, $_SESSION['Habilidad']['Solicitud'])) { ?>

								<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $LNGIDNSLC; ?>','view/modals/editar/solicitud.php');"><i class="fa fa-edit"></i></button>
							<?php } ?>
							<?php if (in_array(3, $_SESSION['Habilidad']['Solicitud'])) { ?>
								<button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $LNGIDNSLC; ?>','view/ajax/Mostrar_Solicitudes_ajax.php','solicitud')"><i class="far fa-trash-alt"></i></button>
							<?php  } ?>
							<?php if (in_array(4, $_SESSION['Habilidad']['Solicitud'])) { ?>
								<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $LNGIDNSLC; ?>','view/modals/mostrar/solicitud.php')"><i class="fa fa-eye"></i></button>
							<?php } ?>
							<?php if (in_array(5, $_SESSION['Habilidad']['Solicitud'])) { ?>
								<form action="?view=Pdfs" method="post">
									<input type="hidden" name="id" value="<?php echo $LNGIDNSLC; ?>">
									<button type="submit" class="btn btn-success btn-square btn-xs" data-toggle="modal" data-target="#"><i class="fas fa-file-pdf"></i></button>
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