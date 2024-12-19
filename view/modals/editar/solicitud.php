<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['Solicitud'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblcatslc where 	LNGIDNSLC='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($rw = mysqli_fetch_array($query)) {
            $LNGIDNSLC = $rw['LNGIDNSLC'];
            $LNGIDNUSR = $rw['LNGIDNUSR'];
            $INTFOLSLC = $rw['INTFOLSLC'];
            $INTFOLSLCE = $rw['INTFOLSLCE'];
            $DTFCHSLC = $rw['DTFCHSLC'];

            $LNGIDNCNT = $rw['LNGIDNCNT'];
            $LNGIDNORG = $rw['LNGIDNORG'];
            $STRNMRSR = $rw['STRNMRSR'];
            $STRKLM = $rw['STRKLM'];
            $STROBSRPT = $rw['STROBSRPT'];
            $STRDGN = $rw['STRDGN'];
            $LNGIDNMCN = $rw['LNGIDNMCN'];
            $DTFCHDGN = $rw['DTFCHDGN'];
            $BITCNCSLC = $rw['BITCNCSLC'];
            }
        }
    } else {
        exit;
    }
?>


    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="Empleado" class=" col-form-label">Capturista: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  IDEMP,STRNOM,STRAPE FROM `tblcatemp`  ORDER BY STRNOM ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="LNGIDNUSR" id="LNGIDNUSR">';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['IDEMP'] . '"  <?php if($LNGIDNSLC= $fila["IDEMP"])echo "selected" ?>   ' . $fila['STRNOM'] . " " . $fila['STRAPE'] . '</option>';
                    }
                } else {

                    echo  '<option value="" disabled  selected >No hay empleados</option>';
                }

                echo '</select>';
                ?>
            </div>


        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="Empleado" class=" col-form-label">Contacto: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  IDEMP,STRNOM,STRAPE FROM `tblcatemp`  ORDER BY STRNOM ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="LNGIDNCNT" id="LNGIDNCNT">';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['IDEMP'] . '"." <?php if($LNGIDNUSR= $fila["IDEMP"]) echo "selected" ?> ". ' . $fila['STRNOM'] . " " . $fila['STRAPE'] . '</option>';
                    }
                } else {

                    echo  '<option value="" disabled  selected >No hay empleados</option>';
                }

                echo '</select>';
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="Mecanico" class=" col-form-label">Mecanico: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  IDEMP,STRNOM,STRAPE FROM `tblcatemp`  ORDER BY STRNOM ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="LNGIDNMCN" id="LNGIDNMCN">';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['IDEMP'] . '"  <?php if($id= $fila["IDEMP"])echo "selected" ?>   ' . $fila['STRNOM'] . " " . $fila['STRAPE'] . '</option>';
                    }
                } else {

                    echo  '<option value="" disabled  selected >No hay empleados</option>';
                }

                echo '</select>';
                ?>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="TIPO" class=" col-form-label">Organizacion: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  LNGIDNORG,STRDSCORG FROM tblcatorg ORDER BY STRDSCORG ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="LNGIDNORG" id="LNGIDNORG">';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['LNGIDNORG'] . '"  <?php if($LNGIDNORG= $fila["LNGIDNORG"]) selected ?>   ' . $fila['STRDSCORG'] . '</option>';
                    }
                } else {

                    echo  '<option value="" disabled  selected >Debe tener una organizacion  registrada </option>';
                }

                echo '</select>';
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="Vehiculo" class=" col-form-label">Automovil: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  STRNMRSR,STRNMR,STRMRC,STRMDL FROM tblcatveh ORDER BY STRNMRSR ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="STRNMRSR" id="STRNMRSR">';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['STRNMRSR'] . '"  <?php if($STRNMRSR= $fila["STRNMRSR"]) selected ?>   ' . $fila['STRNMR'] . "-" . $fila['STRMRC'] . "-" . $fila['STRMDL'] . '</option>';
                    }
                } else {

                    echo  '<option value="" disabled  selected >Debe tener automoviles registrados </option>';
                }

                echo '</select>';
                ?>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label for="unidad" class="col-12 control-label">Fecha de registro : </label>

                <input type="date" class="form-control" id="Observaciones" name="DTFCHSLC" placeholder="DTFCHSLC: ">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="unidad" class="col-12 control-label">Fecha de diagnostico : </label>

                <input type="date" class="form-control" id="Observaciones" name="DTFCHDGN" placeholder="DTFCHDGN: ">

            </div>
        </div>

    </div>



    <div class="row">

        <div class="col-12">
            <div class="form-group">
                <label for="kilometros" class="col-sm-2 control-label">kilometros: </label>
                <input type="text" required class="form-control" id="STRKLM" name="STRKLM" placeholder="kilometros">
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Observaciones</font>
                    </font>
                </label>
                <textarea class="form-control" rows="3" placeholder="Observaciones ..." id="STROBSRPT" name="STROBSRPT"></textarea>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Diagnostico</font>
                    </font>
                </label>
                <textarea class="form-control" rows="3" placeholder="Diagnostico ..." id="STRDGN" name="STRDGN"></textarea>
            </div>
        </div>
    </div>



<?php } ?>