<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['Solicitud'])) {
	require_once("../../../config/config.php");
	require_once("../../../config/funciones.php");
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$id = intval($id);
		$sql = "select * from solicitud where pk_solicitud='$id'";
		$query = mysqli_query($con, $sql);
		$num = mysqli_num_rows($query);
		if ($num == 1) {
			$rw = mysqli_fetch_array($query);
			$pk_solicitud = $rw['pk_solicitud'];
			$fk_empleado = $rw['fk_empleado'];
			$NumeroFolio = $rw['NumeroFolio'];
			$fecha = $rw['fecha'];
			$operador = $rw['operador'];
			$NoCarro = $rw['NoCarro'];
			$Kilometraje = $rw['Kilometraje'];
			$NoPlacas = $rw['NoPlacas'];
			$DetallesServicio = $rw['DetallesServicio'];
			$Observaciones = $rw['Observaciones'];
		}
	} else {
		exit;
	}
?>
	<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
	<div class="card-body">
		<strong><i class="fas fa-key"></i> ID</strong>

		<p class="text-muted">
			<?php echo $pk_solicitud ?>
		</p>

		<hr>

		<strong><i class="fas fa-book"></i> Empleado</strong>

		<p class="text-muted"><?php consultarNombre($fk_empleado, 'tblcatemp', 'IDEMP', 'STRNOM');
								echo "   ";
								consultarNombre($fk_empleado, 'tblcatemp', 'IDEMP', 'STRAPE'); ?></p>

		<hr>

		<strong><i class="fas fa-file"></i> Folio </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $NumeroFolio ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-biking"></i> Operador </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $operador ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-truck-moving"></i> Numero de carro </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $NoCarro ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-gas-pump"></i> Kilometraje </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $Kilometraje ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-id-card-alt"></i> Numero de placas </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $NoPlacas ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-info"></i>Detalles de servicio </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $DetallesServicio ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-info"></i> Observaciones </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $Observaciones ?></span>

		</p>

		<hr>


		<p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $fecha; ?></small></p>
	</div>

<?php } ?>