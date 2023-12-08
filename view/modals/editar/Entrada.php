<?php
session_start();
require_once("../../../config/config.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblinv where INTIDINV='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        while ($row = mysqli_fetch_array($query)) {
            $INTIDINV = $row['INTIDINV'];
            $INTIDTOP = $row['INTIDTOP'];
            $INTTIPMOV = $row['INTTIPMOV'];
           
            $INTFOL = $row['INTFOL'];
            $IDEMP = $row['IDEMP'];
            $STROBS = $row['STROBS'];
            $INTALM = $row['INTALM'];
            $DTEHOR = $row['DTEHOR'];

           
           
        }
    }
} else {
    exit;
}
?>
<div class="form-group">
    
    <input type="hidden" required class="form-control" id="INTIDINV" name="INTIDINV" placeholder="Folio:" value="<?php echo $id ?>">
    <div class="col-sm-4">
        <label for="INTIDTOP" reuired class="control-label">INTIDTOP: </label>
        <?php

        // Consulta SQL para obtener los datos
        $consulta = "SELECT  INTIDTOP,STRNOMTPO FROM tblcattop ORDER BY STRNOMTPO ASC";
        $resultado = mysqli_query($con, $consulta);


        // Crear el elemento select
        echo ' <select class="form-control " name="INTIDTOP" id="INTIDTOP">';

        if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

            // Iterar sobre los resultados y crear una opción para cada uno

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<option value="' . $fila['INTIDTOP'] . '"  <?php if($INTIDTOP= $fila["INTIDTOP"]) selected ?>   ' . $fila['STRNOMTPO'] . '</option>';
            }
        } else {

            echo  '<option value="" disabled  selected >No hay TBLCATTOP  bd agregue datos </option>';
        }

        echo '</select>';
        ?>


    </div>


    <div class="col-sm-4">
        <label for="INTTIPMOV" class=" control-label">Movimiento: </label>
        <select class="form-control col-sm-10" name="INTTIPMOV" id="INTTIPMOV" required>
            <option value="1">Entrada</option>
            <option value="2">Salida</option>
        </select>
    </div>
    <div class="col-sm-4">
        <label for="INTIDALM" reuired class="control-label">ALMACEN: </label>
        <?php

        // Consulta SQL para obtener los datos
        $consulta = "SELECT  INTIDALM,STRNOMALM FROM tblcatalm ORDER BY STRNOMALM  ASC";
        $resultado = mysqli_query($con, $consulta);


        // Crear el elemento select
        echo ' <select class="form-control " name="INTIDALM" id="INTIDALM">';

        if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

            // Iterar sobre los resultados y crear una opción para cada uno

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<option value="' . $fila['INTIDALM'] . '"  <?php if($INTIDALM= $fila["INTIDALM"]) selected ?>   ' . $fila['STRNOMALM'] . '</option>';
            }
        } else {

            echo  '<option value="" disabled  selected >No hay datos de almacen en la base de datos registre nuevos </option>';
        }

        echo '</select>';
        ?>


    </div>






</div>
<div class="form-group">
    <div class="col-sm-6">
        <label for="INTFOL" class=" control-label">Folio: </label>
        <input type="text" required class="form-control" id="INTFOL" name="INTFOL" placeholder="Folio: " value="<?php echo $INTFOL?>">
        <span id="MINTFOL"></span>
    </div>

    <div class="col-sm-6">
        <label for="STROBS" class=" control-label">Descripcion: </label>
        <input type="text" required class="form-control" id="STROBS" name="STROBS" placeholder="Descripcion: " value="<?php echo $STROBS?>">
        <span id="STROBS"></span>
    </div>
</div>
<div class="col-sm-12">
    <div class="col-sm-6">
        <label for="columna" class=" control-label">Buscar: </label>
        <select class="form-control col-sm-10 columna" name="columna" id="columna" required style="margin-bottom: 5px;">
            <option value="STRSKU">SKU</option>
            <option value="STRCOD">Codigo</option>
            <option value="STRDES">Descripcion</option>

        </select>
        <div>
            <label for="STRREF" class=" control-label">Referencia: </label>

            <input type="text" required class="form-control" id="STRREF" name="STRREF" placeholder="Referencia: ">
            <span id="STRREF"></span>

        </div>




    </div>
    <div class="col-sm-6">
        <label for="INTTIPMOV" class=" control-label">por</label>

        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por nombre" id="campo" onkeyup="mostrarProductos()">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick='mostrarProductos()'><i class='fa fa-search'></i></button>
            </span>



        </div>
        <label for="INTCAN" class=" control-label">Cantidad</label>

        <input type="number" required class="form-control" id="INTCAN" name="INTCAN" placeholder="cantidad: ">
        <span id="INTCAN"></span>


    </div>
    <div class="col-sm-12">
        <select multiple size="10" class="form-control" id="outproduct" style="margin-bottom: 5px;">
            <option disabled>Ninguna busqueda</option>
        </select>

    </div>
    <div class="cpl-sm-12 modal-footer">

        <button type="button" class="btn btn-warning" onclick="agregarInventario()">Agregar <i class="fa fa-plus"></i></button>
    </div>

</div>


<div class="col-sm-12">


    <div class="col-sm-12">
        <table class="table caption-top" id="miTabla">
            <caption>Productos Agregados</caption>
            <thead>
                <tr>
                    <th scope="col">Numero</th>
                    <th scope="col">SKU</th>
                    <th scope="col">pre.</th>
                    <th scope="col">cant.</th>
                    <th scope="col">ref.</th>
                    <th scope="col">tot./u</th>
                    <th scope="col">Accion</th>

                </tr>
            </thead>
            <tbody>
            
             <?php 
            $sql = "SELECT  * FROM  tblinvdet  WHERE INTIDINV='$id'";
            $query = mysqli_query($con, $sql);
    
    
            // Crear el elemento select
           
    
            if (isset($query) && $query != NULL &&  mysqli_num_rows($query) > 0) {
    
                // Iterar sobre los resultados y crear una opción para cada uno
    
                while ($fila = mysqli_fetch_assoc($query)) {
                    
                    echo '<tr id="'.$fila['SKU'].'">';
                  //  echo '<Td >'.$fila['SKU'].'</Td>'.'<Td>'.$fila['STRREF'].'</Td>'.'<Td>'.$fila['INTCAN'].'</Td>'.'<Td>'.$fila['MONPRCOS'].'</Td>'.'<Td>'.$fila['MONCTOPRO'].'</Td>'.'<td> <button type="button"   class="btn btn-danger btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="validarImg()" ><i class="fa fa-edit"></i></button></td>';
                  echo '<Td >'.$fila['SKU'].'</Td>'.'<Td>'.$fila['STRREF'].'</Td>'.'<Td>'.$fila['INTCAN'].'</Td>'.'<Td>'.$fila['MONPRCOS'].'</Td>'.'<Td>'.$fila['MONCTOPRO'].'</Td>'.'<td> <button type="button"   class="btn btn-danger btn-square btn-xs" data-toggle="modal" data-target="#modal_update" onclick="validarImg(\''.$fila['SKU'].'\')" ><i class="fa fa-edit"></i></button></td>';
                  echo '</tr>';
                }
            } else {
    
                echo  '<option value="" disabled  selected >No se registraron productos  </option>';
            }
    
            echo '</select>';
            ?>
            


            </tbody>
        </table>

    </div>
    <div class="col-sm-8"><label for="MONCTOPRO" class=" control-label">Total</label></div>

    <div class="col-sm-4"><input type="number" required class="form-control static" id="MONCTOPRO" name="MONCTOPRO" placeholder="Total: " readonly>
        <br>
    </div>


</div>


</div>