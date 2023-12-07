    <button class="btn btn-primary" data-toggle="modal" data-target="#formModal"><i class='fa fa-plus'></i> Nuevo</button>
    <button class="btn btn-danger" data-toggle="modal" data-target="#" onclick='exportpf("peticionajax")'><i class='fa fa-plus'></i>Exportar</button>


    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- form  -->
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"> Nuevo Producto</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">

                            <div class="col-sm-6">
                                <label for="STRSKU" class="col-sm-2 control-label">SKU: </label>
                                <input type="text" required class="form-control" id="STRSKU" name="STRSKU" placeholder="SKU: " onchange="validarExistencia(this.value,'tblcatpro','STRSKU')">
                                <span id="MSTRSKU"></span>
                            </div>


                            <div class="col-sm-6">
                                <label for="STRCOD" class=" control-label">Codigo: </label>
                                <input type="text" required class="form-control" id="STRCOD" name="STRCOD" placeholder="Codigo: " onchange="validarExistencia(this.value,'tblcatpro','STRCOD')">
                                <span id="MSTRCOD"></span>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-12">
                                <label for="imagefile" class="control-label">Imagen: </label>
                                <input type="file" name="STRIMG" class="form-control validarBtn" id="STRIMG" >
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 800px;">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="view/resources/images/Default/productoinit.png" class="img-fluid rounded-start EverCambio" alt="..." >
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                           
                                            <div class="col-sm-6">
                                            <label for="descripcion" class=" control-label">Descripcion: </label>
                                                <input type="text" required class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion: ">
                                            </div>
                                        
                                            

                                            <div class="col-sm-6">
                                            <label for="usuario" reuired class="control-label">Categoria: </label>
                                                <?php

                                                // Consulta SQL para obtener los datos
                                                $consulta = "SELECT  INTIDCAT,STRNOMCAT FROM tblcatcat ORDER BY STRNOMCAT ASC";
                                                $resultado = mysqli_query($con, $consulta);


                                                // Crear el elemento select
                                                echo ' <select class="form-control categorias" name="categoria" id="categoria">';
                                                echo '  <option selected disabled > Seleccione una categoria</option>';

                                                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                                    // Iterar sobre los resultados y crear una opción para cada uno

                                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                                        echo '<option value="' . $fila['INTIDCAT'] . '"  <?php if($categoria= $fila["INTIDCAT"])  ?>   ' . $fila['STRNOMCAT'] . '</option>';
                                                    }
                                                } else {

                                                    echo  '<option value="" disabled  selected >No hay categorias en la  bd agregue datos </option>';
                                                }

                                                echo '</select>';
                                                ?>




                                            </div>
                                        </div>
                                        <div class="form-group">
                                           
                                            <div class="col-sm-6">
                                            <label for="subcategoria" class="control-label">Subcategoria: </label>
                                                <select class="form-control Subcategorias" name="Subcategoria" id="Subcategoria" required>

                                                    <option value="" selected desabled> seleccione una categoria primero</option>
                                                </select>
                                            </div>
                                        
                                           
                                            <div class="col-sm-6">
                                            <label for="precio" class=" control-label">Precio: </label>
                                                <input type="text" required class="form-control" id="precio" name="precio" placeholder="Precio" pattern="\d+" title="Por favor ingresa solo números positivos" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            

                                            <div class="col-sm-6">
                                            <label for="usuario" reuired class=" control-label">Unidad de medida : </label>
                                                <?php

                                                // Consulta SQL para obtener los datos
                                                $consulta = "SELECT  INTIDUNI,STRNOMUNI FROM tblcatuni ORDER BY STRNOMUNI ASC";
                                                $resultado = mysqli_query($con, $consulta);


                                                // Crear el elemento select
                                                echo ' <select class="form-control categorias" name="unidad" id="unidad">';

                                                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                                    // Iterar sobre los resultados y crear una opción para cada uno

                                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                                        echo '<option value="' . $fila['INTIDUNI'] . '"  <?php if($categoria= $fila["INTIDUNI"]) selected ?>   ' . $fila['STRNOMUNI'] . '</option>';
                                                    }
                                                } else {

                                                    echo  '<option value="" disabled  selected >No hay categorias en la  bd agregue datos </option>';
                                                }

                                                echo '</select>';
                                                ?>




                                            </div>
                                    
                                            

                                            <div class="col-sm-6">
                                            <label for="usuario" reuired class=" control-label">Tipo de uso: </label>
                                                <?php

                                                // Consulta SQL para obtener los datos
                                                $consulta = "SELECT  INTIDPUSO,STRNOMPUSO FROM tblcattus ORDER BY STRNOMPUSO ASC";
                                                $resultado = mysqli_query($con, $consulta);


                                                // Crear el elemento select
                                                echo ' <select class="form-control " name="INTIDPUSO" id="STRNOMPUSO">';

                                                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                                    // Iterar sobre los resultados y crear una opción para cada uno

                                                    while ($fila = mysqli_fetch_assoc($resultado)) {

                                                        echo '<option value="' . $fila['INTIDPUSO'] . '"  <?php if($categoria= $fila["INTIDPUSO"]) selected ?>   ' . $fila['STRNOMPUSO'] . '</option>';
                                                    }
                                                } else {

                                                    echo  '<option value="" disabled  selected >No hay tipos de uso en la  bd agregue datos </option>';
                                                }

                                                echo '</select>';
                                                ?>




                                            </div>
                                        </div>



                                        <div class="form-group">
                                           
                                            <div class="col-sm-12">
                                            <label for="estado" class=" control-label">Estado: </label>
                                                <select class="form-control col-sm-10" name="estado" id="estado" required>
                                                    <option value="1">Activo</option>
                                                    <option value="2">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="guardar_datos" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <!-- /end form  -->
            </div>
        </div>
    </div>
    <!-- End Form Modal -->