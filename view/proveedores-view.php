<?php
$active8 = "active";


if ($_SESSION['proveedores'] == 1) {
    (in_array(1,$_SESSION['Habilidad']['proveedores']))? $agregar='modals/agregar/agregar_proveedor.php':$agregar='';
     (in_array(2,$_SESSION['Habilidad']['proveedores']))? $editar="modals/editar/editar_template.php":$editar='';
     (in_array(4,$_SESSION['Habilidad']['proveedores']))? $mostrar="modals/mostrar/mostrar_template.php":$mostrar='';
    $TitleModal="Editar proveedor";
    $TitleModalShow="<i class='fas fa-car'></i> Datos del proveedor";
    $Titulo = "Proveedores";
    $url = "Provedores";
    $icon = '<i class="fas fa-parachute-box"></i>';
    $modals = 'include "modals/agregar/agregar_vehiculo.php"';

    $scripts = "<script>
    $(function() {
        load();
       
        
    });
 function load(){
    var page=1;
        var query='';
        var per_page='';
        var parametros = {'action':'ajax','page':page,'query':query,'per_page':per_page};
        $('#loader').fadeIn('slow');
        $.ajax({
            url:'view/ajax/proveedores_ajax.php',
            data: parametros,
             beforeSend: function(objeto){
           // $('#loader').html('<img src='./assets/img/ajax-loader.gif'>');
          },
            success:function(data){
                $('.outer_div').html(data).fadeIn('slow');
                $('#loader').html('');
                renderTable();
            }
        })
    }

    //agregar vehiculo
  

</script> <script>
$('#new_register').submit(function(event) {
    event.preventDefault();
    $('#guardar_datos').attr('disabled', true);
    var parametros = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: 'view/ajax/agregar/agregar_proveedor.php',
        data: parametros,
        beforeSend: function(objeto) {
            $('#resultados_ajax').html('Enviando...');
        },
        success: function(datos) {

            $('.resultados_ajax').html(datos);
            $('#guardar_datos').attr('disabled', false);
             load();
            window.setTimeout(function() {
                $('.alert').fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
            $('#formModal').modal('hide');
        }
    });
    event.preventDefault();
})
</script>
<script>
        //Boton Actualizar desde modal editar
        $('#update_register').submit(function(event) {
            $('#actualizar_datos').attr('disabled', true);
            var parametros = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'view/ajax/editar/editar_proveedor.php',
                data: parametros,
                beforeSend: function(objeto) {
                    $('.resultados_ajax').html('Enviando...');
                },
                success: function(datos) {
                    $('.resultados_ajax').html(datos);
                    $('#actualizar_datos').attr('disabled', false);
                    //load(1,'tblcatmov','view/ajax/proveedores_ajax.php');
                    window.setTimeout(function() {
                        $('.alert').fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                    $('#modal_update').modal('hide');
                }
            });
            event.preventDefault();
        });
    </script>

";
   

   include "Template.php";
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
?>
