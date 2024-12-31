<?php
$active8 = "active";

if ($_SESSION['productos'] == 1) {
     (in_array(1,$_SESSION['Habilidad']['Kilometraje']))? $agregar='modals/agregar/agregar_recorrido.php':'';
     (in_array(2,$_SESSION['Habilidad']['Kilometraje']))? $editar="modals/editar/editar_template.php":'';
     (in_array(4,$_SESSION['Habilidad']['Kilometraje']))? $mostrar="modals/mostrar/mostrar_template.php":'';
     (in_array(1,$_SESSION['Habilidad']['Kilometraje']))? $agregarTicket="modals/agregar/agregar_ticket.php":'';
     (in_array(2,$_SESSION['Habilidad']['Kilometraje']))? $editarTicket="modals/editar/editar_ticket.php":'';
    
    $TitleModal="Editar consumo de kilometraje";

    $TitleModalShow="<i class='fas fa-car'></i> Datos de consumo ";
    $Titulo = "Control de kilometraje";
    $url = "Kilometraje";
    $icon = '<i class="fas fa-car"></i>';
    $modals = 'include "modals/agregar/agregar_recorrido.php"';

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
            url:'view/ajax/kilometraje_ajax.php',
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
        url: 'view/ajax/agregar/agregar_recorrido.php',
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
    //agregar ticket
    $('#new_register_ticket').submit(function(event) {
    event.preventDefault();
    $('#guardar_datos_ticket').attr('disabled', true);
    var parametros = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: 'view/ajax/agregar/agregar_ticket.php',
        data: parametros,
        beforeSend: function(objeto) {
            $('#resultados_ajax').html('Enviando...');
        },
        success: function(datos) {

            $('.resultados_ajax').html(datos);
            $('#guardar_datos_ticket').attr('disabled', false);
             load();
            window.setTimeout(function() {
                $('.alert').fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
            $('#ticket_modal').modal('hide');
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
                url: 'view/ajax/editar/editar_recorrido.php',
                data: parametros,
                beforeSend: function(objeto) {
                    $('.resultados_ajax').html('Enviando...');
                },
                success: function(datos) {
                    $('.resultados_ajax').html(datos);
                    $('#actualizar_datos').attr('disabled', false);
                    load();
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
          $('#update_register_ticket').submit(function(event) {
            $('#actualizar_datos_ticket').attr('disabled', true);
            var parametros = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'view/ajax/editar/editar_ticket.php',
                data: parametros,
                beforeSend: function(objeto) {
                    $('.resultados_ajax').html('Enviando...');
                },
                success: function(datos) {
                    $('.resultados_ajax').html(datos);
                    $('#actualizar_datos_ticket').attr('disabled', false);
                     load();
                    window.setTimeout(function() {
                        $('.alert').fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                    $('#modal_update_ticket').modal('hide');
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
