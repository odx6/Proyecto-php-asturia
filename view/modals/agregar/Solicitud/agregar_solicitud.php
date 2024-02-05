<?php if (in_array(1, $_SESSION['Habilidad']['Solicitud'])) { ?>
   
    <!-- Form Modal -->
    <div class="modal fade" id="formModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                    <input type="hidden" required class="form-control" id="IDEMPLEADO" name="IDEMPLEADO" placeholder="EMPLEADO: " value="<?php if (isset($id)) echo   $id ?>">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="sku" class="col-sm-2 control-label"> Orden: </label>
                                <input type="text" required class="form-control" id="IDORDEN" name="IDORDEN" placeholder="Id de Orden: ">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="sku" class="col-sm-2 control-label">No.Folio: </label>
                                <input type="text" required class="form-control" id="Folio" name="Folio" placeholder="Folio: ">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="codigo" class="col-sm-2 control-label">Operador: </label>
                                <input type="text" required class="form-control" id="Operador" name="Operador" placeholder="Operador: ">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="descripcion" class="col-sm-2 control-label">No.Carro: </label>
                                <input type="text" required class="form-control" id="Carro" name="Carro" placeholder="No.Carro: ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="categoria" class="col-sm-2 control-label">Kilometraje: </label>
                                <input type="text" required class="form-control" id="Kilometraje" name="Kilometraje" placeholder="Kilometraje: ">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="subcategoria" class="col-sm-2 control-label">No.placas: </label>
                                <input type="text" required class="form-control" id="Placas" name="Placas" placeholder="Placas: ">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="precio" class="col-sm-2 control-label">Detalles: </label>
                                <input type="text" required class="form-control" id="Detalles" name="Detalles" placeholder="Detalles">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="unidad" class="col-sm-2 control-label">Observaciones: </label>
                                <input type="text" class="form-control" id="Observaciones" name="Observaciones" placeholder="Observaciones: ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="guardar_datos" class="btn btn-primary">Guardar</button>
                </div>
    </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



    <div class="modal fade" id="formModale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- form  -->
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"> Nuevo Solicitud</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sku" class="col-sm-2 control-label">Ide Orden: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="IDORDEN" name="IDORDEN" placeholder="Id de Orden: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label for="sku" class="col-sm-2 control-label">Ide Empleado: </label>-->
                            <div class="col-sm-10">
                                <input type="hidden" required class="form-control" id="IDEmpleado" name="IDEMPLEADO" placeholder="EMPLEADO: " value="<?php if (isset($id)) echo   $id ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sku" class="col-sm-2 control-label">No.Folio: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Folio" name="Folio" placeholder="Folio: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="codigo" class="col-sm-2 control-label">Operador: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Operador" name="Operador" placeholder="Operador: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label">No.Carro: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Carro" name="Carro" placeholder="No.Carro: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoria" class="col-sm-2 control-label">Kilometraje: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Kilometraje" name="Kilometraje" placeholder="Kilometraje: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subcategoria" class="col-sm-2 control-label">No.placas: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Placas" name="Placas" placeholder="Placas: ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precio" class="col-sm-2 control-label">Detalles del servicio: </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="Detalles" name="Detalles" placeholder="Detalles">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidad" class="col-sm-2 control-label">Observaciones: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Observaciones" name="Observaciones" placeholder="Observaciones: ">
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
<?php } ?>