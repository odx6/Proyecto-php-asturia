<?php
include("is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../config/config.php");
require_once("../../config/funciones.php");

$id = $_REQUEST["id"];
$Saldo = 0;



function  CalcularSaldo($id)
{
	$Saldos = array();
	global $con;
	$consul = mysqli_query($con, "SELECT * FROM tbltarinv WHERE SKU='$id'");
	$residuo = 0;
	while ($row = mysqli_fetch_array($consul)) {




		$INTIDTAR = $row['INTIDTAR'];

		$INTTIMOV = $row['INTTIPMOV'];

		$INTCAN = $row['INTCAN'];

		if ($INTTIMOV == 1 || 
		$INTTIMOV==3) {


			$residuo = $residuo + intval($INTCAN);
			$Saldos[$INTIDTAR] = $residuo;

			//$Saldos[] = array('id' => $row['INTIDTAR'],'Saldo' => $residuo);
		} else {


			$residuo -= $INTCAN;
			$Saldos[$INTIDTAR] = $residuo;


			//$Saldos[] = array('id' => $row['INTIDTAR'],'Saldo' => $residuo);
		}






		/*$kind=$row['kind'];*/
	}
	return $Saldos;
}


//print_r(CalcularSaldo($id));

$Saldos = CalcularSaldo($id);



if (isset($_REQUEST["Saldo"])) $Saldo = $_REQUEST["Saldo"];





$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {



	$tables = "tbltarinv";
	$campos = "*";
	$sWhere = "SKU='$id'  order by DTEFEC ASC";
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
	$Entradas = "SELECT COALESCE(SUM(INTCAN), 0) as Entradas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=1;";
	$Compras = "SELECT COALESCE(SUM(INTCAN), 0) as Compras FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=3;";
	$Salidas = "SELECT COALESCE(SUM(INTCAN), 0) as Salidas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=2;";
	$query_entradas = mysqli_query($con, $Entradas);
	if ($query_entradas) {
		$row = mysqli_fetch_array($query_entradas);

		$sumaEntradas = $row['Entradas'];
	} else {

		$sumaEntradas = 0;
	}


	$query_salidas = mysqli_query($con, $Salidas);
	if ($query_salidas) {
		$row = mysqli_fetch_array($query_salidas);

		$sumaSalidas = $row['Salidas'];
	} else {

		$sumaSalidas = 0;
	}

	$query_compras = mysqli_query($con, $Compras);
	if ($query_salidas) {
		$row = mysqli_fetch_array($query_compras);

		$sumaCompras = $row['Compras'];
	} else {

		$sumaCompras = 0;
	}
	$total = $sumaEntradas+$sumaCompras - $sumaSalidas;

	//if ($numrows > 0) {

?>


		<div class="card card-primary card-outline">
			<div class="card-body box-profile">
		
				

				<h3 class="profile-username text-center">SKU : <?php echo $id ?></h3>

				<p class="text-muted text-center">Descripcion :<?php consultarNombre($id, 'tblcatpro', 'STRSKU', 'STRDESPRO'); ?></p>

				<ul class="list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>Entradas Totales</b> <a class="float-right"><?php echo $sumaEntradas; ?></a>
					</li>
					<li class="list-group-item">
						<b>Compras Totales</b> <a class="float-right"><?php echo $sumaCompras; ?></a>
					</li>
					<li class="list-group-item">
						<b>Salidas Totales</b> <a class="float-right"><?php echo $sumaSalidas; ?></a>
					</li>
					<li class="list-group-item">
						<b>stock disponible</b> <a class="float-right"><?php echo $total; ?></a>
					</li>
				</ul>

				
			</div>
			<!-- /.card-body -->
		</div>
	


		

		<input type="hidden" value="<?php echo $id ?>" id="ideControl"></input>
		<table id="example1" class="table table-bordered table-striped">
			<thead>


				<tr>
					<th>#ID</th>
					<th>FECHA</th>

					<th>REFERENCIA</th>


					<th>Entrada</th>
					<th>Salida</th>
					<th>Saldo</th>
					<th>Almacen</th>
					<th>PRECIO</th>
					<th>Total</th>


				</tr>
			</thead>

			<tbody>
				<?php
				$finales = 0;

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




					/*$kind=$row['kind'];*/

					$finales++;
				?>
					<tr>
						<td><?php echo $INTIDTAR ?></td>
						<td><?php echo $DTEFEC ?></td>

						<td><?php echo $STRREF ?></td>



						<?php
						if ($INTTIMOV == 1 || $INTTIMOV=3) {

						?>
							<td><?php echo $INTCAN; ?> </td>
							<td><?php echo "0"; ?></td>
						<?php

						} else {


						?>

							<td><?php echo  "0"; ?> </td>
							<td><?php echo $INTCAN; ?></td>
						<?php
						}
						?>



						<td><?php echo $Saldos[$INTIDTAR]; ?></td>

						<td><?php consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM'); ?></td>
						<td><?php echo  "$ " . number_format($MONPRCOS, 2, '.', ',');  ?></td>
						<td><?php echo  "$ " . number_format($MONCTOPRO, 2, '.', ','); ?></td>
					</tr>
				<?php

				} ?>
			</tbody>

			<tfoot>

			</tfoot>
		</table>
		<input type="hidden" id="Saldo" value="<?php echo $tot ?>" readonly>
	<?php

	} else {
		echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
	}
//}
if ($action == 'ajax2') {
	$query = mysqli_real_escape_string($con, (strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$tables = "tbltarinv";
	$campos = "*";
	$sWhere = "SKU='$id' AND DTEFEC LIKE '%" . $query . "%'  order by DTEFEC ASC";


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

	$Entradas = "SELECT COALESCE(SUM(INTCAN), 0) as Entradas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=1;";
	$Salidas = "SELECT COALESCE(SUM(INTCAN), 0) as Salidas FROM tbltarinv WHERE SKU='$id' AND INTTIPMOV=2;";
	$query_entradas = mysqli_query($con, $Entradas);
	if ($query_entradas) {
		$row = mysqli_fetch_array($query_entradas);

		$sumaEntradas = $row['Entradas'];
	} else {

		$sumaEntradas = 0;
	}


	$query_salidas = mysqli_query($con, $Salidas);
	if ($query_salidas) {
		$row = mysqli_fetch_array($query_salidas);

		$sumaSalidas = $row['Salidas'];
	} else {

		$sumaSalidas = 0;
	}
	$total = $sumaEntradas - $sumaSalidas;

	//if ($numrows > 0) {
	?>
		<div class="col-sm-12">

			<div class="col-sm-2">
				<p> <strong>SKU :</strong></p>
				<p> <strong>DESCRIPCION :</strong></p>

			</div>
			<div class="col-sm-2">
				<P><strong><?php echo $id ?></strong></P>
				<P><strong><?php consultarNombre($id, 'tblcatpro', 'STRSKU', 'STRDESPRO'); ?></strong></P>


			</div>
		</div>
		<div class="col-sm-4">

			<p><strong> <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;NUMERO DE ENTRADAS TOTALES</strong> &nbsp &nbsp <strong><?php echo $sumaEntradas; ?></strong></p>
		</div>
		<div class="col-sm-4"><strong><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> &nbsp;NUMERO DE SALIDAS TOTALES </strong> &nbsp &nbsp <strong><?php echo $sumaSalidas; ?></strong></div>
		<div class="col-sm-4"><strong> <i class="fa fa-archive" aria-hidden="true"></i> &nbsp;STOCK DISPONIBLE</strong> &nbsp &nbsp <strong><?php echo $total; ?></strong></div>
		<input type="hidden" value="<?php echo $id ?>" id="ideControl"></input>
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#ID</th>
					<th>FECHA</th>

					<th>REFERENCIA</th>


					<th>Entrada</th>
					<th>Salida</th>
					<th>Saldo</th>
					<th>Almacen</th>
					<th>PRECIO</th>
					<th>Total</th>



				</tr>
			</thead>

			<tbody>
				<?php
				$finales = 0;

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
					<tr>
						<td><?php echo $INTIDTAR ?></td>
						<td><?php echo $DTEFEC ?></td>

						<td><?php echo $STRREF ?></td>



						<?php
						if ($INTTIMOV == 1) {
						?>
							<td><?php echo $INTCAN; ?> </td>
							<td><?php echo "0"; ?></td>
						<?php

						} else { ?>

							<td><?php echo  "0"; ?> </td>
							<td><?php echo $INTCAN; ?></td>
						<?php
						}
						?>
						<td><?php echo $Saldos[$INTIDTAR]; ?></td>

						<td><?php consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM'); ?></td>
						<td><?php echo  "$ " . number_format($MONPRCOS, 2, '.', ',');  ?></td>
						<td><?php echo  "$ " . number_format($MONCTOPRO, 2, '.', ','); ?></td>

					</tr>
				<?php


				} ?>
			</tbody>

			<tfoot>

			</tfoot>
		</table>
		<input type="hidden" id="Saldo" value="<?php echo $tot ?>" readonly>

<?php
	} else {
		echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
	}
//}
?>