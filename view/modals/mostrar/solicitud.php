<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['Solicitud'])) {
	require_once("../../../config/config.php");
	require_once("../../../config/funciones.php");
	if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatslc where 	LNGIDNSLC='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($rw = mysqli_fetch_array($query)) {
            $LNGIDNSLC = $rw['LNGIDNSLC'];
            $LNGIDNUSR = $rw['LNGIDNUSR'];
            $INTFOLSLC = $rw['INTFOLSLC'];
            $INTFOLSLCE = $rw['INTFOLSLCE'];
            $DTFCHSLC = $rw['DTFCHSLC'];

            $LNGIDNCNT = $rw['LNGIDNCNT'];
            $LNGIDNORG = $rw['LNGIDNORG'];
            $STRNMRSR = $rw['STRNMRSR'];
            $STRKLM = $rw['STRKLM'];
            $STROBSRPT = $rw['STROBSRPT'];
            $STRDGN = $rw['STRDGN'];
            $LNGIDNMCN = $rw['LNGIDNMCN'];
            $DTFCHDGN = $rw['DTFCHDGN'];
            $BITCNCSLC = $rw['BITCNCSLC'];
            }
        }
    } else {
        exit;
    }
?>
	<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
	<div class="card-body">
		
		<strong><i class="fas fa-key"></i> <p>ID</p></strong>

		<p class="text-muted">
			<?php echo $LNGIDNSLC ?>
		</p>

		<hr>

		<strong><i class="fas fa-user"></i><p>Capturista</p></strong>

		<p class="text-muted"><?php consultarNombre($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRNOM');
								echo "   ";
								consultarNombre($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRAPE'); ?></p>

		<hr>
		<strong><i class="fas fa-user"></i><p>Contacto</p></strong>

		<p class="text-muted"><?php consultarNombre($LNGIDNCNT, 'tblcatemp', 'IDEMP', 'STRNOM');
								echo "   ";
								consultarNombre($LNGIDNCNT, 'tblcatemp', 'IDEMP', 'STRAPE'); ?></p>

		<hr>
		<strong><i class="fas fa-wrench"></i><p>Mecanico</p></strong>

<p class="text-muted"><?php consultarNombre($LNGIDNMCN, 'tblcatemp', 'IDEMP', 'STRNOM');
						echo "   ";
						consultarNombre($LNGIDNMCN, 'tblcatemp', 'IDEMP', 'STRAPE'); ?></p>

<hr>

		<strong><i class="fas fa-cash-register"></i> <p>Folio General</p> </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php consultarNombre($INTFOLSLC, 'tblcatfol', 'id_folio', 'folio'); ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-building"></i> <p>Folio deEmpresa</p>  </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php consultarNombre($INTFOLSLCE, 'tblcatfol', 'id_folio', 'folio') ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-car"></i> <p>ID vehiculo</p> </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php consultarNombre($STRNMRSR, 'tblcatveh', 'STRNMRSR', 'STRNMRSR') ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-tachometer-alt"></i> <P>kilometraje</P> </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $STRKLM." KM"?></span>

		</p>
		<hr>
		<strong><i class="fas fa-id-card-alt"></i> <p>Numero de placas</p> </strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php consultarNombre($STRNMRSR, 'tblcatveh', 'STRNMRSR', 'STRPLC') ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-info"></i><p>Observaciones</p></strong>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $STROBSRPT  ?></span>

		</p>
		<hr>
		<strong><i class="fas fa-info"></i> <p>Diagnostico</p> </strong>
		<p class="card-text"><small class="text-muted"> Fecha de diagnostico : <?php echo $DTFCHDGN; ?></small></p>

		<p class="text-muted">
			<span class="tag tag-danger"><?php echo $STRDGN ?></span>

		</p>

		<hr>


		<p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $DTFCHSLC; ?></small></p>
	</div>

<?php } ?>