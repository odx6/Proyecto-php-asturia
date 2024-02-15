<?php
session_start();
require_once("../../../config/config.php");

if (isset($_GET["id"]) && in_array(2, $_SESSION['Habilidad']['Productos'])) {
    $id = $_GET["id"];
    $user = $_SESSION['user_id'];
    $sql = "select * from tblcatpro where STRSKU='$id' AND loked=1 and Editor=0 OR STRSKU='$id' and loked=0 AND Editor='$user';";



    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {

        $consulta = "UPDATE `tblcatpro` SET `loked` = '0',`Editor` = '$user' WHERE `tblcatpro`.`STRSKU` = '$id';";
        $query1 = mysqli_query($con, $consulta);

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


<?php if ($num == 1 && in_array(2, $_SESSION['Habilidad']['Productos'])) {  ?>

    <br>
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">

    <!-- new modal-->
    <div class="row">
        <div class="col-6">
            <label for="dni" class=" control-label">SKU: </label>
            <input type="text" required class="form-control" id="sku" name="sku" value="<?php echo $sku; ?>" placeholder="SKU: ">
        </div>
        <div class="col-6">
            <label for="nombre" class=" control-label">Codigo: </label>
            <input type="text" required class="form-control" id="codigo" name="codigo" value="<?php echo $codigo; ?>" placeholder="Codigo: ">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="apellido" class="control-label">Descripcion: </label>
                <input type="text" required class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" placeholder="Descripcion: ">
            </div>
        </div>
    </div>
    <div class="card mb-3" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo $imagen ?>" class="img-fluid rounded-start  EverCambio" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="imagefile" class="control-label">Imagen: </label>
                                <input type="file" name="STRIMGPU" class="form-control validarBtn" id="STRIMGPU" style="display: none;">
                                <div class="btn-group w-100" onclick="img('STRIMGPU')">
                                    <span class="btn btn-success col fileinput-button">
                                        <i class="fas fa-plus"></i>
                                        <span>Agregar imagen</span>

                                    </span>

                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usuario" class="control-label">Categoria: </label>

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
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="subcategoria" class=" control-label">Subcategoria: </label>
                                <select class="form-control Subcategorias" name="Subcategoria" id="Subcategoria" required>

                                    <option value="<?php echo $subcategoria; ?>" selected><?php echo $SubcategoriaNombre; ?></option>
                                </select>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="precio" class=" control-label">Precio: </label>
                                <input type="text" required class="form-control" id="precio" name="precio" placeholder="Precio" pattern="\d+" title="Por favor ingresa solo números positivos" required value="<?php echo $precio; ?>">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usuario" reuired class=" control-label">Unidad de medida : </label>

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


                        <div class="col-6">
                            <div class="form-group">
                                <label for="usuario" reuired class="control-label">Tipo de uso: </label>
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
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="estado" class=" control-label">Estado: </label>
                                <select class="form-control col-sm-10" name="estado" id="estado" required>
                                    <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Activo</option>
                                    <option value="2" <?php if ($status == 2) echo 'selected'; ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end new modal-->



<?php } else {

    echo
    'Error';
}  ?>