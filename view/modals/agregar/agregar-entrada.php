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
                    <h4 class="modal-title" id="myModalLabel">Agregar Entrada o Salida</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">

                        <input type="hidden" required class="form-control" id="IDEMP" name="IDEMP" placeholder="Folio:" value="<?php echo $id ?>">
                        <div class="col-sm-4">
                            <label for="usuario" reuired class="control-label">INTIDTOP: </label>
                            <?php

                            // Consulta SQL para obtener los datos
                            $consulta = "SELECT  INTIDTOP,STRNOMTPO FROM tblcattop ORDER BY STRNOMTPO ASC";
                            $resultado = mysqli_query($con, $consulta);


                            // Crear el elemento select
                            echo ' <select class="form-control " name="INTIDTOP" id="INTIDTOP">';

                            if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                // Iterar sobre los resultados y crear una opción para cada uno

                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo '<option value="' . $fila['INTIDTOP'] . '"  <?php if($INTIDTOP= $fila["INTIDTOP"]) selected ?>   ' . $fila['STRNOMTPO'] . '</option>';
                                }
                            } else {

                                echo  '<option value="" disabled  selected >No hay TBLCATTOP  bd agregue datos </option>';
                            }

                            echo '</select>';
                            ?>


                        </div>


                        <div class="col-sm-4">
                            <label for="INTTIPMOV" class=" control-label">Movimiento: </label>
                            <select class="form-control col-sm-10" name="INTTIPMOV" id="INTTIPMOV" required>
                                <option value="1">Entrada</option>
                                <option value="2">Salida</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="usuario" reuired class="control-label">ALMACEN: </label>
                            <?php

                            // Consulta SQL para obtener los datos
                            $consulta = "SELECT  INTIDALM,STRNOMALM FROM tblcatalm ORDER BY STRNOMALM  ASC";
                            $resultado = mysqli_query($con, $consulta);


                            // Crear el elemento select
                            echo ' <select class="form-control " name="INTIDALM" id="INTIDALM">';

                            if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                // Iterar sobre los resultados y crear una opción para cada uno

                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo '<option value="' . $fila['INTIDALM'] . '"  <?php if($INTIDALM= $fila["INTIDALM"]) selected ?>   ' . $fila['STRNOMALM'] . '</option>';
                                }
                            } else {

                                echo  '<option value="" disabled  selected >No hay datos de almacen en la base de datos registre nuevos </option>';
                            }

                            echo '</select>';
                            ?>


                        </div>






                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="INTFOL" class="col-sm-2 control-label">Folio: </label>
                            <input type="text" required class="form-control" id="INTFOL" name="INTFOL" placeholder="Folio: ">
                            <span id="MINTFOL"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="STROBS" class=" control-label">Descripcion: </label>
                            <input type="text" required class="form-control" id="STROBS" name="STROBS" placeholder="Descripcion: ">
                            <span id="STROBS"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-6">
                            <label for="INTTIPMOV" class=" control-label">Buscar: </label>
                            <select class="form-control col-sm-10 INTTIPMOV" name="INTTIPMOV" id="INTTIPMOV" required>
                                <option value="STRSKU">SKU</option>
                                <option value="STRCOD">Codigo</option>
                                <option value="STRDES">Descripcion</option>

                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="INTTIPMOV" class=" control-label">por</label>

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar por nombre" id="campo" onkeyup="mostrarProductos()">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick='mostrarProductos()'><i class='fa fa-search'></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </div><!-- /input-group -->
                        <div class="col-sm-12">
                            <select multiple size="20" class="form-control" onclick="agregarInventario()" id="outproduct">
                                <option> <strong>hola</strong>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>

                        </div>
                    </div>


                    <div class="col-sm-6">


                        <div class="col-sm-12">
                            <table class="table caption-top" id="miTabla">
                                <caption>Productos Agregados</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">SKU</th>
                                        <th scope="col">precio</th>
                                        <th scope="col">cantidad</th>
                                        <th scope="col">referencia</th>
                                        <th scope="col">total</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>

                                            <input type="text" required class="form-control" id="STRDESSBC" name="STRDESSBC" placeholder="Descripcion: ">


                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
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