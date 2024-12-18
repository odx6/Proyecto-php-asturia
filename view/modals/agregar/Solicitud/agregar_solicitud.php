<?php if (in_array(1, $_SESSION['Habilidad']['Solicitud'])) { ?>

    <!-- Form Modal -->
    <div class="modal fade" id="formModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                        <input type="hidden" required class="form-control" id="IDEMPLEADO" name="IDEMPLEADO" placeholder="EMPLEADO: " value="<?php if (isset($id)) echo   $id ?>">
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
                                            echo '<option value="' . $fila['IDEMP'] . '"  <?php if($id= $fila["IDEMP"])echo "selected" ?>   ' . $fila['STRNOM'] . " " . $fila['STRAPE'] . '</option>';
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
                        

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="guardar_datos" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    
<?php } ?>