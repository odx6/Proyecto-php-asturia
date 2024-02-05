<?php
// para mostrar datos y para busquedas mediante ide 
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/RecuperarDatos.php");
if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];
	$id = intval($id);
	$sql = mysqli_query($con, "SELECT STRIMG FROM tblcatemp WHERE IDEMP='$id'");
	$sql2 = recuperarDatos("SELECT * from tblcatemp WHERE IDEMP='$id'");
	while ($fila = mysqli_fetch_array($sql)) {
		$URL = $fila['STRIMG'];  // reemplaza 'nombre_de_columna' con el nombre de la columna que deseas imprimir
	}

	try {
		if ($delete = mysqli_query($con, "DELETE FROM tblcatemp WHERE IDEMP='$id' AND IDEMP !=1")) {
			if (($delete = mysqli_query($con, "DELETE FROM tblcatemp WHERE IDEMP='$id'  AND IDEMP !=1"))) {
				if ($delete && !empty($URL) && $URL != "view/resources/images/Default/perfil.png") {
					if (file_exists("../../" . $URL))
						unlink("../../" . $URL);
				}
				if ($delete) {

					$tabla = "tblcatemp";
					$tipo = "Eliminacion";
					$fecha = date("Y-m-d H:i:s");

					$sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
					$query = mysqli_query($con, $sqllog);
				}
			}
			if ($id == 1) {
				$aviso = "Adverteccia!";
				$msj = "No puedes Eliminar a un administrador.";
				$classM = "alert alert-danger";
				$times = "&times;";
			} else {
				$aviso = "Bien hecho!";
				$msj = "Datos eliminados satisfactoriamente.";
				$classM = "alert alert-success";
				$times = "&times;";
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
	$tables = "tblcatemp";
	$campos = "*";
	$sWhere = " STRNOM LIKE '%" . $query . "%'";
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
	$reload = './empleados-view.php';
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
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#ID</th>
					<th>NSS</th>
					<th>RFC</th>
					<th>CURP</th>
					<th>NOMBRE</th>
					<th>TELEFONO</th>
					<th>CORREO</th>
					<th>ESTADO</th>
					<th>CREACION</th>
					<th>ACCION</th>



				</tr>
			</thead>

			<tbody>

				
				<?php
					$finales = 0;
					while ($row = mysqli_fetch_array($query)) {
						$IDEMP = $row['IDEMP'];
						$STRNSS = $row['STRNSS'];
						$STRRFC = $row['STRRFC'];
						$STRCUR = $row['STRCUR'];
						$STRNOM = $row['STRNOM'];
						$STRAPE = $row['STRAPE'];
						$STRLOC = $row['STRLOC'];
						$STRMUN = $row['STRMUN'];
						$STREST = $row['STREST'];
						$STRCP = $row['STRCP'];
						$STRPAI = $row['STRPAI'];
						$STRTEL = $row['STRTEL'];
						$STRCOR = $row['STRCOR'];
						$STRPWS = $row['STRPWS'];
						$BITSUS = $row['BITSUS'];
						$STRIMG = $row['STRIMG'];
						$CREATE_AT = $row['CREATE_AT'];

						list($date, $hora) = explode(" ", $CREATE_AT);
						list($Y, $m, $d) = explode("-", $date);
						$fecha = $d . "-" . $m . "-" . $Y;


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
						<tr>

							<td><?php echo $IDEMP ?></td>
							<td> <?php echo $STRNSS  ?> </td>
							<td> <?php echo $STRRFC  ?> </td>
							<td> <?php echo $STRCUR  ?> </td>
							<td> <?php echo $STRNOM . " " . $STRAPE  ?> </td>
							<td> <?php echo $STRTEL  ?> </td>
							<td> <?php echo $STRCOR  ?> </td>





							<td><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>
							<td><?php echo $fecha ?></td>

							<td class="text-right">
								<?php if (in_array(2, $_SESSION['Habilidad']['Empleados'])) { ?>
									<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" title="Editar" data-target="#modal_update" onclick="editar('<?php echo $IDEMP; ?>');"><i class="fa fa-edit"></i></button>
								<?php } ?>
								<?php if (in_array(3, $_SESSION['Habilidad']['Empleados'])) { ?>
									<button type="button" class="btn btn-danger btn-square btn-xs" title="Eliminar" onclick="eliminar('<?php echo $IDEMP; ?>')"><i class="far fa-trash-alt"></i></button>
								<?php } ?>
								<?php if (in_array(4, $_SESSION['Habilidad']['Empleados'])) { ?>
									<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" title="Mostrar" onclick="mostrar('<?php echo $IDEMP; ?>')"><i class="fa fa-eye"></i></button>
								<?php } ?>
								<?php if (in_array(2, $_SESSION['Habilidad']['Empleados']) && $_SESSION['user_id'] == 1) { ?>
									<form action="?view=Permision" method="post">
										<input type="hidden" name="id" value="<?php echo $IDEMP; ?>">
										<button type="submit" class="btn btn-success btn-square btn-xs" data-toggle="modal" data-target="#" title="Editar Permisos"><i class="fa fa-unlock" aria-hidden="true"></i></button>
									</form>
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