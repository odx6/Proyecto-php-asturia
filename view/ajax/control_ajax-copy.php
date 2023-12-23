<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");

$id = $_REQUEST["id"];



$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {

	$tables = "tbltarinv";
	$campos = "*";
	$sWhere = "SKU='$id'  order by DTEFEC";
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
	$reload = './control-view.php';
	//main query to fetch the data
	$query = mysqli_query($con, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	$Entradas="SELECT COALESCE(SUM(INTCAN), 0) as Entradas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=1;";
	$Salidas="SELECT COALESCE(SUM(INTCAN), 0) as Salidas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=2;";
	$query_entradas = mysqli_query($con, $Entradas);
	if ($query_entradas) {
        $row = mysqli_fetch_array($query_entradas);

        $sumaEntradas = $row['Entradas'];

	}else{

		$sumaEntradas=0;
	}


	$query_salidas = mysqli_query($con, $Salidas);
	if ($query_salidas) {
        $row = mysqli_fetch_array($query_salidas);

        $sumaSalidas = $row['Salidas'];

	}else{

		$sumaSalidas=0;
	}
	$total=$sumaEntradas-$sumaSalidas;

	if ($numrows > 0) {
?>
<div class="col-sm-4">
			<p><strong> <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;NUMERO DE ENTRADAS TOTALES</strong> &nbsp &nbsp <strong><?php echo $sumaEntradas; ?></strong></p>
		</div>
		<div class="col-sm-4"><strong><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> &nbsp;NUMERO DE SALIDAS TOTALES </strong> &nbsp &nbsp <strong><?php echo $sumaSalidas; ?></strong></div>
		<div class="col-sm-4"><strong> <i class="fa fa-archive" aria-hidden="true"></i> &nbsp;STOCK DISPONIBLE</strong> &nbsp &nbsp <strong><?php echo $total; ?></strong></div>
		<input type="hidden" value="<?php echo $id ?>" id="ideControl"></input>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#ID</th>
					<th>FECHA</th>
					<th>SKU</th>
					<th>REFERENCIA</th>
					<th>CANTIDAD</th>
					<th>PRECIO</th>
					<th>Total</th>
					<th>Tipo e/s</th>
					<th>Almacen</th>


				</tr>
			</thead>
			<?php
			$finales = 0;
			$sumaEntradas = 0;
			$sumaSalidas = 0;
			$total = 0;
			while ($row = mysqli_fetch_array($query)) {

				$INTIDTAR = $row['INTIDTAR'];
				$INTIDINV = $row['INTIDINV'];
				$DTEFEC = $row['DTEFEC'];
				$SKU = $row['SKU'];
				$STRREF = $row['STRREF'];
				$INTCAN = $row['INTCAN'];


				$INTIDUNI = $row['INTIDUNI'];
				$MONPRCOS = $row['MONPRCOS'];
				$MONCTOPRO = $row['MONCTOPRO'];
				$INTTIMOV = $row['INTTIPMOV'];
				
				

				$INTALM = $row['INTALM'];
				$DTEHOR = $row['DTEHOR'];

				if ($INTTIMOV == 1) {
					$lbl_status = "Entrada";
					$lbl_class = 'label label-success';
				} else {
					$lbl_status = "Salida";
					$lbl_class = 'label label-danger';
				}


				/*$kind=$row['kind'];*/

				$finales++;
			?>
				<tbody>
					<tr>
						<td><?php echo $INTIDTAR ?></td>
						<td><?php echo $DTEFEC ?></td>
						<td><?php echo $SKU ?></td>
						<td><?php echo $STRREF ?></td>
						<td><?php echo $INTCAN ?></td>
						<td><?php echo $MONPRCOS . "&nbspmxm" ?></td>
						<td><?php echo $MONCTOPRO . "&nbspmxm" ?></td>
						<td></strong> <span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>
						<td><?php consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM'); ?></td>

					</tr>
				</tbody>
			<?php
				$total = $sumaEntradas - $sumaSalidas;
			} ?>
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
if ($action == 'ajax2') {
	$query = mysqli_real_escape_string($con, (strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$tables = "tbltarinv";
	$campos = "*";
	$sWhere = "SKU='$id' AND DTEFEC LIKE '%" . $query . "%'  order by DTEFEC";


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
	$reload = './control-view.php';
	//main query to fetch the data
	$query = mysqli_query($con, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
      
	$Entradas="SELECT COALESCE(SUM(INTCAN), 0) as Entradas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=1;";
	$Salidas="SELECT COALESCE(SUM(INTCAN), 0) as Salidas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=2;";
	$query_entradas = mysqli_query($con, $Entradas);
	if ($query_entradas) {
        $row = mysqli_fetch_array($query_entradas);

        $sumaEntradas = $row['Entradas'];

	}else{

		$sumaEntradas=0;
	}


	$query_salidas = mysqli_query($con, $Salidas);
	if ($query_salidas) {
        $row = mysqli_fetch_array($query_salidas);

        $sumaSalidas = $row['Salidas'];

	}else{

		$sumaSalidas=0;
	}
	$total=$sumaEntradas-$sumaSalidas;

	if ($numrows > 0) {
	?>
	<div class="col-sm-4">

			<p><strong> <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;NUMERO DE ENTRADAS TOTALES</strong> &nbsp &nbsp <strong><?php echo $sumaEntradas; ?></strong></p>
		</div>
		<div class="col-sm-4"><strong><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> &nbsp;NUMERO DE SALIDAS TOTALES </strong> &nbsp &nbsp <strong><?php echo $sumaSalidas; ?></strong></div>
		<div class="col-sm-4"><strong> <i class="fa fa-archive" aria-hidden="true"></i> &nbsp;STOCK DISPONIBLE</strong> &nbsp &nbsp <strong><?php echo $total; ?></strong></div>
		<input type="hidden" value="<?php echo $id ?>" id="ideControl"></input>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#ID</th>
					<th>FECHA</th>
					<th>SKU</th>
					<th>REFERENCIA</th>
					<th>CANTIDAD</th>
					<th>PRECIO</th>
					<th>Total</th>
					<th>Tipo e/s</th>
					<th>Almacen</th>


				</tr>
			</thead>
			<?php
			$finales = 0;
			$sumaEntradas = 0;
			$sumaSalidas = 0;
			$total = 0;
			while ($row = mysqli_fetch_array($query)) {

				$INTIDTAR = $row['INTIDTAR'];
				$INTIDINV = $row['INTIDINV'];
				$DTEFEC = $row['DTEFEC'];
				$SKU = $row['SKU'];
				$STRREF = $row['STRREF'];
				$INTCAN = $row['INTCAN'];


				$INTIDUNI = $row['INTIDUNI'];
				$MONPRCOS = $row['MONPRCOS'];
				$MONCTOPRO = $row['MONCTOPRO'];
				$INTTIMOV = $row['INTTIPMOV'];
				
				$INTALM = $row['INTALM'];
				$DTEHOR = $row['DTEHOR'];

				if ($INTTIMOV == 1) {
					$lbl_status = "Entrada";
					$lbl_class = 'label label-success';
				} else {
					$lbl_status = "Salida";
					$lbl_class = 'label label-danger';
				}


				/*$kind=$row['kind'];*/

				$finales++;
			?>
				<tbody>
					<tr>
						<td><?php echo $INTIDTAR ?></td>
						<td><?php echo $DTEFEC ?></td>
						<td><?php echo $SKU ?></td>
						<td><?php echo $STRREF ?></td>
						<td><?php echo $INTCAN ?></td>
						<td><?php echo $MONPRCOS . "&nbspmxm" ?></td>
						<td><?php echo $MONCTOPRO . "&nbspmxm" ?></td>
						<td></strong> <span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>
						<td><?php consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM'); ?></td>

					</tr>
				</tbody>
			<?php

				$total = $sumaEntradas - $sumaSalidas;
			} ?>
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