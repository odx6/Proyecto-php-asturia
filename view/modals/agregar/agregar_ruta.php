<?php if (in_array(1, $_SESSION['Habilidad']['Rutas'])) { ?>
    <div class="modal fade" id="formModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> <i class='fas fa-route'></i> Nueva Ruta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="NOMBRE" class=" col-form-label">NOMBRE: </label>
                                    <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="NOMBRE: ">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group"> <label for="KILOMETROS AUTORIZADOS" class=" col-form-label">KILOMETROS AUTORIZADOS: </label>
                                    <input type="number" required class="form-control" id="DOUKM" name="DOUKM" placeholder="KILOMETROS AUTORIZADOS: ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"> <label for="LITROS AUTORIZADOS" class=" col-form-label">LITROS AUTORIZADOS: </label>
                                    <input type="number" required class="form-control" id="DOULTS" name="DOULTS" placeholder="LITROS AUTORIZADOS: ">
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