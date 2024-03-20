<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");
require_once("../../../config/RecuperarDatos.php");


if($_POST['Tipo']==1 && isset($_POST['Tipo'])){

    if (isset($_POST['Inicio']) && isset($_POST['Final'])  && isset($_POST['Movi']) ) {
        $fechainicial = $_POST['Inicio'];
        $fechaFinal = $_POST['Final'];
        $movi = $_POST['Movi'];
      
        $consulta="SELECT * FROM `tblinv` WHERE DTEFEC >= '$fechainicial' AND DTEFEC <= '$fechaFinal';";
    
        $query = mysqli_query($con, "SELECT * FROM `tblinv` WHERE DTEFEC >= '$fechainicial' AND DTEFEC <= '$fechaFinal'  AND INTTIPMOV='$movi';");
    
    ?>
    <table id="example1" class="table table-bordered table-striped">
    
    <thead>
        <tr>
            <th>#id inventario</th>
            <th>Fecha</th>
            <th>tipo</th>
            <th>tipo de movimiento</th>
            <th>Folio</th>
            <th>Empleado</th>
            <th>Almacen</th>
            <th>Descripcion</th>
    
            <th>Hora de creacion</th>
            <th>Accion</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        $finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $INTIDINV = $row['INTIDINV'];
            $DTEFEC = $row['DTEFEC'];
            $INTIDTOP = $row['INTIDTOP'];
            $INTTIMOV = $row['INTTIPMOV'];
            $INTFOL = $row['INTFOL'];
            $IDEMPLE = $row['IDEMP'];
            $STROBS = $row['STROBS'];
            $DTEHOR = $row['DTEHOR'];
            $INTALM = $row['INTALM'];
            $DTEHOR = $row['DTEHOR'];
    
    
            /*$kind=$row['kind'];*/
    
            $finales++;
        ?>
            <tr>
                <td><?php echo $INTIDINV ?></td>
                <td><?php echo $DTEFEC  ?></td>
                <td><?php echo consultarNombre($INTIDTOP, 'tblcattop', 'INTIDTOP', 'STRNOMTPO');  ?></td>
                <td><?php echo ($INTTIMOV == 1) ?  "Entrada" : "Salida"; ?></td>
                <td><?php echo $INTFOL ?></td>
                <td><?php consultarNombre($IDEMPLE, 'tblcatemp', 'IDEMP', 'STRNOM'); ?></td>
                <td><?php consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM'); ?></td>
                <td><?php echo $STROBS ?></td>
                <td><?php echo $DTEHOR ?></td>
                <td class="text-right">
                    <?php if (in_array(2, $_SESSION['Habilidad']['Entradas'])) { ?>
                      <form action="./?view=EditarEntrada" method="POST" role="form">
                      <input type="hidden" required class="form-control" id="identrada" name="identrada"  value="<?php echo $INTIDINV ?>">
                      <button type="submit" class="btn btn-warning btn-square btn-xs" ><i class="far fa-edit"></i></button>
    
    
                      </form>
    
    
    
                         
                        <!--<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $INTIDINV; ?>');"><i class="far fa-edit"></i></button>-->
                    <?php } ?>
                    <?php if (in_array(3, $_SESSION['Habilidad']['Entradas'])) { ?>
                        <button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $INTIDINV; ?>')"><i class="far fa-trash-alt"></i></button>
                    <?php } ?>
                    <?php if (in_array(4, $_SESSION['Habilidad']['Entradas'])) { ?>
                        <button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $INTIDINV; ?>')"><i class="far fa-eye"></i></button>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
    </tbody>
    
    <tfoot>
  
    </tfoot>
    </table>
    
    
    
    
    <?php
    
    } else {
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
    
                ;
            
    }



}else if($_POST['Tipo']==2 && isset($_POST['Tipo'])){
    if (isset($_POST['Inicio']) && isset($_POST['Final']) && isset($_POST['Movi']) ) {
        $fechainicial = $_POST['Inicio'];
        $fechaFinal = $_POST['Final'];
        $movi = $_POST['Movi'];
        $consulta="select tblcatpro.STRDESPRO,tblcatuni.STRNOMUNI ,tblinv.DTEFEC, tblinv.INTTIPMOV,tblinv.INTFOL , tblinvdet.* FROM  tblinv INNER JOIN tblinvdet on tblinv.INTIDINV=tblinvdet.INTIDINV INNER JOIN tblcatpro ON tblinvdet.SKU=tblcatpro.STRSKU INNER JOIN tblcatuni on tblinvdet.INTIDUNI=tblcatuni.INTIDUNI WHERE DTEFEC >='$fechainicial' AND DTEFEC<='$fechaFinal' AND INTTIPMOV='$movi';";
    
        $query = mysqli_query($con,$consulta);
    
    ?>
    <table id="example1" class="table table-bordered table-striped">
    
    <thead>
        <tr>
            <th>#id inventario</th>
            <th>Fecha</th>
            <th>tipo</th>
            <th>Folio</th>
            <th>sku</th>
            <th>descripcion</th>
            <th>Referencia</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Action</th>
           
        </tr>
    </thead>
    
    <tbody>
        <?php
        $finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $INTIDINV = $row['INTIDINV'];
            $DTEFEC = $row['DTEFEC'];
            $INTTIMOV = $row['INTTIPMOV'];
            $INTFOL = $row['INTFOL'];
            $SKU = $row['SKU'];
            $STRDESPRO = $row['STRDESPRO'];
            $STRREF = $row['STRREF'];
            $INTCAN = $row['INTCAN'];
            $STRNOMUNI = $row['STRNOMUNI'];
            $MONPRCOS = $row['MONPRCOS'];
            $MONCTOPRO = $row['MONCTOPRO'];
            $MONPRCOS="$". number_format($MONPRCOS, 2, '.', ',');
            $MONCTOPRO="$". number_format($MONCTOPRO, 2, '.', ',');
    
    
    
            /*$kind=$row['kind'];*/
    
            $finales++;
        ?>
            <tr>
                <td><?php echo $INTIDINV ?></td>
                <td><?php echo $DTEFEC  ?></td>
               
               
                <td><?php echo ($INTTIMOV == 1) ?  "Entrada" : "Salida"; ?></td>
                <td><?php echo $INTFOL ?></td>
                <td><?php echo $SKU ?></td>
                <td><?php echo $STRDESPRO ?></td>
                <td><?php echo $STRREF ?></td>
                <td><?php echo $INTCAN ?></td>
                <td><?php echo $STRNOMUNI ?></td>
                <td><?php echo $MONPRCOS ?></td>
                <td><?php echo $MONCTOPRO ?></td>
                
                <td class="text-right">
                    <?php if (in_array(2, $_SESSION['Habilidad']['Entradas'])) { ?>
                      <form action="./?view=EditarEntrada" method="POST" role="form">
                      <input type="hidden" required class="form-control" id="identrada" name="identrada"  value="<?php echo $INTIDINV ?>">
                      <button type="submit" class="btn btn-warning btn-square btn-xs" ><i class="far fa-edit"></i></button>
    
    
                      </form>
    
    
    
                         
                        <!--<button type="button" class="btn btn-warning btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="editar('<?php echo $INTIDINV; ?>');"><i class="far fa-edit"></i></button>-->
                    <?php } ?>
                    <?php if (in_array(3, $_SESSION['Habilidad']['Entradas'])) { ?>
                        <button type="button" class="btn btn-danger btn-square btn-xs" onclick="eliminar('<?php echo $INTIDINV; ?>')"><i class="far fa-trash-alt"></i></button>
                    <?php } ?>
                    <?php if (in_array(4, $_SESSION['Habilidad']['Entradas'])) { ?>
                        <button type="button" class="btn btn-info btn-square btn-xs" data-toggle="modal" data-target="#modal_show" onclick="mostrar('<?php echo $INTIDINV; ?>')"><i class="far fa-eye"></i></button>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
    </tbody>
    
    <tfoot>
   
    </tfoot>
    </table>
    
    
    
    
    <?php
    
    } else {
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';
    
                
            
    }







}else{
    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Sin Resultados!</strong> No se encontraron resultados en la base de datos!.</div>';

   

}




