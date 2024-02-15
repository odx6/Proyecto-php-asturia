<?php
include "resources/header copy.php";

$id_user = $_SESSION['user_id'];
$empleado = mysqli_query($con, "select * from tblcatemp where IDEMP=$id_user");
$rw = mysqli_fetch_object($empleado);
$IDEMP = $rw->IDEMP;
$STRNSS = $rw->STRNSS;
$STRRFC = $rw->STRRFC;
$STRCUR = $rw->STRCUR;
$STRNDL = $rw->STRNDL;
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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Perfil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>





    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo $STRIMG; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?php echo $STRNOM . " " . $STRAPE; ?></h3>

                            <p class="text-muted text-center"><?php echo $STRCOR; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Seguro social</b> <a class="float-right"><?php echo $STRNSS ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>RFC</b> <a class="float-right"><?php echo $STRRFC ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>CURP</b> <a class="float-right"><?php echo $STRCUR ?></a>
                                </li>
                            </ul>


                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Editar Datos del perfil</a></li>
                            </ul>
                            <?php
                            if (!empty($_SESSION['message'])) {


                                echo      '<div class="alert alert-' . $_SESSION['color'] . '" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>' . $_SESSION['message'] . '</strong>
		
	</div>';

                                // Eliminar el mensaje después de mostrarlo
                                unset($_SESSION['message']);
                                unset($_SESSION['color']);
                            }
                            ?>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">

                                    <form class="form-horizontal" role="form" action="view/ajax/agregar/actualizar_perfil.php" name="update_register" id="update_register" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $id_user ?>">
                                        <input type="hidden" class="form-control" id="OLDSTRCOR" name="OLDSTRCOR" placeholder="Email: " value="<?php echo $STRCOR ?>">
                                        <div class="row">
                                            <div class="col-6">

                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Seguridad social: </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRNSS" class="form-control" id="STRNSS" placeholder="NSS: " value="<?php echo $STRNSS ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Imagen:</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="STRIMGPE" class="form-control" id="STRIMGPE" onchange="upload_image(<?php echo $id_user; ?>,'tblcatemp','IDEMP','view/resources/images/','STRIMG');" style="display:none">
                                                        <div class="btn-group w-100" onclick="img('STRIMGPE')">
                                                            <span class="btn btn-success col fileinput-button">
                                                                <i class="fas fa-plus"></i>
                                                                <span>Agregar imagen</span>

                                                            </span>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">RFC : </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRRFC" class="form-control" id="STRRFC" placeholder="STRRFC: " value="<?php echo $STRRFC ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-2 col-form-label">CURP:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRCUR" class="form-control" id="STRCUR" placeholder="Apellido: " value="<?php echo $STRCUR ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-2 col-form-label">Numero de licencia:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRNDL" class="form-control" id="STRNDL" placeholder="Licencia: " value="<?php echo $STRNDL ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">Nombre</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRNOM" class="form-control" id="STRNOM" placeholder="Nombre: " value="<?php echo $STRNOM ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRAPE" class="form-control" id="STRAPE" placeholder="Apellidos: " value="<?php echo $STRAPE ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Domicilio" class="col-sm-2 col-form-label">Domicilio</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRDOM" class="form-control" id="STRDOM" placeholder="Domicilio: " value="<?php echo $STRDOM ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Localidad" class="col-sm-2 col-form-label">Localidad</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRLOC" class="form-control" id="STRLOC" placeholder="Localidad: " value="<?php echo $STRLOC ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="Municipio" class="col-sm-2 col-form-label">Municipio</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRMUN" class="form-control" id="STRMUN" placeholder="Municipio: " value="<?php echo $STRMUN ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STREST" class="form-control" id="STREST" placeholder="Estado: " value="<?php echo $STREST ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-sm-2 col-form-label">Codigo Postal</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRCP" class="form-control" id="STRCP" placeholder="Codigo Postal: " value="<?php echo $STRCP ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Pais" class="col-sm-2 col-form-label">Pais</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRPAI" class="form-control" id="STRPAI" placeholder="Pais: " value="<?php echo $STRPAI ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="STRTEL" class="form-control" id="STRTEL" placeholder="TELEFONO: " value="<?php echo $STRTEL ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" required name="STRCOR" class="form-control" id="STRCOR" placeholder="Email: " value="<?php echo $STRCOR ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Contraseña" class="col-sm-2 col-form-label">Contraseña</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="STRPWS" class="form-control" id="STRPWS" placeholder="Contraseña: ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="Estatus" class="col-sm-2 col-form-label">Estatus</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="BITSUS" class="form-control" id="BITSUS" placeholder="Estado: " value="<?php echo $BITSUS ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Guardar datos</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>




    <!--main content start-->

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