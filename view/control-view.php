<?php
$active2 = "active";
include "resources/header.php";
if ($_SESSION['solicitud'] == 1) {
?>
    <!--main content start-->
    <section class="main-content-wrapper">
        <section id="main-content">
            <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb  pull-right">
                        <li><a href="./?view=dashboard">Dashboard</a></li>
                        <li class="active">Control</li>

                    </ul>
                    <!--breadcrumbs end -->
                    <br>
                    <h1 class="h1">Control</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3">

                    <div class="input-group">

                        <input type="text" class="form-control" placeholder="Buscar por numero de folio" id='q' onkeyup="load2(1)">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="load2(1)"><i class='fa fa-search'></i></button>
                        </span>
                    </div><!-- /input-group -->
                </div>
                <div class="col-xs-3"></div>
                <div class="col-xs-1">
                    <div id="loader" class="text-center"></div>
                </div>

                <div class="col-md-offset-6" style="display: inline-block;">
                    <!-- modals -->
                    <?php
                    //include "modals/agregar/Solicitud/agregar_solicitud.php";
                   // include "modals/editar/editar_solicitud.php";
                   // include "modals/mostrar/mostrar_solicitud.php";
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
                            <h3 class="panel-title">Control de inventario</h3>
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

$(document).ready(function() {
    
    var datos = JSON.parse(localStorage.getItem('datos'));
      $(".outer_div").html(datos).fadeIn('slow');
      $("#loader").html("");
});
function load(page) {
           
            var per_page = $("#per_page").val();
            var id = $("#ideControl").val();
            
            var parametros = {
                "action": "ajax",
                "page": page,
                'per_page': per_page,
                'id':id,
            };
            $("#loader").fadeIn('slow');
            $.ajax({
                url: 'view/ajax/control_ajax-copy.php',
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


        function load2(page) {
           
           var query = $("#q").val();
           var per_page = $("#per_page").val();
           var id = $("#ideControl").val();
           
           var parametros = {
               "action": "ajax2",
               "page": page,
               "query": query,
               'per_page': per_page,
               'id':id,
           };
           $("#loader").fadeIn('slow');
           $.ajax({
               url: 'view/ajax/control_ajax-copy.php',
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
    </script>
<?php
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
?>