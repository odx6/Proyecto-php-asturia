<?php
session_start();
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
<div class="form-group">
                        <label for="usuario" class="col-sm-2 control-label">Categoria: </label>

                        <div class="col-sm-10">
                            <?php

                            // Consulta SQL para obtener los datos
                            $consulta = "SELECT  INTIDCAT,STRNOMCAT FROM tblcatcat";
                            $resultado = mysqli_query($con, $consulta);


                            // Crear el elemento select
                            echo ' <select class="form-control" name="INTIDCAT" id="INTIDCAT">';

                            if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                // Iterar sobre los resultados y crear una opción para cada uno

                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    $valor="";
                                    if($INTIDCAT== $fila["INTIDCAT"]) $valor="selected";

                                    echo '<option value="' . $fila['INTIDCAT'] . '"'.$valor."> ". $fila['STRNOMCAT'] . '</option>';
                                }
                            } else {

                                echo  '<option value="" disabled  selected >No hay categorias en la  bd agregue datos </option>';
                            }

                            echo '</select>';
                            ?>




                        </div>
                    </div>
<div class="form-group">
    <label for="dni" class="col-sm-2 control-label">Nombre : </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRNOMSBC" name="STRNOMSBC" placeholder="Nombre Categoria: " value="<?php echo $STRNOMSBC ?>">
    </div>
</div>
<div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Descripcion: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRDESBC" name="STRDESBC" placeholder="Descripcion: " value="<?php echo $STRDESBC ?>">
    </div>
</div>


<div class="form-group">
    <label for="estado" class="col-sm-2 control-label">Estado: </label>
    <div class="col-sm-10">
        <select class="form-control" name="BITSUS" id="BITSUS">
            <option value="1" <?php if($BITSUS=="1") echo  "selected"?>>Activo</option>
            <option value="2"  <?php if($BITSUS=="2") echo  "selected" ?>>Inactivo</option>
        </select>
    </div>
</div>

