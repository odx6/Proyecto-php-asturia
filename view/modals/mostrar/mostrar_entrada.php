<?php if(in_array(4,$_SESSION['Habilidad']['Entradas'])){ ?>

<!-- Form Modal -->
<div class="modal fade" id="modal_show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <form class="form-horizontal" role="form">
        <div class="modal-content">
            <div class="modal-header" style="background:#0d5e4e;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="color:white;"> Datos Del Inventario</h4>
            </div>
            <div class="modal-body">
                <div id="loader3" class="text-center"></div>
                <div class="outer_div3" id="printentrada"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                
                
                

                
            </div>
        </div>


   
    </div>
</div>
<!-- End Form Modal -->
<?php } ?>