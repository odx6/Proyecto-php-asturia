<?php
$active2 = "active";
include "resources/header.php";
if ($_SESSION['empleados'] == 1) {
?>
    <!--main content start-->
    <section class="main-content-wrapper">
        <section id="main-content">
            <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb  pull-right">
                        <li><a href="./?view=dashboard">Dashboard</a></li>
                        <li class="active">Subcategorias</li>

                    </ul>
                    <!--breadcrumbs end -->
                    <br>
                    <h1 class="h1">Subcategorias</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3">

                    <select id="miSelect">
                       
                        <option value="pk_solicitud">Id Orden</option>
                        <option value="fk_empleado">Empleado</option>
                        <option value="fecha">fecha</option>
                        <option value="operador">operador</option>
                        <option value="NoCarro">Numero de carro</option>
                        <option value="Kilometraje">Kilometraje</option>
                        <option value="DetallesServicio">Detalles del servico	</option>
                        <option value="Observaciones">Observaciones</option>
                        
                        <!-- Agrega más opciones según las columnas que tengas -->
                    </select>

                    <div class="input-group">

                        <input type="text" class="form-control" placeholder="Buscar por numero de folio" id='q' onkeyup="load(1);">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick='load(1);'><i class='fa fa-search'></i></button>
                        </span>
                    </div><!-- /input-group -->
                </div>
                <div class="col-xs-3"></div>
                <div class="col-xs-1">
                    <div id="loader" class="text-center"></div>
                </div>

                <div class="col-md-offset-10">
                    <!-- modals -->
                    <?php
                    include "modals/agregar/agregar_subcategoria.php";
                    include "modals/editar/editar_subcategoria.php";
                    include "modals/mostrar/mostrar_subcategoria.php";
                    ?>
                    <!-- /end modals -->

                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Mostrar <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li class='active' onclick='per_page(15);' id='15'><a href="#">15</a></li>
                            <li onclick='per_page(25);' id='25'><a href="#">25</a></li>
                            <li onclick='per_page(50);' id='50'><a href="#">50</a></li>
                            <li onclick='per_page(100);' id='100'><a href="#">100</a></li>
                            <li onclick='per_page(1000000);' id='1000000'><a href="#">Todos</a></li>
                        </ul>
                    </div>
                    <input type='hidden' id='per_page' value='15'>
                </div>
            </div>



            <div id="resultados_ajax"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Datos de las Subcategorias</h3>
                            <div class="actions pull-right">
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="outer_div" id="peticionajax"></div><!-- Datos ajax Final -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section><!--main content end-->
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
            var  column=$("#miSelect").val();
            
            var query = $("#q").val();
            var per_page = $("#per_page").val();
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
                    url: 'view/ajax/Subcategorias/subcategorias_ajax.ph',
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