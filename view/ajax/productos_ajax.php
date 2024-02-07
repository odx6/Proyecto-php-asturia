<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");
require_once("../../config/RecuperarDatos.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];

	$sql2 = recuperarDatos("SELECT * from tblcatpro WHERE STRSKU='$id';");
	try {
		if (($delete = mysqli_query($con, "DELETE FROM tblcatpro WHERE STRSKU='$id'"))) {
			$aviso = "Bien hecho!";
			$msj = "Datos eliminados satisfactoriamente.";
			$classM = "alert alert-success";
			$times = "&times;";
			if ($delete) {

				$tabla = "tblcatpro";
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
	$query='';
	$tables = "tblcatpro";
	$campos = "*";
	$sWhere = " strdespro LIKE '%" . $query . "%'";
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
	$reload = './productos-view.php';
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
					<th>#SKU</th>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Categoria</th>
					<th>Subcategoria</th>
					<th>Precio</th>
					<th>Unidad Medida</th>
					<th>Imagen</th>
					<th>Taller</th>


					<th>Estado</th>

					<th>Accion</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$finales = 0;

				while ($row = mysqli_fetch_array($query)) {
					$sku = $row['STRSKU'];
					$codigo = $row['STRCOD'];
					$descripcion = $row['STRDESPRO'];

					$status = $row['BITSUS'];
					$INTIDCAT = $row['INTIDCAT'];
					//cONSULTA PARA SACAR LA CATEGORIA
					if (isset($INTIDCAT) && $INTIDCAT != NULL) {
						$Categoria = mysqli_query($con, "SELECT * FROM tblcatcat WHERE  INTIDCAT='$INTIDCAT'");
						if (isset($Categoria) && $Categoria != NULL) {
							$tem = mysqli_fetch_array($Categoria);
							if (isset($tem) && $tem != NULL) $NombreCategoria = $tem['STRNOMCAT'];
						}
					}
					//ENDCONSULTA


					$INTIDSBC = $row['INTIDSBC'];
					if (isset($INTIDSBC) && $INTIDSBC != NULL) {
						$Subcategoria = mysqli_query($con, "SELECT * FROM  tblcatsbc WHERE INTIDSBC='$INTIDSBC'");

						if (isset($Subcategoria) && $Subcategoria != NULL) {
							$tem = mysqli_fetch_array($Subcategoria);
							if (isset($tem) && $tem != NULL) $SubcategoriaNombre = $tem['STRNOMSBC'];
						}
					}
					$MONPCOS = $row['MONPCOS'];
					$INTIDUNI = $row['INTIDUNI'];
					$STRIMG = $row['STRIMG'];

					$INTTIPUSO = $row['INTTIPUSO'];


					if ($status == 1) {
						$lbl_status = "Activo";
						$lbl_class = 'label label-success';
					} else {
						$lbl_status = "Inactivo";
						$lbl_class = 'label label-danger';
					}

					/*$kind=$row['kind'];*/

					$finales++;
				?>
					<tr>
						<td><?php echo $sku ?></td>
						<td><?php echo $codigo ?></td>
						<td><?php echo $descripcion ?></td>
						<td><?php echo (isset($NombreCategoria)) ? $NombreCategoria : $INTIDCAT; ?></td>
						<td><?php echo (isset($SubcategoriaNombre)) ? $SubcategoriaNombre : $INTIDSBC; ?></td>
						<td><?php echo "$ " . number_format($MONPCOS, 2, '.', ','); ?> </td>
						<td><?php consultarNombre($INTIDUNI, 'tblcatuni', 'INTIDUNI', 'STRNOMUNI'); ?></td>
						<td>
							<div>
								<img width="50px" height="50px" src="<?php echo $STRIMG ?>" alt="Imagen Producto">
							</div>
						</td>


						<td><?php consultarNombre($INTTIPUSO, 'tblcattus', 'INTIDPUSO', 'STRNOMPUSO'); ?></td>
						<td><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>

						<td class="text-right">
							<?php if (in_array(2, $_SESSION['Habilidad']['Productos'])) { ?>
								<button type="button" class="btn btn-warning btn-square btn-xs " data-toggle="modal" data-target="#modal_update" id="<?php echo $sku; ?>" onclick="editar('<?php echo $sku; ?>');"><i class="fa fa-edit"></i></button>
							<?php } ?>
							<?php if (in_array(3, $_SESSION['Habilidad']['Productos'])) { ?>
								<button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $sku; ?>')"><i class="far fa-trash-alt"></i></button>
							<?php } ?>
							<?php if (in_array(4, $_SESSION['Habilidad']['Productos'])) { ?>
								<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $sku; ?>')"><i class="fa fa-eye"></i></button>
							<?php } ?>

						</td>
					</tr>
				<?php } ?>
			</tbody>

			<tfoot>
			<!--	<tr>
					<td colspan='10'>
						<?php
						$inicios = $offset + 1;
						$finales += $inicios - 1;
						echo "Mostrando $inicios al $finales de $numrows registros";
						echo paginate($reload, $page, $total_pages, $adjacents);
						?>
					</td>
				</tr>-->
			</tfoot>
		</table>
<?php
	} else {
		echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
	}
}
?>