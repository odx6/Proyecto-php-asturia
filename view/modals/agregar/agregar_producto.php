    <button class="btn btn-primary" data-toggle="modal" data-target="#formModal"><i class='fa fa-plus'></i> Nuevo</button>
    <button class="btn btn-danger" data-toggle="modal" data-target="#" onclick='exportpf("peticionajax")'><i class='fa fa-plus'></i>Exportar</button>


    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- form  -->
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"> Nuevo Producto</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sku" class="col-sm-2 control-label">SKU: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="sku" name="sku" placeholder="SKU: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="codigo" class="col-sm-2 control-label">Codigo: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="codigo" name="codigo" placeholder="Codigo: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label">Descripcion: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usuario" reuired  class="col-sm-2 control-label">Categoria: </label>

                            <div class="col-sm-10">
                                <?php

                                // Consulta SQL para obtener los datos
                                $consulta = "SELECT  INTIDCAT,STRNOMCAT FROM tblcatcat";
                                $resultado = mysqli_query($con, $consulta);


                                // Crear el elemento select
                                echo ' <select class="form-control categorias" name="categoria" id="categoria">';

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
                            <label for="subcategoria" class="col-sm-2 control-label">Subcategoria: </label>
                            <div class="col-sm-10">
                                <select class="form-control Subcategorias" name="Subcategoria" id="Subcategoria" required>

                                    <option value="" selected desabled> seleccione una categoria primero</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precio" class="col-sm-2 control-label">Precio: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="precio" name="precio" placeholder="Precio" required> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidad" class="col-sm-2 control-label">Unidad de medida : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="unidad" name="unidad" placeholder="Unidad: " required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="localidad" class="col-sm-2 control-label">Imagen: </label>
                            <div class="col-sm-10">
                                <input type="file" name="imagefile" class="form-control" id="imagefile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="col-sm-2 control-label">Pertenece al taller</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Ptaller" name="Ptaller" placeholder="Pertenece al taller" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telefono" class="col-sm-2 control-label">INITIPUSO</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="INITIPUSO" name="INITIPUSO" placeholder="INITIPUSO" requeired>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="estado" class="col-sm-2 control-label">Estado: </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                        <label for="permisos" class="col-sm-2 control-label">Permisos: </label>
                        <div class="col-sm-10">
                            <ul style="list-style: none;" id="permisos">
                                
                            </ul>
                        </div>
                    </div>-->
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