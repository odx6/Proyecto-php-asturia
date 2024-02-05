<?php if (in_array(1, $_SESSION['Habilidad']['Unidades'])) { ?>

    <div class="modal fade" id="formModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Unidad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register">


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="dni" class="col-form-label">Nombre : </label>
                                    <input type="text" required class="form-control" id="STRNOMUNI" name="STRNOMUNI" placeholder="Nombre Unidad:">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="estado" class="col-form-label">Estado: </label>
                                    <select class="form-control" name="BITSUS" id="BITSUS">
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nombre" class="col-form-label">Descripcion: </label>
                                    <input type="text" required class="form-control" id="STRDESUNI" name="STRDESUNI" placeholder="Descripcion: ">
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

    <!-- /.modal -->






<?php } ?>
<!--<button class="btn btn-primary" data-toggle="modal" data-target="#formModal" onclick="resetForm()"><i class='fa fa-plus'></i> Nuevo</button>-->
<?php if (in_array(5, $_SESSION['Habilidad']['Unidades'])) { ?>

    <!--<button class="btn btn-danger" data-toggle="modal" data-target="#" onclick='exportpf("peticionajax")'><i class='fa fa-plus' ></i>Exportar</button>-->
<?php } ?>


<!-- Form Modal -->
<div class="modal fade" id="formModale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" enctype="multipart/form-data">
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
                        <label for="dni" class="col-form-label">Nombre : </label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="STRNOMUNI" name="STRNOMUNI" placeholder="Nombre Unidad:">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-form-label">Descripcion: </label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" id="STRDESUNI" name="STRDESUNI" placeholder="Descripcion: ">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estado" class="col-form-label">Estado: </label>
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