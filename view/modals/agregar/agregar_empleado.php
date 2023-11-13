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
                                <input type="text" required class="form-control" id="STRNSS" name="STRNSS" placeholder="NSS: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="col-sm-2 control-label">RFC: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="col-sm-2 control-label">CURP: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRCUR" name="STRCUR" placeholder="CURP: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usuario" class="col-sm-2 control-label">Nombre: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Apellidos: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="STRAPE" name="STRAPE" placeholder="Apellidos: ">
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
                                <input type="text" class="form-control" id="STRLOC" name="STRLOC" placeholder="Localidad: ">
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
                                <input type="text" class="form-control" id="STRCP" name="STRCP" placeholder="Codigo: ">
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