<?php if (in_array(1, $_SESSION['Habilidad']['Productos'])) { ?>


    <div class="modal fade" id="formModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--inicio modal -->
                    <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="STRNMRSR" class=" col-form-label">IDENTIFICADOR: </label>
                                    <input type="text" required class="form-control" id="STRNMRSR" name="STRNMRSR" placeholder="primari key: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="STRNMR" class=" col-form-label">NÚMERO: </label>
                                    <input type="text" required class="form-control" id="STRNMR" name="STRNMR" placeholder="número: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="STRMRC" class=" col-form-label">MARCA: </label>
                                    <input type="text" required class="form-control" id="STRMRC" name="STRMRC" placeholder="marca: ">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="modelo" class=" col-form-label">MODELO: </label>
                                    <input type="text" required class="form-control" id="STRMDL" name="STRMDL" placeholder="Modelo: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="PLACAS" class=" col-form-label">PLACAS: </label>
                                    <input type="text" required class="form-control" id="STRPLC" name="STRPLC" placeholder="PLACAS: ">
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
                                            echo '<option value="' . $fila['STRTPVH'] . '"  <?php if($STRTPVH= $fila["STRTPVH"]) selected ?>   ' . $fila['STRNOM'] . '</option>';
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

                            <div class="col-4">
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
                                            echo '<option value="' . $fila['LNGIDNORG'] . '"  <?php if($LNGIDNORG= $fila["LNGIDNORG"]) selected ?>   ' . $fila['STRDSCORG'] . '</option>';
                                        }
                                    } else {

                                        echo  '<option value="" disabled  selected >Debe tener una organizacion  registrada </option>';
                                    }

                                    echo '</select>';
                                    ?>

                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="kilometros" class=" col-form-label">kilometros: </label>
                                    <input type="number" required class="form-control" id="DOKLM" name="DOKLM" placeholder="KILOMETROS: ">
                                </div>
                            </div>


                            <div class="col-4">
                                <div class="form-group">
                                    <label for="BITSUS" class="col-form-label">Estado: </label>

                                    <select class="form-control select2" name="BITSUS" id="BITSUS">
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
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