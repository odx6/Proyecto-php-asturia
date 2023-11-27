<button class="btn btn-primary" data-toggle="modal" data-target="#formModal"><i class='fa fa-plus'></i> Nuevo</button>
    <button class="btn btn-danger" data-toggle="modal" data-target="#" onclick='exportpf("peticionajax")'><i class='fa fa-plus' ></i>Exportar</button>


    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- form  -->
            <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> Nueva Unidad</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dni" class="col-sm-2 control-label">Nombre : </label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="STRNOMUNI" name="STRNOMUNI" placeholder="Nombre Unidad:">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Descripcion: </label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="STRDESUNI" name="STRDESUNI" placeholder="Descripcion: ">
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