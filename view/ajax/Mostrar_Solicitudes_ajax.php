<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/RecuperarDatos.php");
if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];

	$id = intval($id);
	$sql2 = recuperarDatos("SELECT * from solicitud WHERE pk_solicitud='$id';");

	try {
		if (($delete = mysqli_query($con, "DELETE FROM solicitud WHERE pk_solicitud='$id'"))) {
			$aviso = "Bien hecho!";
			$msj = "Datos eliminados satisfactoriamente.";
			$classM = "alert alert-success";
			$times = "&times;";
			if ($delete) {

				$tabla = "solicitud";
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

	$tables = "solicitud";
	$campos = "*";
	//dependiendo de por que se quiera filtrar
	//$sWhere=$column." LIKE '%".$query."%'";
	$sWhere = "pk_solicitud LIKE '%" . $query . "%'";

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
	if ($numrows > 0) {
	?>
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#Id Orden </th>
					<th> Empleado </th>
					<th>No.Folio</th>
					<th>Fecha</th>
					<th>Operador</th>
					<th>No.Carro</th>
					<th>Kilometraje</th>
					<th>No.Placas</th>
					<th>Detalles del servicio</th>
					<th>Observaciones</th>
					<th>Accion</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$finales = 0;
				while ($row = mysqli_fetch_array($query)) {
					$id = $row['pk_solicitud'];
					$empleado = $row['fk_empleado'];
					//Name Empleado 
					if (isset($empleado) && $empleado != NULL) {
						$Empleado = mysqli_query($con, "SELECT * FROM tblcatemp WHERE IDEMP='$empleado'");
						$tem = mysqli_fetch_array($Empleado);
						$NombreEmpleado = $tem['STRNOM'] . " " . $tem['STRAPE'];
					}
					//
					$Folio = $row['NumeroFolio'];
					$Fecha = $row['fecha'];
					$Operador = $row['operador'];
					$Carro = $row['NoCarro'];
					$Kilometraje = $row['Kilometraje'];
					$Placas = $row['NoPlacas'];
					$Detalles = $row['DetallesServicio'];
					$Observacione = $row['Observaciones'];



					$finales++;
				?>
					<tr>
						<td><?php echo $id ?></td>
						<td><?php echo $NombreEmpleado ?></td>
						<td><?php echo $Folio ?></td>
						<td><?php echo $Fecha ?></td>
						<td><?php echo $Operador ?></td>
						<td><?php echo $Carro ?></td>
						<td><?php echo $Kilometraje ?></td>
						<td><?php echo $Placas ?></td>
						<td><?php echo $Detalles ?></td>
						<td><?php echo $Observacione ?></td>

						<td class="text-right">
							<?php if (in_array(2, $_SESSION['Habilidad']['Solicitud'])) { ?>

								<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $id; ?>','view/modals/editar/solicitud.php');"><i class="fa fa-edit"></i></button>
							<?php } ?>
							<?php if (in_array(3, $_SESSION['Habilidad']['Solicitud'])) { ?>
								<button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $id; ?>','view/ajax/Mostrar_Solicitudes_ajax.php','solicitud')"><i class="far fa-trash-alt"></i></button>
							<?php  } ?>
							<?php if (in_array(4, $_SESSION['Habilidad']['Solicitud'])) { ?>
								<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $id; ?>','view/modals/mostrar/solicitud.php')"><i class="fa fa-eye"></i></button>
							<?php } ?>
							<?php if (in_array(5, $_SESSION['Habilidad']['Solicitud'])) { ?>
								<form action="?view=Pdfs" method="post">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
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
}
?>