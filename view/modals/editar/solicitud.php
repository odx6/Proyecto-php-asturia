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
    <input type="hidden" required class="form-control" id="LNGIDNSLC" name="LNGIDNSLC"  value="<?php echo $LNGIDNSLC ?>">
    <input type="hidden" required class="form-control" id="OLDLNGIDNSLC" name="OLDLNGIDNSLC"  value="<?php echo $LNGIDNSLC ?>">
    <input type="hidden" required class="form-control" id="OLDFOL" name="OLDFOL"  value="<?php echo $INTFOLSLCE ?>">
        
        <div class="col-6">
            <div class="form-group">
                <label for="Empleado" class=" col-form-label">Capturista: </label>

                <?php

                // Consulta SQL para obtener los datos
                $consulta = "SELECT  IDEMP,STRNOM,STRAPE FROM `tblcatemp`  ORDER BY STRNOM ASC";
                $resultado = mysqli_query($con, $consulta);


                // Crear el elemento select
                echo ' <select class="form-control select2" name="LNGIDNUSR" id="LNGIDNUSR" required>';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="'. $fila['IDEMP'] . '" ';
                        if($LNGIDNUSR ==$fila['IDEMP']) {echo 'selected';}
                         echo '>';
                         echo $fila['STRNOM'].' '.$fila['STRAPE'].'</option>';
                        
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
                echo ' <select class="form-control select2" name="LNGIDNCNT" id="LNGIDNCNT" required>';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['IDEMP'] . '"';
                         if($LNGIDNCNT == $fila["IDEMP"]) echo "selected";
                         echo '>' . $fila['STRNOM'] . ' ' . $fila['STRAPE'] . '</option>';
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
                echo ' <select class="form-control select2" name="LNGIDNMCN" id="LNGIDNMCN" required>';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['IDEMP']. '"';
                         if($LNGIDNMCN== $fila["IDEMP"])echo 'selected';
                        echo  '>' . $fila['STRNOM'] .'' . $fila['STRAPE'] . '</option>';
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
                echo ' <select class="form-control select2" name="LNGIDNORG" id="LNGIDNORG" required >';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['LNGIDNORG'] . '"';
                          if($LNGIDNORG== $fila["LNGIDNORG"])echo  'selected'; 
                          echo '>'. $fila['STRDSCORG'] . '</option>';
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
                echo ' <select class="form-control select2" name="STRNMRSR" id="STRNMRSR" required>';

                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                    // Iterar sobre los resultados y crear una opción para cada uno

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['STRNMRSR'] . '"';
                          if($STRNMRSR== $fila["STRNMRSR"])echo 'selected';
                          echo '>' . $fila['STRNMR'] . "-" . $fila['STRMRC'] . "-" . $fila['STRMDL'] . '</option>';
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

                <input type="date" required class="form-control" id="Observaciones" name="DTFCHSLC" placeholder="DTFCHSLC: " value="<?php echo $DTFCHSLC ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="unidad" class="col-12 control-label">Fecha de diagnostico : </label>

                <input type="date" class="form-control" required id="Observaciones" name="DTFCHDGN" placeholder="DTFCHDGN: " value="<?php echo $DTFCHDGN ?>">

            </div>
        </div>

    </div>



    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label for="kilometros" class="col-sm-2 control-label">kilometros: </label>
                <input type="text" required class="form-control" id="STRKLM" name="STRKLM" placeholder="kilometros" value="<?php echo $STRKLM ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="Estado" class=" control-label">Estado: </label>
                <select class="form-control" name="BITCNCSLC" id="BITCNCSLC" required >
                    <option value="1" <?php if ($BITCNCSLC == 1) echo "selected"; ?>>Registrado</option>
                    <option value="0" <?php if ($BITCNCSLC == 0) echo "selected"; ?>>Cancelado</option>
                </select>
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
                <textarea class="form-control" rows="3" placeholder="Observaciones ..." id="STROBSRPT" name="STROBSRPT" required ><?php echo $STROBSRPT ?></textarea>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Diagnostico</font>
                    </font>
                </label>
                <textarea class="form-control" rows="3" placeholder="Diagnostico ..." id="STRDGN" name="STRDGN" required ><?php echo $STRDGN ?></textarea>
            </div>
        </div>
    </div>



<?php } ?>