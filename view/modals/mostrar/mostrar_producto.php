<!-- Form Modal -->
<?php if (in_array(4, $_SESSION['Habilidad']['Productos'])) { ?>
  
  <!-- /.modal -->

  <div class="modal fade"id="modal_show">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #343a40;">
              <h4 class="modal-title"  style="color:white;" >Datos Del producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
            <div id="loader3" class="text-center"></div>
                <div class="outer_div3"></div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php } ?>
<!-- End Form Modal -->