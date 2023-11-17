<?php
session_start();
require_once("../../../config/config.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblcatpro where STRSKU='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        $rw = mysqli_fetch_array($query);
        $sku = $rw['STRSKU'];
        $codigo = $rw['STRCOD'];
        $descripcion = $rw['STRDESPRO'];
        $categoria = $rw['INTIDCAT'];
        $subcategoria = $rw['INTIDSBC'];

        if (isset($subcategoria) && $subcategoria != NULL) {
            $Subcategoria = mysqli_query($con, "SELECT * FROM  tblcatsbc WHERE INTIDSBC='$subcategoria'");

            if (isset($Subcategoria) && $Subcategoria != NULL) {
                $tem = mysqli_fetch_array($Subcategoria);
                if (isset($tem) && $tem != NULL) $SubcategoriaNombre = $tem['STRNOMSBC'];
            }
        }
        $precio = $rw['MONPCOS'];
        $unidadMedida = $rw['INTIDUNI'];
        $imagen = $rw['STRIMG'];
        $perteneceTaller = $rw['INTTIPUSO'];

        $status = $rw['BITSUS'];
    }
} else {
    exit;
}
?>

<figure class="figure">
    <img src="<?php echo $imagen; ?>" class="figure-img img-fluid rounded" alt="..." id="EverCambio">
    <figcaption class="figure-caption">


    </figcaption>

</figure>
<br>
<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">

<div class="form-group">
    <label for="imagefile" class="col-sm-2 control-label">Imagen: </label>
    <div class="col-sm-10">
        <input type="file" name="STRIMG" class="form-control" id="STRIMG" >
    </div>
</div>

<div class="form-group">
    <label for="dni" class="col-sm-2 control-label">SKU: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="sku" name="sku" value="<?php echo $sku; ?>" placeholder="SKU: ">
    </div>
</div>

<div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Codigo: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="codigo" name="codigo" value="<?php echo $codigo; ?>" placeholder="Codigo: ">
    </div>
</div>
<div class="form-group">
    <label for="apellido" class="col-sm-2 control-label">Descripcion: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" placeholder="Descripcion: ">
    </div>
</div>
<div class="form-group">
    <label for="usuario" class="col-sm-2 control-label">Categoria: </label>

    <div class="col-sm-10">
        <?php

        // Consulta SQL para obtener los datos
        $consulta = "SELECT  INTIDCAT,STRNOMCAT FROM tblcatcat";
        $resultado = mysqli_query($con, $consulta);


        // Crear el elemento select
        echo ' <select class="form-control  categorias" name="categoria" id="categoria" onclick="mensaje();">';

        if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

            // Iterar sobre los resultados y crear una opción para cada uno

            while ($fila = mysqli_fetch_assoc($resultado)) {
                $valor = "";
                if ($categoria == $fila["INTIDCAT"]) $valor = "selected";
                echo '<option value="' . $fila['INTIDCAT'] . '"' . $valor . "> " . $fila['STRNOMCAT'] . '</option>';
            }
        } else {

            echo  '<option value="" disabled  selected >No hay categorias en la  bd agregue datos </option>';
        }

        echo '</select>';
        ?>



    </div>
</div>


<div class="form-group">
    <label for="subcategoria" class="col-sm-2 control-label">Subcategoria: </label>
    <div class="col-sm-10">
        <select class="form-control Subcategorias" name="Subcategoria" id="Subcategoria" required>

            <option value="<?php echo $subcategoria; ?>" selected><?php echo $SubcategoriaNombre; ?></option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="precio" class="col-sm-2 control-label">Precio: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="precio" name="precio" placeholder="Precio" pattern="\d+" title="Por favor ingresa solo números positivos" required value="<?php echo $precio; ?>">
    </div>
</div>

<div class="form-group">
    <label for="usuario" reuired class="col-sm-2 control-label">Unidad de medida : </label>

    <div class="col-sm-10">
        <?php

        // Consulta SQL para obtener los datos
        $consulta = "SELECT  INTIDUNI,STRNOMUNI FROM tblcatuni ORDER BY STRNOMUNI ASC";
        $resultado = mysqli_query($con, $consulta);


        // Crear el elemento select
        echo ' <select class="form-control categorias" name="unidad" id="unidad">';

        if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

            // Iterar sobre los resultados y crear una opción para cada uno

            while ($fila = mysqli_fetch_assoc($resultado)) {
                $valor = "";
                if ($unidadMedida == $fila["INTIDUNI"]) $valor = "selected";
                echo '<option value="' . $fila['INTIDUNI'] . '"' . $valor . "> " . $fila['STRNOMUNI'] . '</option>';
            }
        } else {

            echo  '<option value="" disabled  selected >No hay categorias en la  bd agregue datos </option>';
        }

        echo '</select>';
        ?>




    </div>
</div>

<!--<div class="form-group">
    <label for="localidad" class="col-sm-2 control-label">Imagen: </label>
    <div class="col-sm-10">
        <input type="file" name="imagefile" class="form-control" id="imagefile" onchange="UploadImng()">
    </div>
</div>-->

<div class="form-group">
    <label for="usuario" reuired class="col-sm-2 control-label">Tipo de uso: </label>

    <div class="col-sm-10">
        <?php

        // Consulta SQL para obtener los datos
        $consulta = "SELECT  INTIDPUSO,STRNOMPUSO FROM tblcattus ORDER BY STRNOMPUSO ASC";
        $resultado = mysqli_query($con, $consulta);


        // Crear el elemento select
        echo ' <select class="form-control " name="INTIDPUSO" id="STRNOMPUSO">';

        if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

            // Iterar sobre los resultados y crear una opción para cada uno

            while ($fila = mysqli_fetch_assoc($resultado)) {
                $valor = "";
                if ($perteneceTaller == $fila["INTIDPUSO"]) $valor = "selected";
                echo '<option value="' . $fila['INTIDPUSO'] . '"' . $valor . "> " . $fila['STRNOMPUSO'] . '</option>';
            }
        } else {

            echo  '<option value="" disabled  selected >No hay tipos de uso en la  bd agregue datos </option>';
        }

        echo '</select>';
        ?>




    </div>
</div>



<div class="form-group">
    <label for="estado" class="col-sm-2 control-label">Estado: </label>
    <div class="col-sm-10">
        <select class="form-control" name="estado" id="estado" required>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
        </select>
    </div>
</div>