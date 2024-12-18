<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['vehiculos'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        //$id = intval($id);
        $sql = "SELECT * FROM `tblcatveh` WHERE STRNMRSR='$id';";
      
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {

                $STRNMRSR = $row["STRNMRSR"];
                $STRNMR = $row["STRNMR"];
                $STRMRC = $row["STRMRC"];
                $STRMDL = $row["STRMDL"];
                $STRPLC = $row["STRPLC"];
                $STRTPVH = $row["STRTPVH"];
                $LNGIDNORG = $row["LNGIDNORG"];
                $BITSUS = $row["BITSUS"];
                $DTHOR = $row["DTHOR"];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $STRNMRSR ?>" id="id" name="id" require>

    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="STRNMRSR" class=" col-form-label">IDENTIFICADOR: </label>
                <input type="text" required class="form-control" id="STRNMRSR" name="STRNMRSR"  value="<?php echo  $STRNMRSR ?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="STRNMR" class=" col-form-label">NÚMERO: </label>
                <input type="text" required class="form-control" id="STRNMR" name="STRNMR"  value="<?php echo $STRNMR?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="STRMRC" class=" col-form-label">MARCA: </label>
                <input type="text" required class="form-control" id="STRMRC" name="STRMRC"  value="<?php echo $STRMRC ?>">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="modelo" class=" col-form-label">MODELO: </label>
                <input type="text" required class="form-control" id="STRMDL" name="STRMDL"  value="<?php echo $STRMDL  ?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="PLACAS" class=" col-form-label">PLACAS: </label>
                <input type="text" required class="form-control" id="STRPLC" name="STRPLC" value="<?php echo $STRPLC ?>" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="TIPO" class=" col-form-label">TIPO: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  STRTPVH,STRNOM FROM tbltpveh  ORDER BY STRNOM ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="STRTPVH" id="STRTPVH">';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['STRTPVH'] . '"  <?php if($STRTPVH= $fila["STRTPVH"])echo "selected" ?>   ' . $fila['STRNOM'] . '</option>';
                    }
                } else {

                    echo  '<option value="" disabled  selected >No hay tipos de vehiculos </option>';
                }

                echo '</select>';
                ?>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label for="TIPO" class=" col-form-label">Origen: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  LNGIDNORG,STRDSCORG FROM tblcatorg ORDER BY STRDSCORG ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="LNGIDNORG" id="LNGIDNORG">';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['LNGIDNORG'] . '"  <?php if($LNGIDNORG= $fila["LNGIDNORG"]) echo "selected" ?>   ' . $fila['STRDSCORG'] . '</option>';
                    }
                } else {

                    echo  '<option value="" disabled  selected >Debe tener una organizacion  registrada </option>';
                }

                echo '</select>';
                ?>

            </div>

        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="BITSUS" class="col-form-label">Estado: </label>

                <select class="form-control select2" name="BITSUS" id="BITSUS">
                    <option value="1" <?php if ($BITSUS == 1) echo "selected"; ?>>Activo</option>
                    <option value="2" <?php if ($BITSUS == 2) echo "selected"; ?>>Inactivo</option>
                </select>
            </div>

        </div>
    </div>








<?php } ?>