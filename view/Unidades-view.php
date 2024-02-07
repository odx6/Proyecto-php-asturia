<?php
$active2 = "active";
include "resources/header copy.php";
if ($_SESSION['unidades'] == 1) {
?>

 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Entradas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Entradas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
              
                <div id="resultados_ajax"></div>
                    
                   
             
                    <div class="col-12">


                        <div class="card">
                            
                            
                            <div class="card-header">
                            <div class="col-sm-8"><h3 class="card-title">Lista de entradas</h3></div>
                            <div class="col-sm-4">

                            <?php 
                            include "modals/agregar/agregar_unidad.php";
                            include "modals/editar/editar_unidad.php";
                            include "modals/mostrar/mostrar_unidad.php";
                        ?>
                            </div>
                                <!-- modals -->
                      
                    <!-- /end modals -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body outer_div">
                                
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
  
    <script>
       

        $(function() {
            load(1);
        });
        function load(page) {
            var query = $("#q").val();
            var per_page = $("#per_page").val();
            var query = "";
            var per_page = 100;
            var parametros = {
                "action": "ajax",
                "page": page,
                'query': query,
                'per_page': per_page
            };
            $("#loader").fadeIn('slow');
            $.ajax({
                url: 'view/ajax/Unidades/unidades_ajax.php',
                data: parametros,
                beforeSend: function(objeto) {
                    $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                },
                success: function(data) {
                    $(".outer_div").html(data).fadeIn('slow');
                    $("#loader").html("");
                    renderTable();
                }
            })
        }

        function per_page(valor) {
            $("#per_page").val(valor);
            load(1);
            $('.dropdown-menu li').removeClass("active");
            $("#" + valor).addClass("active");
        }
    </script>
    <script>
        
        $("#new_register").submit(function(event) {
            $('#guardar_datos').attr("disabled", true);
            var parametros = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "view/ajax/agregar/agregar_unidad.php",
                data: parametros,
                beforeSend: function(objeto) {
                    $("#resultados_ajax").html("Enviando...");
                },
                success: function(datos) {
                    $("#resultados_ajax").html(datos);
                    $('#guardar_datos').attr("disabled", false);
                    load(1, 'solicitud', 'view/ajax/Unidades/unidades_ajax.php')
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
                url: "view/ajax/editar/editar_unidad.php",
                data: parametros,
                beforeSend: function(objeto) {
                    $("#resultados_ajax").html("Enviando...");
                },
                success: function(datos) {
                    $("#resultados_ajax").html(datos);
                    $('#actualizar_datos').attr("disabled", false);
                    load(1, 'solicitud', 'view/ajax/Unidades/unidades_ajax.php')
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