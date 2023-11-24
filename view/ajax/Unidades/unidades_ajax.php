<?php
	include("../is_logged.php");//Archivo comprueba si el usuario esta logueado
	/* Connect To Database*/
	require_once ("../../../config/config.php");
	if (isset($_REQUEST["id"])){//codigo para eliminar 
	$id=$_REQUEST["id"];
	
	$id=intval($id);
	$times="&times;";					
	
	try {
		if (($delete=mysqli_query($con, "DELETE FROM  tblcatuni WHERE INTIDUNI='$id'"))) {
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

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$column=(isset($_REQUEST['column'])&& $_REQUEST['column'] !=NULL)?$_REQUEST['column']:'';
	$Table=(isset($_REQUEST['table'])&& $_REQUEST['table'] !=NULL)?$_REQUEST['table']:'';
	$Reload=(isset($_REQUEST['reload'])&& $_REQUEST['reload'] !=NULL)?$_REQUEST['reload']:'';

	$tables="tblcatuni";
	$campos="*";
	//dependiendo de por que se quiera filtrar
	//$sWhere=$column." LIKE '%".$query."%'";
	$sWhere=" STRNOMUNI LIKE '%" .$query. "%'";
	
	include '../pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	$reload = $Reload;
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	
	if (isset($_REQUEST["id"])){
?>
		<div class="<?php echo $classM;?>">
			<button type="button" class="close" data-dismiss="alert"><?php echo $times;?></button>
			<strong><?php echo $aviso?> </strong>
			<?php echo $msj;?>
		</div>	
<?php
	}
	if ($numrows>0){
?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#Id unidad </th>
                <th>Nombre </th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
        </thead>
        <?php 
			$finales=0;
			while($row = mysqli_fetch_array($query)){	
				$INTIDUNI=$row['INTIDUNI'];
				$STRNOMUNI=$row['STRNOMUNI'];
				$STRDESUNI=$row['STRDESUNI'];
				$DTEHOR=$row['DTEHOR'];
				$BITSUS=$row['BITSUS'];
				
				if ($BITSUS == 1) {
					$lbl_status = "Activo";
					$lbl_class = 'label label-success';
				} else {
					$lbl_status = "Inactivo";
					$lbl_class = 'label label-danger';
				}
				
				$finales++;
		?>	
        <tbody>
            <tr>
                <td><?php echo $INTIDUNI ?></td>
                <td><?php echo $STRNOMUNI?></td>
                <td><?php echo $STRDESUNI?></td>
                <td><?php echo $DTEHOR?></td>
                <td><span class="<?php echo $lbl_class; ?>"><?php echo $lbl_status; ?></span></td>
                
                
                <td class="text-right">

                    <button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $INTIDUNI;?>','view/modals/editar/unidad.php');"><i class="fa fa-edit"></i></button>

                    <button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $INTIDUNI;?>','view/ajax/Unidades/unidades_ajax.php')"><i class="fa fa-trash-o"></i></button>

                    <button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $INTIDUNI;?>','view/modals/mostrar/unidad.php')"><i class="fa fa-eye"></i></button>
                   
                    
            </tr>
        </tbody>
        <?php }?>	
        <tfoot>
            <tr>
				<td colspan='10'> 
					<?php 
						$inicios=$offset+1;
						$finales+=$inicios -1;
						echo "Mostrando $inicios al $finales de $numrows registros";
						echo paginate($reload, $page, $total_pages, $adjacents);
					?>
				</td>
			</tr>
		</tfoot>
    </table>
<?php	
	}else{
		echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
	}
}
?>