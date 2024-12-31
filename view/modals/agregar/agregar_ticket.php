<?php


 if (in_array(1, $_SESSION['Habilidad']['Kilometraje'])) { 
   

   
    ?>


    <div class="modal fade" id="ticket_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo ticket para recorrido  </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" id="new_register_ticket" name="new_register_ticket">
                <input type="hidden" required  id="STRPRE" name="STRPRE" ">    
                <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTNO" class="col-form-label">N°.ticket: </label>
                                <input type="text" required class="form-control" id="INTNO" name="INTNO" placeholder="N°.ticket : ">
                                
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="PCRXLIT" class="col-form-label">Preciopor litro : </label>
                                <input type="number" required class="form-control" id="PCRXLIT" name="PCRXLIT" placeholder="precio : ">
                            </div>
                        </div>
                        <div class="col-4">
                        <div class="form-group">
                                <label for="" class="col-form-label">N°Litros : </label>
                                <input type="number" required class="form-control" id="LTS" name="LTS" placeholder="litros : ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="Localidad" class="col-form-label">Localidad: </label>
                                <input type="text" required class="form-control" id="LOC" name="LOC" placeholder="Localidad: ">
                            </div>


                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="guardar_datos_ticket" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<?php } ?>