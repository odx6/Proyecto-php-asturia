<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];


	try {
		if (($delete = mysqli_query($con, "DELETE FROM tblcatpro WHERE STRSKU='$id'"))) {
			$aviso = "Bien hecho!";
			$msj = "Datos eliminados satisfactoriamente.";
			$classM = "alert alert-success";
			$times = "&times;";
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
	$tables = "logs";
	$campos = "*";
	$sWhere = " tabla LIKE '%" . $query . "%'";
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row = mysqli_fetch_array($count_query)) {
		$numrows = $row['numrows'];
	} else {
		echo mysqli_error($con);
	}
	$total_pages = ceil($numrows / $per_page);
	$reload = './productos-view.php';
	//main query to fetch the data
	$query = mysqli_query($con, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
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
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Empleado</th>
					<th>registro</th>
					<th>Tabla</th>
					<th>Tipo</th>
					<th>Fecha</th>
					<th>Viejos Valores</th>
					<th>Nuevos Valores</th>
					
				</tr>
			</thead>
			
				<tbody>
				<?php
			$finales = 0;

			while ($row = mysqli_fetch_array($query)) {
				$pk_registro=$row['pk_registro'];
				$fk_empleado=$row['fk_empleado'];
				$fk_registro=$row['fk_registro'];
				$tabla=$row['tabla'];
				$Tipo=$row['Tipo'];
				$fecha=$row['fecha'];
				$sql=$row['sql'];
				$new=$row['newvalue'];
				/*$kind=$row['kind'];*/

				$finales++;
			?>
					<tr>
						<td><?php consultarNombre($fk_empleado, 'tblcatemp', 'IDEMP', 'STRNOM'); ?></td>
						<td><?php echo $fk_registro ?></td>
						<td><?php echo $tabla ?></td>
						<td><?php echo $Tipo ?></td>
						<td><?php echo $fecha ?></td>
						<td><?php echo $sql ?></td>
						<td><?php echo $new ?></td>
						

						<td class="text-right">
							
								
							
							
							
							
							<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $fk_registro; ?>')"><i class="fa fa-eye"></i></button>
							

						</td>
					</tr>
					<?php } ?>
				</tbody>
			
			<tfoot>
				<tr>
					<td colspan='10'>
						<?php
						$inicios = $offset + 1;
						$finales += $inicios - 1;
						echo "Mostrando $inicios al $finales de $numrows registros";
						echo paginate($reload, $page, $total_pages, $adjacents);
						?>
					</td>
				</tr>
			</tfoot>
		</table>
<?php
	} else {
		echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
	}
}
?>