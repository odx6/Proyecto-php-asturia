<?php
	include("is_logged.php");//Archivo comprueba si el usuario esta logueado
	/* Connect To Database*/
	require_once ("../../config/config.php");
	if (isset($_REQUEST["id"])){//codigo para eliminar 
	$id=$_REQUEST["id"];
	$id=intval($id);
	if($delete=mysqli_query($con, "DELETE FROM solicitud WHERE pk_solicitud='$id'")){
		$aviso="Bien hecho!";
		$msj="Datos eliminados satisfactoriamente.";
		$classM="alert alert-success";
		$times="&times;";	
	}else{
		$aviso="Aviso!";
		$msj="Error al eliminar los datos ".mysqli_error($con);
		$classM="alert alert-danger";
		$times="&times;";					
	}
}

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$column=(isset($_REQUEST['column'])&& $_REQUEST['column'] !=NULL)?$_REQUEST['column']:'';
	$tables="solicitud";
	$campos="*";
	//dependiendo de por que se quiera filtrar
	$sWhere=$column." LIKE '%".$query."%'";
	include 'pagination.php'; //include pagination file
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
	$reload = './solicitud-view.php';
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
                <th>#Id Orden </th>
                <th> Empleado </th>
                <th>No.Folio</th>
                <th>Fecha</th>
                <th>Operador</th>
                <th>No.Carro</th>
                <th>Kilometraje</th>
                <th>No.Placas</th>
                <th>Detalles del servicio</th>
                <th>Observaciones</th>
                <th>Accion</th>
            </tr>
        </thead>
        <?php 
			$finales=0;
			while($row = mysqli_fetch_array($query)){	
				$id=$row['pk_solicitud'];
				$empleado=$row['fk_empleado'];
				//Name Empleado 
				if (isset($empleado) && $empleado != NULL) {
					$Empleado = mysqli_query($con, "SELECT * FROM empleado WHERE id='$empleado'");
					$tem = mysqli_fetch_array($Empleado);
					$NombreEmpleado = $tem['nombre'] ." ".$tem['apellido'];
				}
				//
				$Folio=$row['NumeroFolio'];
				$Fecha=$row['fecha'];
				$Operador=$row['operador'];
				$Carro=$row['NoCarro'];
				$Kilometraje=$row['Kilometraje'];
				$Placas=$row['NoPlacas'];
				$Detalles=$row['DetallesServicio'];
				$Observacione=$row['Observaciones'];
				
				
				
				$finales++;
		?>	
        <tbody>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $NombreEmpleado ?></td>
                <td><?php echo $Folio ?></td>
                <td><?php echo $Fecha ?></td>
                <td><?php echo $Operador ?></td>
                <td><?php echo $Carro ?></td>
                <td><?php echo $Kilometraje ?></td>
                <td><?php echo $Placas ?></td>
                <td><?php echo $Detalles ?></td>
                <td><?php echo $Observacione ?></td>
                
                <td class="text-right">

                    <button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $id;?>');"><i class="fa fa-edit"></i></button>

                    <button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $id;?>')"><i class="fa fa-trash-o"></i></button>

                    <button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $id;?>')"><i class="fa fa-eye"></i></button>
                   
                    <form action="?view=Pdfs" method="post">
    <input type="hidden" name="id" value="<?php echo $id;?>">
	<button type="submit" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#"><i class="fa fa-eye"></i></button>
</form>
                </td>
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