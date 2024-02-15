   <?php if (in_array(1, $_SESSION['Habilidad']['Empleados'])) { ?>
       <div class="modal fade" id="formModal">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Nuevo Empleado </h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">

                       <!-- inicio empleado--->
                       <div class="card card-primary card-outline">
                           <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register" enctype="multipart/form-data">
                               <div class="card-body box-profile">
                                   <div class="text-center">
                                       <img class="profile-user-img img-fluid img-circle EverCambio" src="view/resources/images/Default/perfil.png" alt="User profile picture">
                                       <div class="form-group">
                                           <label for="registro" class=" col-form-label">Imagen: </label>
                                           <input type="file" class="btn btn-success col fileinput-button validarBtn" id="STRIMGE" name="STRIMGE" placeholder="imagen: " width="20%" style="display: none;">
                                       </div>
                                       <div class="btn-group w-100" onclick="img('STRIMGE')">
                                           <span class="btn btn-success col fileinput-button">
                                               <i class="fas fa-plus"></i>
                                               <span>Agregar imagen</span>

                                           </span>

                                       </div>
                                       <div class="form-group">
                                           <label for="STRNDL" class=" col-form-label">Numero de licencia: </label>
                                           <input type="text" required class="form-control" id="STRNDL" name="STRNDL" placeholder="Numero de licencia: " required>
                                           <span id="MSTRNDL"></span>
                                       </div>

                                   </div>

                                   <h3 class="profile-username text-center"></h3>

                                   <div class="row">
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="STRNSS" class=" col-form-label">NSS: </label>
                                               <input type="text" required class="form-control" id="STRNSS" name="STRNSS" placeholder="NSS: " pattern="^(\d{2})(\d{2})(\d{2})\d{5}$" title="El NSS debe tener 11 dígitos." onchange="validarExistencia(this.value,'tblcatemp','STRNSS')">
                                               <span id="MSTRNSS"></span>
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="STRRFC" class=" col-form-label">RFC: </label>
                                               <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: " onchange="validarExistencia(this.value,'tblcatemp','STRRFC')">
                                               <span id="MSTRRFC"></span>
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="apellido" class=" col-form-label">CURP: </label>
                                               <input type="text" required class="form-control" id="STRCUR" name="STRCUR" placeholder="CURP: " onchange="validarExistencia(this.value,'tblcatemp','STRCUR')">
                                               <span id="MSTRCUR"> </span>
                                           </div>
                                       </div>
                                   </div>



                                   <div class="row">
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="usuario" class=" col-form-label">Nombre: </label>
                                               <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios">
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="email" class=" col-form-label">Apellidos: </label>
                                               <input type="text" required class="form-control" id="STRAPE" name="STRAPE" placeholder="Apellidos: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios">
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="registro" class=" col-form-label">Telefono: </label>
                                               <input type="text" class="form-control" id="STRTEL" name="STRTEL" placeholder="Telefono: " required>
                                           </div>
                                       </div>



                                   </div>
                                   <div class="row">
                                       <div class="col-4">
                                           <div class="form-group"> <label for="localidad" class=" col-form-label">Localidad: </label>
                                               <input type="text" required class="form-control" id="STRLOC" name="STRLOC" placeholder="Localidad: ">
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="celular" class=" col-form-label">Estado: </label>
                                               <input type="text" required class="form-control" id="STREST" name="STREST" placeholder="Estado: ">
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="telefono" class=" col-form-label">Municipio</label>
                                               <input type="text" required class="form-control" id="STRMUN" name="STRMUN" placeholder="Municipio">
                                           </div>
                                       </div>



                                   </div>
                                   <div class="row">
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="password" class=" col-form-label">Domicilio: </label>
                                               <input type="text" required class="form-control" id="STRDOM" name="STRDOM" placeholder="Domicilio">
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="codigo" class=" col-form-label">Codigo Postal: </label>
                                               <input type="text" required class="form-control" id="STRCP" name="STRCP" placeholder="Codigo: ">
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="registro" class=" col-form-label">Pais: </label>
                                               <input type="text" class="form-control" id="STRPAI" name="STRPAI" placeholder="Pais: " required>
                                           </div>
                                       </div>



                                   </div>
                                   <div class="row">
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="email" class=" col-form-label">Correo Electronico: </label>
                                               <input type="email" class="form-control" id="STRCOR" name="STRCOR" placeholder="Email: " onchange="validarExistencia(this.value,'tblcatemp','STRCOR')" required>
                                               <span id="MSTRCOR"> </span>
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="pasword" class=" col-form-label">Contraseña: </label>
                                               <input type="password" class="form-control" id="STRPWS" name="STRPWS" placeholder="Contraseña: " required>
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label for="bitsus" class=" col-form-label">Estado: </label>
                                               <select class="form-control" name="BITSUS" id="BITSUS">
                                                   <option value="1">Activo</option>
                                                   <option value="2">Inactivo</option>
                                               </select>
                                           </div>
                                       </div>



                                   </div>


                                   <p class="text-muted text-center">permisos</p>


                                   <ul class="list-group list-group-unbordered mb-3" id="permisos">

                                       <?php
                                        require_once("config/config.php");
                                        $rspta = mysqli_query($con, "SELECT * FROM permisos");

                                        $id = 0;

                                        $marcados = mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$id");
                                        $valores = array();
                                        while ($per = $marcados->fetch_object()) {
                                            array_push($valores, $per->idpermiso);
                                        }
                                        while ($reg = $rspta->fetch_object()) {
                                            $sw = in_array($reg->id, $valores) ? 'checked' : '';

                                            //echo '<li> <input id="permisos" type="checkbox" ' . $sw . '  name="permisos[]" value="' . $reg->id . '">' . $reg->nombre . '</li>';
                                            echo  '  <li class="list-group-item">';
                                            echo '<b>' . $reg->nombre . '</b> <a class="float-right"><input id="permisos' . $reg->nombre . '" type="checkbox" ' . $sw . ' name="permisos[]" value="' . $reg->id . '"></a>';
                                            echo '</li>';
                                        }
                                        ?>



                                   </ul>


                               </div>
                               <!-- /.card-body -->
                       </div>
                       <!--end empleado -->

                   </div>
                   <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                       <button type="submit" id="guardar_datos" class="btn btn-primary">Guardar</button>
                   </div>
                   </form>
               </div>
               <!-- /.modal-content -->
           </div>
           <!-- /.modal-dialog -->
       </div>

       <!-- /.modal -->


   <?php } ?>