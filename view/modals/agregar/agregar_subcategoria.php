<div class="modal fade" id="formModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Subcategorias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="usuario" class="col-form-label">Categoria: </label>
                                <?php

                                // Consulta SQL para obtener los datos
                                $consulta = "SELECT  INTIDCAT,STRNOMCAT FROM tblcatcat  ORDER BY STRNOMCAT ASC";
                                $resultado = mysqli_query($con, $consulta);


                                // Crear el elemento select
                                echo ' <select class="form-control select2" name="INTIDCAT" id="INTIDCAT">';

                                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                    // Iterar sobre los resultados y crear una opción para cada uno

                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        echo '<option value="' . $fila['INTIDCAT'] . '"  <?php if($categoria= $fila["INTIDCAT"]) selected ?>   ' . $fila['STRNOMCAT'] . '</option>';
                                    }
                                } else {

                                    echo  '<option value="" disabled  selected >No hay categorias en la  bd agregue datos </option>';
                                }

                                echo '</select>';
                                ?>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="dni" class="col-form-label">Nombre : </label>
                                <input type="text" required class="form-control" id="STRNOMSBC" name="STRNOMSBC" placeholder="Nombre : ">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="from-group">
                                <label for="estado" class="col-form-label">Estado: </label>
                                <select class="form-control select2" name="BITSUS" id="BITSUS">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Descripcion: </label>
                                <input type="text" required class="form-control" id="STRDESSBC" name="STRDESSBC" placeholder="Descripcion: ">
                            </div>


                        </div>


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
</div>