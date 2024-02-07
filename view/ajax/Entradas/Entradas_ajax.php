<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");
require_once("../../../config/Recuperardatos.php");
if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];
	$id = intval($id);
	$data = recuperarDatos("SELECT * FROM tblinv WHERE INTIDINV='$id';");
	$detalle = "SELECT * FROM tblinvdet WHERE  INTIDINV='$id';";
	$tarjetas = "SELECT * FROM tbltarinv WHERE  INTIDINV='$id';";




	try {
		if ($delete = mysqli_query($con, "DELETE FROM tblinv WHERE INTIDINV='$id'")) {
			$aviso = "Bien hecho!";
			$msj = "Datos eliminados satisfactoriamente.";
			$classM = "alert alert-success";
			$times = "&times;";

			$detalles = mysqli_query($con, $detalle);
			$tarjetas = mysqli_query($con, $tarjetas);


			if ($delete) {
				while ($row = mysqli_fetch_array($detalles)) {

					$INTIDDET = $row['INTIDDET'];
					$sql = recuperarDatos("SELECT * FROM tblinvdet WHERE  INTIDINV='$INTIDDET';");
					$data = "tblinvdet";
					$tipo = "Eliminacion";
					$fecha = date("Y-m-d H:i:s");

					$sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $data . "');";
					$query = mysqli_query($con, $sqllog);
				}
				while ($row = mysqli_fetch_array($tarjetas)) {

					$INTIDTAR  = $row['INTIDTAR '];
					$data = recuperarDatos("SELECT * FROM tblinvdet WHERE  INTIDINV='$INTIDDET';");
					$tabla = "tbltarinv";
					$tipo = "Eliminacion";
					$fecha = date("Y-m-d H:i:s");

					$sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $data . "');";
					$query = mysqli_query($con, $sqllog);
				}

				$tabla = "tblinv";
				$tipo = "Eliminacion";
				$fecha = date("Y-m-d H:i:s");

				$sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $data . "');";
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
	$tables = "tblinv";
	$campos = "*";
	$sWhere = " DTEFEC LIKE '%" . $query . "%'";
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
	$reload = './Entradas-view.php';
	//main query to fetch the data
	$query = mysqli_query($con, "SELECT $campos FROM  $tables where $sWhere ");
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
					<th>#id inventario</th>
					<th>Fecha</th>
					<th>tipo</th>
					<th>tipo de movimiento</th>
					<th>Folio</th>
					<th>Empleado</th>
					<th>Almacen</th>
					<th>Descripcion</th>

					<th>Hora de creacion</th>
					<th>Accion</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$finales = 0;
				while ($row = mysqli_fetch_array($query)) {
					$INTIDINV = $row['INTIDINV'];
					$DTEFEC = $row['DTEFEC'];
					$INTIDTOP = $row['INTIDTOP'];
					$INTTIMOV = $row['INTTIPMOV'];
					$INTFOL = $row['INTFOL'];
					$IDEMPLE = $row['IDEMP'];
					$STROBS = $row['STROBS'];
					$DTEHOR = $row['DTEHOR'];
					$INTALM = $row['INTALM'];
					$DTEHOR = $row['DTEHOR'];


					/*$kind=$row['kind'];*/

					$finales++;
				?>
					<tr>
						<td><?php echo $INTIDINV ?></td>
						<td><?php echo $DTEFEC  ?></td>
						<td><?php echo consultarNombre($INTIDTOP, 'tblcattop', 'INTIDTOP', 'STRNOMTPO');  ?></td>
						<td><?php echo ($INTTIMOV == 1) ?  "Entrada" : "Salida"; ?></td>
						<td><?php echo $INTFOL ?></td>
						<td><?php consultarNombre($IDEMPLE, 'tblcatemp', 'IDEMP', 'STRNOM'); ?></td>
						<td><?php consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM'); ?></td>
						<td><?php echo $STROBS ?></td>
						<td><?php echo $DTEHOR ?></td>
						<td class="text-right">
							<?php if (in_array(2, $_SESSION['Habilidad']['Entradas'])) { ?>
								<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $INTIDINV; ?>');"><i class="far fa-edit"></i></button>
							<?php } ?>
							<?php if (in_array(3, $_SESSION['Habilidad']['Entradas'])) { ?>
								<button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $INTIDINV; ?>')"><i class="far fa-trash-alt"></i></button>
							<?php } ?>
							<?php if (in_array(4, $_SESSION['Habilidad']['Entradas'])) { ?>
								<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $INTIDINV; ?>')"><i class="far fa-eye"></i></button>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
			</tbody>
		
		<tfoot>
			<!--<tr>
					<td colspan='10'>
						<?php
						$inicios = $offset + 1;
						$finales += $inicios - 1;
						echo "Mostrando $inicios al $finales de $numrows registros";
						echo paginate($reload, $page, $total_pages, $adjacents);
						?>
					</td>
				</tr>-->
			<!--	<div class="row">
				<div class="col-sm-12 col-md-5">
					<div class="dataTables_info" id="example2_info" role="status" aria-live="polite"><?php echo "Mostrando $inicios al $finales de $numrows registros"; ?></div>
				</div>
				<div class="col-sm-12 col-md-7">
					<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
							<li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
							<li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
							<li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
							<li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
							<li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
							<li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
							<li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
						</ul>
					</div>
				</div>
			</div>-->
		</tfoot>
		</table>
<?php
	} else {
		echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
	}
}
?>