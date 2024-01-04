<?php
include "resources/header.php";

$id_user = $_REQUEST['id'];
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
                        <h3 class="panel-title">Datos del Perfil</h3>
                        <div class="actions pull-right">
                            <i class="fa fa-chevron-down"></i>
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <form>
                    <div class="panel-body" style="align-items: center;">

                        <ul style="list-style: none;" id="permisos">
                            <?php
                            $rspta = mysqli_query($con, "SELECT * FROM permisos");
                           
                            $marcados = mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$id_user");
                            $valores = array();

                            while ($per = $marcados->fetch_object()) {
                                array_push($valores, $per->idpermiso);
                            }

                            while ($reg = $rspta->fetch_object()) {
                                $sw = in_array($reg->id, $valores) ? 'checked' : '';
                                echo '<li> <input id="checks" type="checkbox" ' . $sw . '   value="' . $reg->id . '">' . $reg->nombre . '</li><br>';
                                $temp=$reg->id;
                                $Habilidades = mysqli_query($con, "SELECT * FROM Habilidades");
                                while ($reg = $Habilidades->fetch_object()) {
                                    echo '&nbsp;<input id="'.$temp.$reg->Nombre.'" type="checkbox" style="font-size:xx-small" data-nombre="'.$reg->Nombre.'" data-info="'.$temp.'" name="Habildades[ '.$temp.']'.$reg->Nombre.'" value="' . $reg->pk_hab . '" onclick="Ever(this.dataset.info+this.dataset.nombre)">' . $reg->Nombre .' &nbsp;</input>';

                                }

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
<script>
    /*function upload_image(id_user,table,) {
        $("#load_img").text('Cargando...');
        var inputFileImage = document.getElementById("STRIMG");
        var file = inputFileImage.files[0];
        var data = new FormData();
        data.append('imagefile', file);
        data.append('id', id_user);

        $.ajax({
            url: "view/ajax/images/image_perfil_ajax.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function(data) // A function to be called if request succeeds
            {
                $("#load_img").html(data);

            }
        });
    }*/
</script>
<script>
   
</script>