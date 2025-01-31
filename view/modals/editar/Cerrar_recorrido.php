<!-- Form Modal -->
<?php if (in_array(3, $_SESSION['Habilidad']['Kilometraje'])) { ?>
    
    <!-- /.modal -->

    <div class="modal fade" id="modal_recorrido">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Terminar  Recorrido </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" id="update_recorrido" name="update_recorrido" >
                        <div id="loader2" class="text-center"></div>
                        <div class="outer_div2"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                    <button type="submit" id="actualizar_datos_recorrido" class="btn btn-danger">Terminar</button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


<?php } ?>