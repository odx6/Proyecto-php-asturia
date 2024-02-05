<?php
$active1 = "active";

include "resources/header copy.php";

if ($_SESSION['dashboard'] == 1) {

    $empleados = mysqli_query($con, "select * from tblcatemp");
    $numempleados= mysqli_num_rows($empleados);

    $productos = mysqli_query($con, "select * from tblcatpro");
    $numproductos= mysqli_num_rows($productos);

    $solicitud = mysqli_query($con, "select * from solicitud");
    $numsolicitud= mysqli_num_rows($solicitud);

    $categorias = mysqli_query($con, "select * from tblcatcat");
    $numcategorias= mysqli_num_rows($categorias);

    
    //  $talleres = mysqli_query($con, "select * from taller");
    // $empresas = mysqli_query($con, "select * from empresa");
    // $vehiculos = mysqli_query($con, "select * from vehiculo");

    function suma_reparaciones($month)
    {
        global $con;
        $year = date('Y');
        $sql = "select count(id) as id from reparaciones where year(fecha_carga) = '$year' and month(fecha_carga)= '$month' ";
        $query = mysqli_query($con, $sql);
        $reg = mysqli_fetch_array($query);
        return $total = number_format($reg['id'], 2, '.', '');
    }
    function suma_choques($month)
    {
        global $con;
        $year = date('Y');
        $sql = "select count(id) as id from choque where year(fecha_carga) = '$year' and month(fecha_carga)= '$month' ";
        $query = mysqli_query($con, $sql);
        $reg = mysqli_fetch_array($query);
        return $total = number_format($reg['id'], 2, '.', '');
    }

?>
    <!--main content start-->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $numempleados; ?></h3>

                                <p>Empleados Registrados</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $numproductos ?><sup style="font-size: 20px"></sup></h3>

                                <p>numero de productos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $numsolicitud ?></h3>

                                <p>numero de solicitudes </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $numcategorias ?></h3>

                                <p>numero de categorias registradas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
    </div>
    <!--main content end-->

    <?php
    include "resources/footer.php";
    ?>

    <!--<script src="assets/plugins/chartjs/Chart.min.js"></script>-->
    <!--Page Level JS-->
    <!--<script src="assets/plugins/countTo/jquery.countTo.js"></script>-->
    <!--<script src="assets/plugins/weather/js/skycons.js"></script>-->
    <script>
        var barChartData = {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [{
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    data: [<?php echo suma_reparaciones(1); ?>, <?php echo suma_reparaciones(2); ?>, <?php echo suma_reparaciones(3); ?>, <?php echo suma_reparaciones(4); ?>, <?php echo suma_reparaciones(5); ?>, <?php echo suma_reparaciones(6); ?>, <?php echo suma_reparaciones(7); ?>, <?php echo suma_reparaciones(8); ?>, <?php echo suma_reparaciones(9); ?>, <?php echo suma_reparaciones(10); ?>, <?php echo suma_reparaciones(11); ?>, <?php echo suma_reparaciones(12); ?>]
                },
                {
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    data: [<?php echo suma_choques(1); ?>, <?php echo suma_choques(2); ?>, <?php echo suma_choques(3); ?>, <?php echo suma_choques(4); ?>, <?php echo suma_choques(5); ?>, <?php echo suma_choques(6); ?>, <?php echo suma_choques(7); ?>, <?php echo suma_choques(8); ?>, <?php echo suma_choques(9); ?>, <?php echo suma_choques(10); ?>, <?php echo suma_choques(11); ?>, <?php echo suma_choques(12); ?>]
                }
            ]

        }
        var myLine = new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
    </script>

    <!-- Morris  
<script src="assets/plugins/morris/js/morris.min.js"></script>
<script src="assets/plugins/morris/js/raphael.2.1.0.min.js"></script>
-->
    <!--Load these page level functions-->
    <script>
        $(document).ready(function() {
            app.timer();
            app.weather();
        });
    </script>
<?php
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
?>