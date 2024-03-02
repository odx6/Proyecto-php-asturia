<?php if (in_array(1, $_SESSION['Habilidad']['Productos'])) { ?>
    <div class="modal fade" id="formModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Vehiculo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--inicio modal -->
                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="marca" class=" col-form-label">Marca: </label>
                                <input type="text" required class="form-control" id="STRMAR" name="STRMAR" placeholder="Marca: ">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="modelo" class=" col-form-label">Modelo: </label>
                                <input type="text" required class="form-control" id="STRMOD" name="STRMOD" placeholder="Modelo: ">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="placas" class=" col-form-label">Numero de Placas: </label>
                                <input type="text" required class="form-control" id="STRPLACAS" name="STRPLACAS" placeholder="Numero de placas : ">
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">

                    <div class="col-6">
                            <div class="form-group">
                                <label for="Tipo" class="col-form-label">Tipo: </label>
                                
                                <select class="form-control select2" name="STRTIPO" id="STRTIPO">
                                    <option value="1">Moto</option>
                                    <option value="2">Carro</option>
                                    <option value="2">motocarro</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="BITSUS" class="col-form-label">Estado: </label>
                                
                                <select class="form-control select2" name="BITSUS" id="BITSUS">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>

                        </div>
                    </div>








                    <!--end modal -->
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

    <?php } ?>