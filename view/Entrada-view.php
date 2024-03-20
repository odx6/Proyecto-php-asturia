<?php
$active2 = "active";
include "resources/header copy.php";
if ($_SESSION['Entradas'] == 1) {
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> <i class="fas fa-dolly"></i> Entradas y Salidas</h1>
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
              
                
                    
                   
             
                    <div class="col-12">


                        <div class="card">
                            
                            
                            <div class="card-header">
                            <div class="col-sm-8"><h3 class="card-title"> <i class="fas fa-dolly"></i> Lista de entradas y salidas</h3></div>
                            <div class="col-sm-4">

                            <?php 
                            include "modals/Productos_modal.php";
                            include "modals/editar/Editar_generico.php";
                            include "modals/mostrar/mostrar_entrada.php";
                        ?>
                            </div>
                           
                                <!-- modals -->
                      
                    <!-- /end modals -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
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
        <script>
            $(function() {
                load(1);
            });

            function load(page) {
                var query = $("#q").val();
                var per_page = $("#per_page").val();
                var query = "";
                var per_page = 1000000;
                var parametros = {
                    "action": "ajax",
                    "page": page,
                    'query': query,
                    'per_page': per_page
                };
                $("#loader").fadeIn('slow');
                $.ajax({
                    url: 'view/ajax/Entradas/Entradas_ajax.php',
                    data: parametros,
                    beforeSend: function(objeto) {
                        $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                    },
                    success: function(data) {
                        $(".outer_div").html(data).fadeIn('slow');
                        $("#loader").html("");
                        renderTable3();



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
            function eliminar(id) {
                if (confirm('Esta acción  eliminará de forma permanente al empleado \n\n Desea continuar?')) {
                    var page = 1;
                    var query = "";
                    var per_page = 15;
                    var parametros = {
                        "action": "ajax",
                        "page": page,
                        "query": query,
                        "per_page": per_page,
                        "id": id
                    };

                    $.ajax({
                        url: 'view/ajax/Entradas/Entradas_ajax.php',
                        data: parametros,
                        beforeSend: function(objeto) {
                            $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                        },
                        success: function(data) {
                            $(".outer_div").html(data).fadeIn('slow');
                            $("#loader").html("");
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                    $(this).remove();
                                });
                            }, 5000);
                        }
                    })
                }
            }
        </script>
        <script>
            //nuevo form data
            $("#new_register").submit(function(event) {
                event.preventDefault();

                $('#guardar_datos').attr("disabled", true);
                INTTIPMOV = $('#INTTIPMOV').val();
                inventario = JSON.stringify(inventario);
                var formData = new FormData(this);
                
                formData.append('inventario', inventario); // Crear un objeto FormData
                formData.append('INTTIPMOV', INTTIPMOV);
                $.ajax({
                    type: "POST",
                    url: "view/ajax/agregar/agregar_entrada.php",
                    data: formData, // Usar el objeto FormData como los datos de la petición
                    processData: false, // Indicar a jQuery que no procese los datos
                    contentType: false, // Indicar a jQuery que no establezca el tipo de contenido
                    beforeSend: function(objeto) {
                        $("#resultados_ajax").html("Enviando...");
                    },
                    success: function(datos) {
                        $("#resultados_ajax").html(datos);
                        $('#guardar_datos').attr("disabled", false);
                        load(1);
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                $(this).remove();
                            });
                        }, 5000);
                        $('#formModal').modal('hide');
                        inventario=[];

                    }
                });
            });
        </script>

        <script>
            $("#update_register").submit(function(event) {
                $('#actualizar_datos').attr("disabled", true);
                inventario = JSON.stringify(inventarioUpdate);
                var formData = new FormData(this);

                INTTIPMOVU = $('#INTTIPMOVU').val();
                formData.append('inventario', inventario);
                formData.append('INTTIPMOVU', INTTIPMOVU);
                $.ajax({
                    type: "POST",
                    url: "view/ajax/editar/editar_entrada.php",
                    data: formData,
                    processData: false, // Indicar a jQuery que no procese los datos
                    contentType: false,
                    beforeSend: function(objeto) {
                        $("#resultados_ajax").html("Enviando...");
                    },
                    success: function(datos) {

                        $("#resultados_ajax").html(datos);
                        $('#actualizar_datos').attr("disabled", false);
                        load(1);
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
        <script>
            function editar(id) {

                var parametros = {
                    "action": "ajax",
                    "id": id
                };
                $.ajax({
                    url: 'view/modals/editar/Entrada.php',
                    data: parametros,

                    success: function(data) {

                        if (data.trim() == "Error") {
                            $('#actualizar_datos').attr("disabled", true);
                            html = ''
                            $(".outer_div2").html(' <div class="alert alert-danger" role="alert"> 		<button type="button" class="close" data-dismiss="alert">&times;</button> 		<strong>Error! Otro usuario esta editando el mismo registro</strong> 		 	</div>').fadeIn('slow');
                            $("#loader2").html("");

                        } else {

                            $(".outer_div2").html(data).fadeIn('slow');
                            $("#loader2").html("");
                            MostrarProductos(id);
                            TotalUpdate = 0;
                        }



                    }
                })
            }

            function mostrar(id) {
                var parametros = {
                    "action": "ajax",
                    "id": id
                };
                $.ajax({
                    url: 'view/modals/mostrar/Entrada.php',
                    data: parametros,
                    beforeSend: function(objeto) {
                        $("#loader3").html("<img src='./assets/img/ajax-loader.gif'>");
                    },
                    success: function(data) {
                        $(".outer_div3").html(data).fadeIn('slow');
                        $("#loader3").html("");
                    }
                })
            }

            function exportpf(historial) {
                alert(historial);
                var contenido = document.getElementById(historial).innerHTML;
                var contenidoOriginal = document.body.innerHTML;

                document.body.innerHTML = contenido;

                window.print();

                document.body.innerHTML = contenidoOriginal;
            }
        </script>
    <?php
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
    ?>