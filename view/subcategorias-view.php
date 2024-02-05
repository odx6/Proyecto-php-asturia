<?php
$active2 = "active";
include "resources/header copy.php";
if ($_SESSION['subcategorias'] == 1) {
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subcategorias</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Subcategorias</li>
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
                                <h3 class="card-title">Lista de subcategorias</h3>
                            </div>
                            <?php 
                            include "modals/agregar/agregar_subcategoria.php";
                            include "modals/editar/editar_subcategoria.php";
                            include "modals/mostrar/mostrar_subcategoria.php";
                        ?>
                            <!-- /.card-header -->
                            <div class="card-body outer_div">
                                </table>
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
                load(1);
            });
            // carga  todas las  solicitude  de las solicitudes
            function load(page) {
                var column = $("#miSelect").val();

                var query = $("#q").val();
                var per_page = $("#per_page").val();
                var column = $("#miSelect").val();

                var query ="";
                var per_page = 15;


                var parametros = {
                    "action": "ajax",
                    "page": page,
                    'query': query,
                    'per_page': per_page,
                    'column': column
                };
                $("#loader").fadeIn('slow');
                $.ajax({
                    url: 'view/ajax/Subcategorias/subcategorias_ajax.php',
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
            //Elimina una solicitud desde el modal
            function eliminar(id) {
                if (confirm('Esta acción  eliminará de forma permanente la solicitud\n\n Desea continuar?')) {
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
                        url: 'view/ajax/Subcategorias/subcategorias_ajax.php',
                        data: parametros,
                        beforeSend: function(objeto) {
                            $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                        },
                        success: function(data) {
                            $(".outer_div").html(data).fadeIn('slow');
                            $("#loader").html("");
                            renderTable();
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
            //agrega una categoria
            $("#new_register").submit(function(event) {
                $('#guardar_datos').attr("disabled", true);
                var parametros = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "view/ajax/agregar/agregar_subcategoria.php",
                    data: parametros,
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
                    url: "view/ajax/editar/editar_subcategoria.php",
                    data: parametros,
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
            //muestra el modal con los datos para posteriormente actualizar con el scrip de arriba 
            function editar(id) {

                var parametros = {
                    "action": "ajax",
                    "id": id
                };
                $.ajax({
                    url: 'view/modals/editar/subcategoria.php',
                    data: parametros,
                    beforeSend: function(objeto) {
                        $("#loader2").html("<img src='./assets/img/ajax-loader.gif'>");
                    },
                    success: function(data) {
                        $(".outer_div2").html(data).fadeIn('slow');
                        $("#loader2").html("");
                    }
                })
            }

            function mostrar(id) {
                var parametros = {
                    "action": "ajax",
                    "id": id
                };
                $.ajax({
                    url: 'view/modals/mostrar/subcategoria.php',
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

            function pdf(id) {
                var parametros = {
                    "action": "ajax",
                    "id": id
                };
                $.ajax({
                    url: 'view/modals/pdf/pdf-solicitud.php',
                    data: parametros,
                    beforeSend: function(objeto) {
                        $("#loader3").html("<img src='./assets/img/ajax-loader.gif'>");
                    },
                    success: function(data) {
                        // var file = new Blob([data], {type: 'application/pdf'});

                        // Crear una URL para el Blob
                        //var fileURL = URL.createObjectURL(file);

                        // Abrir la URL en una nueva ventana
                        //window.open(fileURL);
                        alert(data);
                    }
                })
            }

            function exportpf(historial) {
                alert("Deseas Generar un pdf con los Datos");
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