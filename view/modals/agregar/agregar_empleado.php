    <button class="btn btn-primary" data-toggle="modal" data-target="#formModal" onclick="resetForm()"><i class='fa fa-plus'></i> Nuevo</button>
    <button class="btn btn-danger" data-toggle="modal" data-target="#" onclick='exportpf("peticionajax")'><i class='fa fa-plus'></i>Exportar</button>


    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- form  -->
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"> Nuevo Empleado</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-4">
                            <img src="view/resources/images/Default/perfil.png" alt="..." class="img-circle EverCambio">
                            <br>
                            <label for="registro" class=" control-label">Imagen: </label>
                            <input type="file" class="form-control validarBtn" id="STRIMG" name="STRIMG" placeholder="imagen: ">

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="permisos" class=" control-label">Permisos: </label>
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
                        <div class="row g-2">
                            <div class="col-sm">
                                <div class="form-group">

                                    <div class="col-sm-3">
                                        <label for="STRNSS" class=" control-label">NSS: </label>
                                        <input type="text" required class="form-control" id="STRNSS" name="STRNSS" placeholder="NSS: " pattern="^(\d{2})(\d{2})(\d{2})\d{5}$" title="El NSS debe tener 11 dígitos." onchange="validarExistencia(this.value,'tblcatemp','STRNSS')">
                                        <span id="MSTRNSS"></span>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="STRRFC" class=" control-label">RFC: </label>
                                        <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: " onchange="validarExistencia(this.value,'tblcatemp','STRRFC')">
                                        <span id="MSTRRFC"></span>
                                    </div>


                                    <div class="col-sm-3">
                                        <label for="apellido" class=" control-label">CURP: </label>
                                        <input type="text" required class="form-control" id="STRCUR" name="STRCUR" placeholder="CURP: " onchange="validarExistencia(this.value,'tblcatemp','STRCUR')">
                                        <span id="MSTRCUR"> </span>
                                    </div>


                                    
                                   

                                </div>
                                <div class="form-group">
                                <div class="col-sm-4">
                                        <label for="usuario" class=" control-label">Nombre: </label>
                                        <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios">
                                    </div>
                                <div class="col-sm-4">
                                        <label for="email" class=" control-label">Apellidos: </label>
                                        <input type="text" required class="form-control" id="STRAPE" name="STRAPE" placeholder="Apellidos: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="registro" class=" control-label">Telefono: </label>
                                        <input type="text" class="form-control" id="STRTEL" name="STRTEL" placeholder="Telefono: " required>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="localidad" class=" control-label">Localidad: </label>
                                        <input type="text" required class="form-control" id="STRLOC" name="STRLOC" placeholder="Localidad: ">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="telefono" class=" control-label">Municipio</label>
                                        <input type="text" required class="form-control" id="STRMUN" name="STRMUN" placeholder="Municipio">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="celular" class=" control-label">Estado: </label>
                                        <input type="text" required class="form-control" id="STREST" name="STREST" placeholder="Estado: ">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="password" class=" control-label">Domicilio: </label>
                                        <input type="text" required class="form-control" id="STRDOM" name="STRDOM" placeholder="Domicilio">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="registro" class=" control-label">Codigo Postal: </label>
                                        <input type="text" required class="form-control" id="STRCP" name="STRCP" placeholder="Codigo: ">
                                    </div>


                                    <div class="col-sm-4">
                                        <label for="registro" class=" control-label">Pais: </label>
                                        <input type="text" class="form-control" id="STRPAI" name="STRPAI" placeholder="Pais: " required>
                                    </div>

                                </div>

                            </div>

                            <div class="col-sm">

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="registro" class=" control-label">Correo Electronico: </label>
                                        <input type="email" class="form-control" id="STRCOR" name="STRCOR" placeholder="Email: " onchange="validarExistencia(this.value,'tblcatemp','STRCOR')" required>
                                        <span id="MSTRCOR"> </span>
                                    </div>


                                    <div class="col-sm-4">
                                        <label for="registro" class=" control-label">Contraseña: </label>
                                        <input type="password" class="form-control" id="STRPWS" name="STRPWS" placeholder="Contraseña: " required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="estado" class=" control-label">Estado: </label>
                                        <select class="form-control" name="BITSUS" id="BITSUS">
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
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