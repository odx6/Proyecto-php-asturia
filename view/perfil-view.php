<?php
include "resources/header.php";

$id_user = $_SESSION['user_id'];
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
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" name="update_register" id="update_register" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $id_user ?>">
                            <div class="form-group">
                                <label for="dni" class="col-sm-2 control-label">Seguridad social: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRNSS" class="form-control" id="STRNSS" placeholder="NSS: " value="<?php echo $STRNSS ?>">
                                </div>
                                <label for="imagefile" class="col-sm-2 control-label">Imagen: </label>
                                <div class="col-sm-4">
                                    <input type="file" name="STRIMG" class="form-control" id="STRIMG" onchange="upload_image(<?php echo $id_user; ?>,'tblcatemp','IDEMP','view/resources/images/','STRIMG');">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-2 control-label">RFC : </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRRFC" class="form-control" id="STRRFC" placeholder="STRRFC: " value="<?php echo $STRRFC ?>">
                                </div>
                                <label for="apellido" class="col-sm-2 control-label">CURP: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRCUR" class="form-control" id="STRCUR" placeholder="Apellido: " value="<?php echo $STRCUR ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usuario" class="col-sm-2 control-label">Nombre: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRNOM" class="form-control" id="STRNOM" placeholder="Nombre: " value="<?php echo $STRNOM ?>">
                                </div>
                                <label for="email" class="col-sm-2 control-label">Apellidos: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRAPE" class="form-control" id="STRAPE" placeholder="Apellidos: " value="<?php echo $STRAPE ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="domicilio" class="col-sm-2 control-label">Domicilio: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRDOM" class="form-control" id="STRDOM" placeholder="Domicilio: " value="<?php echo $STRDOM ?>">
                                </div>
                                <label for="localidad" class="col-sm-2 control-label">Localidad: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRLOC" class="form-control" id="STRLOC" placeholder="Localidad: " value="<?php echo $STRLOC ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="col-sm-2 control-label">Municipio : </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRMUN" class="form-control" id="STRMUN" placeholder="Municipio: " value="<?php echo $STRMUN ?>">
                                </div>
                                <label for="celular" class="col-sm-2 control-label">Estado: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STREST" class="form-control" id="STREST" placeholder="Estado: " value="<?php echo $STREST ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="registro" class="col-sm-2 control-label">Codigo Postal: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRCP" class="form-control" id="STRCP" placeholder="Codigo Postal: " value="<?php echo $STRCP ?>">
                                </div>
                                <label for="password" class="col-sm-2 control-label">Pais: </label>
                                <div class="col-sm-4">
                                    <input type="text" name="STRPAI" class="form-control" id="STRPAI" placeholder="Pais: " value="<?php echo $STRPAI ?>">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="registro" class="col-sm-2 control-label">Telefono: </label>
                                <div class="col-sm-4">
                                    <input type="text" required name="STRTEL" class="form-control" id="STRTEL" placeholder="Telefono: " value="<?php echo $STRTEL ?>">
                                </div>
                                <label for="password" class="col-sm-2 control-label">Email: </label>
                                <div class="col-sm-4">
                                    <input type="email" name="STRCOR" class="form-control" id="STRCOR" placeholder="Email: " value="<?php echo $STRCOR ?>">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="registro" class="col-sm-2 control-label">Contraseña: </label>
                                <div class="col-sm-4">
                                    <input type="password" name="STRPWS" class="form-control" id="STRPWS" placeholder="Contraseña: ">
                                </div>
                                <label for="password" class="col-sm-2 control-label">Estado: </label>
                                <div class="col-sm-4">
                                    <input type="text" name="BITSUS" class="form-control" id="BITSUS" placeholder="Estado: " value="<?php echo $BITSUS ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary ">Guardar datos</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
    $("#update_register").submit(function(event) {
        $('.actualizar_datos').attr("disabled", true);
        var inputFileImage = document.getElementById("imagefile");
        var file = inputFileImage.files[0];
        var data = new FormData();
        data.append('imagefile', file);
        data.append('id', id_user);
        alert("Entro")
        $.ajax({
            type: "POST",
            url: "view/ajax/agregar/actualizar_perfil.php",
            data: parametros,
            data,
            beforeSend: function(objeto) {
                $("#resultados_ajax").html("Mensaje: Cargando...");
            },
            success: function(datos) { 
                alert("Hola");
               /* $("#resultados_ajax").html(datos);
                $('.actualizar_datos').attr("disabled", false);
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);*/

            }
        });
        event.preventDefault();
    });
</script>