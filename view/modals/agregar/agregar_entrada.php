<!--<?php if (in_array(1, $_SESSION['Habilidad']['Entradas'])) { ?>

    <button class="btn btn-block btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick="resetForm()"><i class='fa fa-plus'></i> Nuevo</button>
-->
<!--<?php if (in_array(5, $_SESSION['Habilidad']['Entradas'])) { ?>

<button class="btn btn-danger" data-toggle="modal" data-target="#" onclick='exportpf("peticionajax")'><i class='fa fa-plus'></i>Exportar</button>

<?php } ?> -->
<!-- Form Modal -->

<!--modal nuevo -->
<div class="modal fade" id="formModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Entrada o Salida </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--inicia formulario -->
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register" enctype="multipart/form-data">


                    <input type="hidden" required class="form-control" id="IDEMP" name="IDEMP" placeholder="Folio:" value="<?php echo $id ?>">

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTIDTOP" required class="col-form-label">INTIDTOP: </label>
                                <?php

                                // Consulta SQL para obtener los datos
                                $consulta = "SELECT  INTIDTOP,STRNOMTPO FROM tblcattop ORDER BY STRNOMTPO ASC";
                                $resultado = mysqli_query($con, $consulta);


                                // Crear el elemento select
                                echo ' <select class="form-control select2 " name="INTIDTOP" id="INTIDTOP">';

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
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTTIPMOV" class=" col-form-label">Movimiento: </label>
                                <select class="form-control select2" name="INTTIPMOV" id="INTTIPMOV" required>
                                    <option value="1">Entrada</option>
                                    <option value="2">Salida</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTIDALM" reuired class="col-form-label">ALMACEN: </label>
                                <?php

                                // Consulta SQL para obtener los datos
                                $consulta = "SELECT  INTIDALM,STRNOMALM FROM tblcatalm ORDER BY STRNOMALM  ASC";
                                $resultado = mysqli_query($con, $consulta);


                                // Crear el elemento select
                                echo ' <select class="form-control select2" name="INTIDALM" id="INTIDALM">';

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
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTFOL" class=" col-form-label">Folio: </label>
                                <input type="text" required class="form-control is-invalid" id="INTFOL" name="INTFOL" placeholder="Folio: ">
                                <span id="MINTFOL"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="STROBS" class=" col-form-label">Descripcion: </label>
                                <input type="text" required class="form-control is-invalid" id="STROBS" name="STROBS" placeholder="Descripcion: ">
                                <span id="STROBS"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="STRREF" class=" col-form-label">Referencia: </label>

                                <input type="text" class="form-control is-invalid" id="STRREF" name="STRREF" placeholder="Referencia: ">
                                <span id="STRREF"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="columna" class=" col-form-label">Buscar: </label>
                            <select class="form-control select2  is-invalid columna" name="columna" id="columna" required style="margin-bottom: 5px;">
                                <option value="STRSKU">SKU</option>
                                <option value="STRCOD">Codigo</option>
                                <option value="STRDES">Descripcion</option>

                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="INTTIPMOV" class=" col-form-label">por</label>

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar por nombre" id="campo" onkeyup="mostrarProductos()">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick='mostrarProductos()'><i class='fa fa-search'></i></button>
                                </span>



                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="INTCAN" class=" col-form-label">Cantidad</label>

                            <input type="number" class="form-control" id="INTCAN" name="INTCAN" placeholder="cantidad: ">
                            <span id="MINTCAN"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">


                        <div class="col-sm-12">
                            <select multiple size="10" class="form-control" id="outproduct" style="margin-bottom: 5px;">
                                <option disabled>Ninguna busqueda</option>
                            </select>

                        </div>
                        <div class="cpl-sm-12 modal-footer">

                            <button type="button" class="btn btn-warning" onclick="agregarInventario()">Agregar <i class="fa fa-plus"></i></button>
                           
                            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Agregar Producto <i class="fa fa-plus"></i></button>
                        </div>

                    </div>


                    <div class="col-sm-12">


                        <div class="col-sm-12">
                            <table class="table table-bordered" id="miTabla">
                                <caption>Productos Agregados</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">Indice</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">ref.</th>
                                        <th scope="col">cant.</th>
                                        <th scope="col">pre.</th>

                                        <th scope="col">tot./u</th>
                                        <th scope="col">Accion</th>

                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                                <label for="MONCTOPRO" class=" col-form-label">Total</label>

                                <input type="number" required class="form-control static" id="MONCTOPRO" name="MONCTOPRO" placeholder="Total: " readonly>




                            </div>

                            <div class="col-6">
                                <label for="Count" class=" col-form-label">Total de productos</label>
                          
                            <input type="number" required class="form-control static" id="Count" name="Count" placeholder="Total: " readonly>
                        </div>


                    </div>


            </div>
            <!--end form -->
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="guardar_datos"  class="btn btn-primary">Guardar</button>
        </div>
                            </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<?php } ?>

<?php if (in_array(1, $_SESSION['Habilidad']['Entradas'])) { ?>
<!--end modal nuevo -->
<div class="modal fade" id="formModale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- form  -->
            <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Entrada o Salida</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" required class="form-control" id="IDEMP" name="IDEMP" placeholder="Folio:" value="<?php echo $id ?>">
                    <div class="col-sm-12">

                        <div class="col-sm-4">
                            <label for="INTIDTOP" reuired class="col-form-label">INTIDTOP: </label>
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
                            <label for="INTTIPMOV" class=" col-form-label">Movimiento: </label>
                            <select class="form-control col-sm-10" name="INTTIPMOV" id="INTTIPMOV" required>
                                <option value="1">Entrada</option>
                                <option value="2">Salida</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="INTIDALM" reuired class="col-form-label">ALMACEN: </label>
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
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label for="INTFOL" class=" col-form-label">Folio: </label>
                            <input type="text" required class="form-control" id="INTFOL" name="INTFOL" placeholder="Folio: ">
                            <span id="MINTFOL"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="STROBS" class=" col-form-label">Descripcion: </label>
                            <input type="text" required class="form-control" id="STROBS" name="STROBS" placeholder="Descripcion: ">
                            <span id="STROBS"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <label for="columna" class=" col-form-label">Buscar: </label>
                            <select class="form-control col-sm-10 columna" name="columna" id="columna" required style="margin-bottom: 5px;">
                                <option value="STRSKU">SKU</option>
                                <option value="STRCOD">Codigo</option>
                                <option value="STRDES">Descripcion</option>

                            </select>
                            <div>
                                <label for="STRREF" class=" col-form-label">Referencia: </label>

                                <input type="text" class="form-control" id="STRREF" name="STRREF" placeholder="Referencia: ">
                                <span id="STRREF"></span>

                            </div>




                        </div>
                        <div class="col-sm-6">
                            <label for="INTTIPMOV" class=" col-form-label">por</label>

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar por nombre" id="campo" onkeyup="mostrarProductos()">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick='mostrarProductos()'><i class='fa fa-search'></i></button>
                                </span>



                            </div>
                            <label for="INTCAN" class=" col-form-label">Cantidad</label>

                            <input type="number" class="form-control" id="INTCAN" name="INTCAN" placeholder="cantidad: ">
                            <span id="MINTCAN"></span>


                        </div>
                        <div class="col-sm-12">
                            <select multiple size="10" class="form-control" id="outproduct" style="margin-bottom: 5px;">
                                <option disabled>Ninguna busqueda</option>
                            </select>

                        </div>
                        <div class="cpl-sm-12 modal-footer">

                            <button type="button" class="btn btn-warning" onclick="agregarInventario()">Agregar <i class="fa fa-plus"></i></button>
                        </div>

                    </div>


                    <div class="col-sm-12">


                        <div class="col-sm-12">
                            <table class="table caption-top" id="miTabla">
                                <caption>Productos Agregados</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">Indice</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">ref.</th>
                                        <th scope="col">cant.</th>
                                        <th scope="col">pre.</th>

                                        <th scope="col">tot./u</th>
                                        <th scope="col">Accion</th>

                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>

                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <label for="MONCTOPRO" class=" col-form-label">Total</label>
                            </div>
                            <div class="col-sm-6"><input type="number" required class="form-control static" id="MONCTOPRO" name="MONCTOPRO" placeholder="Total: " readonly>
                            </div>



                        </div>
                        <div class="col-sm-6">

                            <div class="col-sm-6">
                                <label for="Count" class=" col-form-label">Total de productos</label>
                            </div>
                            <div class="col-sm-6"><input type="number" required class="form-control static" id="Count" name="Count" placeholder="Total: " readonly>
                            </div>

                            <br>

                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top: 15px;">Cancelar</button>
                    <button type="submit" id="guardar_datos" class="btn btn-primary" style="margin-top: 15px;">Guardar</button>
                </div>
            </form>
            <!-- /end form  -->
        </div>
    </div>
</div>
<!-- End Form Modal -->
<?php } ?>