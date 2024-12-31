<?php
session_start();
if (in_array(2, $_SESSION['Habilidad']['Kilometraje'])) {

    require_once("../../../config/config.php");
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $id = intval($id);
        $sql = "select * from tblreco where STRPRE ='$id'";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($row = mysqli_fetch_array($query)) {
                $STRPRE = $row["STRPRE"];
                $IDEMP = $row["IDEMP"];
                $STRNMRSR = $row["STRNMRSR"];
                $STRPRUT = $row["STRPRUT"];
                $KLMINI=$row["KLMINI"];
                $KLMFIN = $row["KLMFIN"];
                $KLMRECO=$row["KLMRECO"];
                $DOUREN=$row["DOUREN"];
                $INPRT=$row["INPRT"];
                $DOUCON=$row["DOUCON"];
                $DOUDIF=$row["DOUDIF"];
                $DOUDES=$row["DOUDES"];
                $DTHCAP = $row["DTHCAP"];
                $DTHOR = $row["DTHOR"];
            }
        }
    } else {
        exit;
    }
?>
    <input type="hidden" value="<?php echo $STRPRE  ?>" id="id" name="id" require>
    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="OPERADOR" class=" col-form-label">Operador: </label>

                                    <?php

                                    // Consulta SQL para obtener los datos
                                    $consulta = "SELECT  IDEMP,STRNOM,STRAPE FROM `tblcatemp`  ORDER BY STRNOM ASC";
                                    $resultado = mysqli_query($con, $consulta);


                                    // Crear el elemento select
                                    echo ' <select class="form-control select2" name="IDEMP" id="IDEMP">';

                                    if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                        // Iterar sobre los resultados y crear una opción para cada uno

                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                            echo '<option value="' . $fila['IDEMP'] . '"';
                                            if($IDEMP== $fila["IDEMP"])echo "selected";
                                         
                                            echo '>' . $fila['STRNOM'] . '' . $fila['STRAPE'] . '</option>';
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
                                            echo '<option value="' . $fila['STRNMRSR'] . '"';
                                               if($STRNMRSR== $fila["STRNMRSR"]) echo "selected";
                                               echo   '> ' . $fila['STRNMR'] . "-" . $fila['STRMRC'] . "-" . $fila['STRMDL'] . '</option>';
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

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Vehiculo" class=" col-form-label">Ruta : </label>

                                    <?php

                                    // Consulta SQL para obtener los datos
                                    $consulta = "SELECT  STRPRUT,STRNOM FROM tblcatrut ORDER BY STRPRUT ASC";
                                    $resultado = mysqli_query($con, $consulta);


                                    // Crear el elemento select
                                    echo ' <select class="form-control select2" name="STRPRUT" id="STRPRUT">';

                                    if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                        // Iterar sobre los resultados y crear una opción para cada uno

                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                            echo '<option value="' . $fila['STRPRUT'] . '"';
                                               if($STRPRUT== $fila["STRPRUT"]) echo  "selected";
                                               echo  '>' . $fila['STRNOM'] . '</option>';
                                        }
                                    } else {

                                        echo  '<option value="" disabled  selected >Se requiere al menos una ruta para continuar con el proceso  </option>';
                                    }

                                    echo '</select>';
                                    ?>
                                </div>
                            </div>
                           

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="Fecha" class=" col-form-label">FECHA: </label>
                                    <input type="date" required class="form-control" id="DTHCAP" name="DTHCAP" placeholder="Modelo: " value="<?php echo $DTHCAP ?>">
                                </div>
                            </div>
                           
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="KLMFIN" class=" col-form-label">ODOMETRO FINAL: </label>
                                    <input type="number" required class="form-control" id="KLMFIN" name="KLMFIN" placeholder="odometro final: " value="<?php echo $KLMFIN?>">
                                </div>
                            </div>
                        
                        </div>








                        <!--end modal -->
                </div>

 
      
    <?php } ?>