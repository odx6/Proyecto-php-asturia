<?php
$active2 = "active";
include "resources/header copy.php";
if ($_SESSION['productos'] == 1) {
    //verifica si tiene permiso al modulo 
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-database"></i> Registros</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Registros</li>
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
                     
                     include "modals/mostrar/mostrar_log.php";
                     ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-database"></i> Lista de movimientos</h3>
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
        //carga los dato de los productos
        function load(page) {
            var query = "";
            var per_page = 1000;
            var parametros = {
                "action": "ajax",
                "page": page,
                'query': query,
                'per_page': per_page
            };
            $("#loader").fadeIn('slow');
            $.ajax({
                url: 'view/ajax/logs_ajax.php',
                data: parametros,
                beforeSend: function(objeto) {
                    $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                },
                success: function(data) {
                    $(".outer_div").html(data).fadeIn('slow');
                    $("#loader").html("");
                    renderTable2();
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
            if (confirm('Esta acción  eliminará de forma permanente al producto \n\n Desea continuar?')) {
                var page = 1;
                var query = $("#q").val();
                var per_page = $("#per_page").val();
                var parametros = {
                    "action": "ajax",
                    "page": page,
                    "query": query,
                    "per_page": per_page,
                    "id": id
                };

                $.ajax({
                    url: 'view/ajax/productos_ajax.php',
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
        $("#new_register").submit(function(event) {

            // event.preventDefault();
            $('#guardar_datos').attr("disabled", true);

            var formData = new FormData(this); // Crear un objeto FormData

            $.ajax({
                type: "POST",
                url: "view/ajax/agregar/agregar_producto.php",
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
                }
            });
        });
    </script>

    <script>
        $("#update_register").submit(function(event) {

            event.preventDefault();
            $('#actualizar_datos').attr("disabled", true);

            var formData = new FormData(this); // Crear un objeto FormData

            $.ajax({
                type: "POST",
                url: "view/ajax/editar/editar_producto.php",
                data: formData, // Usar el objeto FormData como los datos de la petición
                processData: false, // Indicar a jQuery que no procese los datos
                contentType: false, // Indicar a jQuery que no establezca el tipo de contenido
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
        });
    </script>
    <script>
        function editar(id) {
            $('#actualizar_datos').attr("disabled", false);
            var parametros = {
                "action": "ajax",
                "id": id
            };
            $.ajax({
                url: 'view/modals/editar/producto.php',
                data: parametros,
                beforeSend: function(objeto) {
                    $("#loader2").html("<img src='./assets/img/ajax-loader.gif'>");
                },
                success: function(data) {

                    if (data.trim() == "Error") {
                        $('#actualizar_datos').attr("disabled", true);
                        html = ''
                        $(".outer_div2").html(' <div class="alert alert-danger" role="alert"> 		<button type="button" class="close" data-dismiss="alert">&times;</button> 		<strong>Error! Otro usuario esta editando el mismo registro</strong> 		 	</div>').fadeIn('slow');
                        $("#loader2").html("");

                    } else {

                        $(".outer_div2").html(data).fadeIn('slow');
                        $("#loader2").html("");
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
                url: 'view/modals/mostrar/log.php',
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

        function exportpf2(historial) {
            alert("Deseas Generar un pdf con los Datos");
            var contenido = document.querySelector("#peticionajax");
            var contenidoOriginal = document.body.innerHTML;

            document.body.innerHTML = contenido;

            window.print();

            document.body.innerHTML = contenidoOriginal;
        }

        function exportpf(id) {
            var contenido = document.querySelector("#peticionajax").innerHTML;
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