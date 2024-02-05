<?php
$active2 = "active";
include "resources/header copy.php";
if ($_SESSION['Control'] == 1) {
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Control</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Control</li>
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
                                <h3 class="card-title">Lista de productos</h3>
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

        <!--funcion buscar en la vista -->
        <script>
            $(document).ready(function() {

                var datos = JSON.parse(localStorage.getItem('datos'));
                $(".outer_div").html(datos).fadeIn('slow');
                $("#loader").html("");
                renderTable2();
            });

            function load(page) {

                var per_page = 1000;
                var id = $("#ideControl").val();
                var Saldo = $("#Saldo").val();

                var parametros = {
                    "action": "ajax",
                    "page": page,
                    'per_page': per_page,
                    'id': id,
                    'Saldo': Saldo,
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
                        renderTable2();
                    }
                })
            }


            function load2(page) {

                var query = $("#q").val();
                var per_page = $("#per_page").val();
                var id = $("#ideControl").val();
                var Saldo = $("#Saldo").val();

                var parametros = {
                    "action": "ajax2",
                    "page": page,
                    "query": query,
                    'per_page': per_page,
                    'id': id,
                    'Saldo': Saldo,
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