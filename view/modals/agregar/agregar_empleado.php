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
                        <h4 class="modal-title" id="myModalLabel"> Nuevo Empleado</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="dni" class="col-sm-2 control-label">NSS: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRNSS" name="STRNSS" placeholder="NSS: " pattern="^(\d{2})(\d{2})(\d{2})\d{5}$" title="El NSS debe tener 11 dígitos." onchange="validarExistencia(this.value,'tblcatemp','STRNSS')">
                                <span id="MSTRNSS"></span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="nombre" class="col-sm-2 control-label">RFC: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: " pattern="^([A-ZÑ&]{3,4})(\\d{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z|\\d]{3})$" onchange="validarExistencia(this.value,'tblcatemp','STRRFC')">
                                <span id="MSTRRFC"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="col-sm-2 control-label">CURP: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRCUR" name="STRCUR" placeholder="CURP: " onchange="validarExistencia(this.value,'tblcatemp','STRCUR')">
                                <span id="MSTRCUR"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usuario" class="col-sm-2 control-label">Nombre: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Apellidos: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRAPE" name="STRAPE" placeholder="Apellidos: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Domicilio: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRDOM" name="STRDOM" placeholder="Domicilio">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="localidad" class="col-sm-2 control-label">Localidad: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRLOC" name="STRLOC" placeholder="Localidad: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="col-sm-2 control-label">Municipio</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRMUN" name="STRMUN" placeholder="Municipio">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="celular" class="col-sm-2 control-label">Estado: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STREST" name="STREST" placeholder="Estado: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registro" class="col-sm-2 control-label">Codigo Postal: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRCP" name="STRCP" placeholder="Codigo: ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="registro" class="col-sm-2 control-label">Pais: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="STRPAI" name="STRPAI" placeholder="Pais: " required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registro" class="col-sm-2 control-label">Telefono: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="STRTEL" name="STRTEL" placeholder="Telefono: " required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registro" class="col-sm-2 control-label">Correo Electronico: </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="STRCOR" name="STRCOR" placeholder="Email: " onchange="validarExistencia(this.value,'tblcatemp','STRCOR')" required>
                                <span id="MSTRCOR"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registro" class="col-sm-2 control-label">Contraseña: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="STRPWS" name="STRPWS" placeholder="Contraseña: " required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registro" class="col-sm-2 control-label">Imagen: </label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="STRIMG" name="STRIMG" placeholder="imagen: ">
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

                        <div class="form-group">
                            <label for="permisos" class="col-sm-2 control-label">Permisos: </label>
                            <div class="col-sm-10">
                                <ul style="list-style: none;" id="permisos">
                                    <?php
                                    require_once("config/config.php");
                                    $rspta = mysqli_query($con, "SELECT * FROM permisos");
                                    $id = 0;
                                    $marcados = mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$id");
                                    $valores = array();
                                    while ($per = $marcados->fetch_object()) {
                                        array_push($valores, $per->idpermiso);
                                    }
                                    while ($reg = $rspta->fetch_object()) {
                                        $sw = in_array($reg->id, $valores) ? 'checked' : '';
                                        echo '<li> <input id="permisos" type="checkbox" ' . $sw . '  name="permisos[]" value="' . $reg->id . '">' . $reg->nombre . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

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