<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['Subcategorias'])) {
    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatsbc where INTIDSBC='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {

                $INTIDCAT = $row['INTIDCAT'];
                $STRNOMSBC = $row['STRNOMSBC'];
                $STRDESBC = $row['STRDESBC'];
                $DTEHOR = $row['DTEHOR'];
                $BITSUS = $row['BITSUS'];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">

    <div class="row">
        <div class="col-4">
            <label for="usuario" class="col-form-label">Categoria: </label>
            <?php

            // Consulta SQL para obtener los datos
            $consulta = "SELECT  INTIDCAT,STRNOMCAT FROM tblcatcat";
            $resultado = mysqli_query($con, $consulta);


            // Crear el elemento select
            echo ' <select class="form-control" name="INTIDCAT" id="INTIDCAT">';

            if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                // Iterar sobre los resultados y crear una opción para cada uno

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $valor = "";
                    if ($INTIDCAT == $fila["INTIDCAT"]) $valor = "selected";

                    echo '<option value="' . $fila['INTIDCAT'] . '"' . $valor . "> " . $fila['STRNOMCAT'] . '</option>';
                }
            } else {

                echo  '<option value="" disabled  selected >No hay categorias en la  bd agregue datos </option>';
            }

            echo '</select>';
            ?>


            <div class="form-group">

            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="dni" class="col-form-label">Nombre : </label>
                <input type="text" required class="form-control" id="STRNOMSBC" name="STRNOMSBC" placeholder="Nombre Categoria: " value="<?php echo $STRNOMSBC ?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="estado" class="col-form-label">Estado: </label>
                <select class="form-control" name="BITSUS" id="BITSUS">
                    <option value="1" <?php if ($BITSUS == 1) echo  "selected" ?>>Activo</option>
                    <option value="2" <?php if ($BITSUS == 2) echo  "selected" ?>>Inactivo</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="nombre" class="col-form-label">Descripcion: </label>
                <input type="text" required class="form-control" id="STRDESBC" name="STRDESBC" placeholder="Descripcion: " value="<?php echo $STRDESBC ?>">
            </div>
        </div>

    </div>


<?php } ?>