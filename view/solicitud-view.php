<?php
$active2 = "active";
include "resources/header copy.php";
if ($_SESSION['solicitud'] == 1) {
?>
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fab fa-wpforms"></i>Solicitud</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Solicitud</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>





        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                    <?php 
                            include "modals/agregar/solicitud/agregar_solicitud.php";
                            include "modals/editar/editar_solicitud.php";
                            include "modals/mostrar/mostrar_solicitud.php";
                        ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fab fa-wpforms"></i> Lista de solicitudes</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">
                                <div class="resultados_ajax"></div>
                                <div class="outer_div"></div>

                                
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

        <?php
        include "resources/footer.php";
        ?>
       

    <!--funcion buscar en la vista -->
    <script>
        $(function() {
            load(1,'solicitud','view/ajax/Mostrar_Solicitudes_ajax.php');
        });
    </script>
   
    <script>
        $("#new_register").submit(function(event) {
            $('#guardar_datos').attr("disabled", true);
            var parametros = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "view/ajax/Solicitud/agregar_solicitud.php",
                data: parametros,
                beforeSend: function(objeto) {
                    $("#resultados_ajax").html("Enviando...");
                },
                success: function(datos) {
                    $(".resultados_ajax").html(datos);
                    $('#guardar_datos').attr("disabled", false);
                    load(1,'solicitud','view/ajax/Mostrar_Solicitudes_ajax.php');
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function() {
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
        $("#update_register").submit(function(event) {
            $('#actualizar_datos').attr("disabled", true);
            var parametros = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "view/ajax/editar/editar_solicitud.php",
                data: parametros,
                beforeSend: function(objeto) {
                    $("#resultados_ajax").html("Enviando...");
                },
                success: function(datos) {
                    $(".resultados_ajax").html(datos);
                    $('#actualizar_datos').attr("disabled", false);
                    load(1,'solicitud','view/ajax/Mostrar_Solicitudes_ajax.php');
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                    $('#modal_update').modal('hide');
                }
            });
            event.preventDefault();
        });
    </script>
<?php
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
?>