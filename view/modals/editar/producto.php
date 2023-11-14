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
<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
<div class="form-group">
    <label for="dni" class="col-sm-2 control-label">SKU: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="sku" name="sku" value="<?php echo $sku; ?>" placeholder="SKU: ">
    </div>
</div>
<div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Codigo: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="Codigo" name="Codigo" value="<?php echo $codigo; ?>" placeholder="Codigo: ">
    </div>
</div>
<div class="form-group">
    <label for="apellido" class="col-sm-2 control-label">Descripcion: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="Descripcion" name="Descripcion" value="<?php echo $descripcion; ?>" placeholder="Descripcion: ">
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
                if($categoria== $fila["INTIDCAT"]) $valor="selected";
                echo '<option value="' . $fila['INTIDCAT'] . '" >' . $fila['STRNOMCAT'] . '</option>';
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
        <select class="form-control Subcategorias" name="Subcategoria" id="Subcategoria">

            <option value="" selected desabled> seleccione una categoria primero</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">Precio: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="Precio" name="Precio" value="<?php echo $precio; ?>" placeholder="Precio :">
    </div>
</div>
<div class="form-group">
    <label for="domicilio" class="col-sm-2 control-label">Unidad de Medida: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="Unidad" name="Unidad" value="<?php echo $unidadMedida; ?>" placeholder="Unidad: ">
    </div>
</div>

<div class="form-group">
    <label for="localidad" class="col-sm-2 control-label">Imagen: </label>
    <div class="col-sm-10">
        <input type="file" name="imagefile" class="form-control" id="imagefile">
    </div>
</div>
<div class="form-group">
    <label for="telefono" class="col-sm-2 control-label">En taller </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="PTaller" name="PTaller" value="<?php echo $perteneceTaller; ?>" placeholder="PTaller">
    </div>
</div>


<div class="form-group">
    <label for="estado" class="col-sm-2 control-label">Estado: </label>
    <div class="col-sm-10">
        <select class="form-control" name="estado" id="estado">
            <option value="1" <?php if ($status == 1) {
                                    echo "selected";
                                } ?>>Activo</option>
            <option value="2" <?php if ($status == 2) {
                                    echo "selected";
                                } ?>>Inactivo</option>
        </select>
    </div>
</div>