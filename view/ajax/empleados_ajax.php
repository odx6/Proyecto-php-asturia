<?php
// para mostrar datos y para busquedas mediante ide 
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
if (isset($_REQUEST["id"])) { //codigo para eliminar 
	$id = $_REQUEST["id"];
	$id = intval($id);
	if ($delete = mysqli_query($con, "DELETE FROM tblcatemp WHERE IDEMP='$id'")) {
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
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#ID</th>
					<th>NSS</th>
					<th>RFC</th>
					<th>CURP</th>
					<th>NOMBRE</th>
					
					<th>DOMICILIO</th>
					<th>LOCALIDAD</th>
					<th>MUNICIPIO</th>
					<th>ESTADO</th>
					<th>CODIGO POSTAL</th>
					<th>PAIS</th>
					<th>TELEFONO</th>
					<th>CORREO</th>
					<th>CONTRASEÑA</th>
					<th>CREATE</th>
					<th>ACCION</th>
					<th></th>
					
				</tr>
			</thead>
			<?php
			$finales = 0;
			while ($row = mysqli_fetch_array($query)) {
				$IDEMP=$row['IDEMP'];
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
				<tbody>
					<tr>
						<td><?php echo $IDEMP?></td>
						<td> <?php echo $STRNSS  ?> </td> 
						<td> <?php echo $STRRFC  ?> </td> 
						<td> <?php echo $STRCUR  ?> </td> 
						<td> <?php echo $STRNOM . " " .$STRAPE  ?> </td> 
						<td> <?php echo $STRLOC  ?> </td> 
						<td> <?php echo $STRMUN  ?> </td> 
						<td> <?php echo $STREST  ?> </td> 
						<td> <?php echo $STRCP ?> </td> 					
						<td> <?php echo $STRPAI  ?> </td> 
						<td> <?php echo $STRTEL  ?> </td> 
						<td> <?php echo $STRCOR  ?> </td> 
						<td> <?php echo $STRPWS  ?> </td> 
						<td> <?php echo $BITSUS  ?> </td> 
						<td> <?php echo $STRIMG  ?> </td> 
						

						
						<td><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>
						<td><?php echo $fecha ?></td>
						<td class="text-right">

							<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $IDEMP; ?>');"><i class="fa fa-edit"></i></button>

							<button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $IDEMP; ?>')"><i class="fa fa-trash-o"></i></button>

							<button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $IDEMP; ?>')"><i class="fa fa-eye"></i></button>

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