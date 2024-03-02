<?php
$active2 = "active";
include "resources/header copy.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $icon . " " . $Titulo; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active"><?php echo $url; ?></li>
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
                            <div class="col-sm-8">
                                <h3 class="card-title"> <?php echo $icon ?> Lista de <?php echo $Titulo; ?> </h3>
                            </div>
                            <div class="col-sm-4">
                                <?php 
                                
                                (isset($agregar))? include $agregar:'';
                                (isset($editar))? include $editar:'';
                                (isset($mostrar))? include $mostrar:'';
                               
                                ?>
                                
                           
                            </div>
                            <!-- modals -->

                            <!-- /end modals -->
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
    
   