<button class="btn btn-primary" data-toggle="modal" data-target="#formModal"><i class='fa fa-plus'></i> Nuevo</button>
<button class="btn btn-danger" data-toggle="modal" data-target="#" onclick='exportpf("peticionajax")'><i class='fa fa-plus'></i>Exportar</button>


<!-- Form Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" enctype="multipart/form-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- form  -->
            <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> Nueva Subcategoria</h4>
                </div>
                <div class="modal-body">
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
                                    echo '<option value="' . $fila['INTIDCAT'] . '"  <?php if($categoria= $fila["INTIDCAT"]) selected ?>   ' . $fila['STRNOMCAT'] . '</option>';
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
                            <input type="text" required class="form-control" id="STRNOMSBC" name="STRNOMSBC" placeholder="Nombre : ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Descripcion: </label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="STRDESSBC" name="STRDESSBC" placeholder="Descripcion: ">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estado" class="col-sm-2 control-label">Estado: </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="BITSUS" id="BITSUS">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="kind" class="col-sm-2 control-label">Kind: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kind" name="kind" placeholder="Kind: ">
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="guardar_datos" class="btn btn-primary">Agregar</button>
                </div>
            </form>
            <!-- /end form  -->
        </div>
    </div>
</div>
<!-- End Form Modal -->