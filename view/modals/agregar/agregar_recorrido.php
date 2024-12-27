<?php if (in_array(1, $_SESSION['Habilidad']['Kilometraje'])) { ?>


    <div class="modal fade" id="formModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar recorrido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--inicio modal -->
                    <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
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
                                            echo '<option value="' . $fila['STRPRUT'] . '"  <?php if($STRPRUT= $fila["STRPRUT"]) selected ?>   ' . $fila['STRNOM'] . '</option>';
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
                                    <input type="date" required class="form-control" id="DTHCAP" name="DTHCAP" placeholder="Modelo: ">
                                </div>
                            </div>
                           
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="KLMFIN" class=" col-form-label">ODOMETRO FINAL: </label>
                                    <input type="number" required class="form-control" id="KLMFIN" name="KLMFIN" placeholder="odometro final: ">
                                </div>
                            </div>
                        
                        </div>








                        <!--end modal -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="guardar_datos" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<?php } ?>