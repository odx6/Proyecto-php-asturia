<?php if (in_array(1, $_SESSION['Habilidad']['proveedores'])) { ?>
    <div class="modal fade" id="formModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fas fa-parachute-box"></i> Nuevo Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="RFC" class=" col-form-label">RFC: </label>
                                    <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group"> <label for="Nombre" class=" col-form-label">Nombre: </label>
                                    <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="Domicilio" class=" col-form-label">Domicilio: </label>
                                    <input type="text" required class="form-control" id="STRDOM" name="STRDOM" placeholder="Domicilio: ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group"><label for="Telefono" class=" col-form-label">Telefono: </label>
                                    <input type="text" required class="form-control" id="STRTEL" name="STRTEL" placeholder="Telefono">
                                </div>
                            </div>
                            <div class="col-4">


                                <div class="form-group">
                                    <label for="STRNUMCUN" class=" col-form-label">Numero de cuenta: </label>
                                    <input type="text" required class="form-control" id="STRNUMCUN" name="STRNUMCUN" placeholder="STRNUMCUN: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group"><label for="STRNOMBAN" class=" col-form-label">Nombre del banco: </label>
                                    <input type="text" required class="form-control" id="STRNOMBAN" name="STRNOMBAN" placeholder="nombre del banco: ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                <label for="STRCONT" class=" col-form-label">Contacto: </label>
                                    <input type="text" required class="form-control" id="STRCONT" name="STRCONT" placeholder="contacto: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group"><label for="STRCOR" class=" col-form-label">email: </label>
                                    <input type="email" required class="form-control" id="STRCOR" name="STRCOR" placeholder="correo electronico: ">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                <label for="estado" class="col-form-label">Estado: </label>
                                <select class="form-control select2" name="BITSUS" id="BITSUS">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
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
<?php } ?>