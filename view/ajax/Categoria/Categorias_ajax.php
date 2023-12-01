<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../../config/config.php");
if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];
	$id = intval($id);

	try {
		if ($delete = mysqli_query($con, "DELETE FROM tblcatcat WHERE INTIDCAT='$id'")) {
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
	$tables = "tblcatcat";
	$campos = "*";
	$sWhere = " STRNOMCAT LIKE '%" . $query . "%'";
	include '../pagination.php'; //include pagination file
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
	$reload = './categorias-view.php';
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
					<th>#id Categoria</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Estado</th>
					<th>Fecha-Creacion</th>
					<th>Accion</th>
				</tr>
			</thead>
			<?php
			$finales = 0;
			while ($row = mysqli_fetch_array($query)) {
				$INTIDCAT = $row['INTIDCAT'];
				$STRNOMCAT = $row['STRNOMCAT'];
				$STRDESCAT = $row['STRDESCAT'];
				$DTEHOR = $row['DTEHOR'];
				$BITSUS = $row['BITSUS'];

				if ($BITSUS == 1) {
					$lbl_status = "Activo";
					$lbl_class = 'label label-success';
				} else {
					$lbl_status = "Inactivo";
					$lbl_class = 'label label-danger';
				}

				/*$kind=$row['kind'];*/

				$finales++;
			?>
				<tbody>
					<tr>
						<td><?php echo $INTIDCAT ?></td>
						<td><?php echo $STRNOMCAT ?></td>
						<td><?php echo $STRDESCAT ?></td>

						<td><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>
						<td><?php echo $DTEHOR ?></td>
						<td class="text-right">

							<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $INTIDCAT; ?>');"><i class="fa fa-edit"></i></button>

							<button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $INTIDCAT; ?>')"><i class="fa fa-trash-o"></i></button>

							<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $INTIDCAT; ?>')"><i class="fa fa-eye"></i></button>

						</td>
					</tr>
				</tbody>
			<?php } ?>
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