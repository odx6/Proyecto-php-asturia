<?php


session_start();
require_once("../../config/config.php");
require_once("../../config/funciones.php");


if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$id = intval($id);
	$sql = "select * from tbltarinv where SKU='$id'  order by DTEFEC";
	$query = mysqli_query($con, $sql);
	$num = mysqli_num_rows($query);
} else {
	exit;
}
if ($num > 0) {
?>
	<?php
	$sumaEntradas = 0;
	$sumaSalidas = 0;


	?>
	<?php $total = $sumaEntradas - $sumaSalidas;
	?>

	<div class="col-sm-6">
		<p>SKU</p>
		<p>SKU</p>
	</div>
	<div class="col-sm-6">
		<P>10005631198</P>
		<P>10005631198</P>
	</div>
	<div class="col-sm-4">
		<p><strong> <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> &nbsp;NUMERO DE ENTRADAS TOTALES</strong> &nbsp &nbsp <strong><?php echo $sumaEntradas; ?></strong></p>
	</div>
	<div class="col-sm-4"><strong><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> &nbsp;NUMERO DE SALIDAS TOTALES </strong> &nbsp &nbsp <strong><?php echo $sumaSalidas; ?></strong></div>
	<div class="col-sm-4"><strong> <i class="fa fa-archive" aria-hidden="true"></i> &nbsp;STOCK DISPONIBLE</strong> &nbsp &nbsp <strong><?php echo $total; ?></strong></div>
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
			if ($INTTIMOV == 1) $sumaEntradas += $INTCAN;
			if ($INTTIMOV == 2) $sumaSalidas += $INTCAN;

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
		<?php } ?>

	</table>



<?php

} else {
	echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
}

?>