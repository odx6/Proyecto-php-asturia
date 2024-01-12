<?php
 $active2 = "active";
 
    include "resources/header.php";
    include "./config/funciones.php";
    if(empty( $_REQUEST['id'])){
        header("location: ./?view=index"); 
    }
    if (  $_SESSION['empleados'] == 1 && in_array(2,$_SESSION['Habilidad']['Empleados']) && $_SESSION['user_id']==1 ) {
    $id_user = $_REQUEST['id'];
    //$id_user = 25;
    $empleado = mysqli_query($con, "select * from tblcatemp where IDEMP=$id_user");
    $rw = mysqli_fetch_object($empleado);
    $IDEMP = $rw->IDEMP;
    $STRNSS = $rw->STRNSS;
    $STRRFC = $rw->STRRFC;
    $STRCUR = $rw->STRCUR;
    $STRNOM = $rw->STRNOM;
    $STRAPE = $rw->STRAPE;
    $STRDOM = $rw->STRDOM;
    $STRLOC = $rw->STRLOC;
    $STRMUN = $rw->STRMUN;
    $STREST = $rw->STREST;
    $STRCP = $rw->STRCP;
    $STRPAI = $rw->STRPAI;
    $STRTEL = $rw->STRTEL;
    $STRCOR = $rw->STRCOR;
    $STRPWS = $rw->STRPWS;
    $BITSUS = $rw->BITSUS;
    $STRIMG = $rw->STRIMG;
    $CREATE_AT = $rw->CREATE_AT;
?>
    <!--main content start-->
    <section class="main-content-wrapper">
        <section id="main-content">
            <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb  pull-right">
                        <li><a href="./?view=dashboard">Dashboard</a></li>
                        <li class="active">Perfil</li>
                    </ul>
                    <!--breadcrumbs end -->
                    <br>
                    <h1 class="h1">Perfil</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="panel panel-primary">
                        <div class="panel-body panel-profile">
                            <div id="load_img">
                                <img class="img-responsive" src="<?php echo $STRIMG; ?>" alt="Logotipo">
                            </div>
                            <h3 class="profile-username text-center"><?php echo $STRNOM . " " . $STRAPE; ?></h3>
                            <p class="text-muted text-center mail-text"><?php echo $STRCOR; ?></p>



                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div id="resultados_ajax"></div><!-- resultados ajax -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Permisos del Usuario</h3>
                            <div class="actions pull-right">
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" name="update_register" id="update_register" method="post" action="view/ajax/agregar/actualizar_permisos.php">

                            <div class="panel-body" style="align-items: center;">

                                <ul style="list-style: none;" id="permisos">

                                    <?php


                                    $marcados = mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$id_user");
                                    $valores = array();




                                    while ($reg = $marcados->fetch_object()) {
                                        $skil = explode(",", $reg->Habilidades);

                                    ?>

                                        <h3 style=""><i class="fa fa-cog" aria-hidden="true"></i> <?php consultarNombre($reg->idpermiso, 'permisos', 'id', 'nombre'); ?></h3>
                                    <?php
                                        echo '<br>';
                                        $temp = $reg->idempleado_permiso;

                                        $Habilidades = mysqli_query($con, "SELECT * FROM Habilidades");
                                        while ($reg = $Habilidades->fetch_object()) {
                                            $sw =  (in_array($reg->pk_hab, $skil)) ? 'checked' : '';
                                            echo '&nbsp;<input id="' . $reg->Nombre . '" ' . $sw . ' type="checkbox" style="font-size:xx-small" data-nombre="' . $reg->Nombre . '" name="Habildades[ ' . $temp . '][' . $reg->Nombre . ']" value="' . $reg->pk_hab . '" >' . $reg->Nombre . ' &nbsp;</input>';
                                        }
                                        echo '<br>';
                                    }

                                    ?>

                                </ul>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary actualizar_datos">Guardar datos</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <!--panel-->
                    <!--end-pa
                </div>
            </div>
        </div>

    </section>
</section><!--main content end-->
                    <?php include "resources/footer.php" ?>
                <?php } else {
                     require 'resources/acceso_prohibido.php';
            } ?>