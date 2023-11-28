<?php
session_start();
require_once("../../../config/config.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $id = intval($id);
    $sql = "select * from tblcatemp where IDEMP='$id'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        while ($row = mysqli_fetch_array($query)) {
            $IDEMP = $row['IDEMP'];
            $STRNSS = $row['STRNSS'];
            $STRRFC = $row['STRRFC'];
            $STRCUR = $row['STRCUR'];
            $STRNOM = $row['STRNOM'];
            $STRAPE = $row['STRAPE'];
            $STRDOM = $row['STRDOM'];
            $STRLOC = $row['STRLOC'];
            $STRMUN = $row['STRMUN'];
            $STREST = $row['STREST'];
            $STRCP = $row['STRCP'];
            $STRPAI = $row['STRPAI'];
            $STRTEL = $row['STRTEL'];
            $STRCOR = $row['STRCOR'];
            $STRPWS = $row['STRPWS'];
            $BITSUS = $row['BITSUS'];
            $STRIMG = $row['STRIMG'];
            $CREATE_AT = $row['CREATE_AT'];

            list($date, $hora) = explode(" ", $CREATE_AT);
            list($Y, $m, $d) = explode("-", $date);
            $fecha = $d . "-" . $m . "-" . $Y;


            if ($BITSUS == 1) {
                $lbl_status = "Activo";
                $lbl_class = 'label label-success';
            } else {
                $lbl_status = "Inactivo";
                $lbl_class = 'label label-danger';
            }
        }
    }
} else {
    exit;
}
?>
<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
<input type="hidden" class="form-control" id="OLDSTRCOR" name="OLDSTRCOR" placeholder="Email: " value="<?php echo $STRCOR ?>">
<div class="col-md-4">
    <img src="<?php echo $STRIMG ?>" alt="..." class="img-circle EverCambio" >
    <br>
    <label for="registro" class=" control-label">Imagen: </label>
    <input type="file" class="form-control validarBtn" id="STRIMG" name="STRIMG" placeholder="imagen: ">

</div>

    <div class="col-sm-4">
    <div class="form-group">
    <label for="permisos" class=" control-label">Permisos: </label>
        <ul style="list-style: none;" id="permisos">
            <?php
            $rspta = mysqli_query($con, "SELECT * FROM permisos");

            $marcados = mysqli_query($con, "SELECT * FROM empleado_permisos WHERE idempleado=$id");
            $valores = array();

            while ($per = $marcados->fetch_object()) {
                array_push($valores, $per->idpermiso);
            }

            while ($reg = $rspta->fetch_object()) {
                $sw = in_array($reg->id, $valores) ? 'checked' : '';
                echo '<li> <input id="checks" type="checkbox" ' . $sw . '  name="permisos[]" value="' . $reg->id . '">' . $reg->nombre . '</li>';
            }
            ?>
        </ul>
    </div>
</div>
<div class="row g-2">
    <div class="col-sm">
        <div class="form-group">

            <div class="col-sm-3">
                <label for="STRNSS" class=" control-label">NSS: </label>
                <input type="text" required class="form-control" id="STRNSS" name="STRNSS" placeholder="NSS: " pattern="^(\d{2})(\d{2})(\d{2})\d{5}$" title="El NSS debe tener 11 dígitos." onchange="validarExistencia(this.value,'tblcatemp','STRNSS')" value="<?php echo $STRNSS ?>">
                <span id="MSTRNSS"></span>
            </div>

            <div class="col-sm-3">
                <label for="STRRFC" class=" control-label">RFC: </label>
                <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: " pattern="^([A-ZÑ&]{3,4})(\\d{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z|\\d]{3})$" onchange="validarExistencia(this.value,'tblcatemp','STRRFC')" value="<?php echo $STRRFC ?>">
                <span id="MSTRRFC"></span>
            </div>


            <div class="col-sm-3">
                <label for="apellido" class=" control-label">CURP: </label>
                <input type="text" required class="form-control" id="STRCUR" name="STRCUR" placeholder="CURP: " onchange="validarExistencia(this.value,'tblcatemp','STRCUR')" value="<?php echo $STRCUR ?>">
                <span id="MSTRCUR"> </span>
            </div>


            <div class="col-sm-3">
                <label for="usuario" class=" control-label">Nombre: </label>
                <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios" value="<?php echo $STRNOM ?>">
            </div>
            <div class="col-sm-3">
                <label for="email" class=" control-label">Apellidos: </label>
                <input type="text" required class="form-control" id="STRAPE" name="STRAPE" placeholder="Apellidos: " pattern="^[A-Za-z\s]+$" title="El nombre debe contener solo letras y espacios" value="<?php echo $STRAPE ?>">
            </div>
            <div class="col-sm-3">
                <label for="registro" class=" control-label">Telefono: </label>
                <input type="text" class="form-control" id="STRTEL" name="STRTEL" placeholder="Telefono: " required value="<?php echo $STRTEL ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <label for="localidad" class=" control-label">Localidad: </label>
                <input type="text" required class="form-control" id="STRLOC" name="STRLOC" placeholder="Localidad: " value="<?php echo $STRLOC ?>">
            </div>
            <div class="col-sm-4">
                <label for="telefono" class=" control-label">Municipio</label>
                <input type="text" required class="form-control" id="STRMUN" name="STRMUN" placeholder="Municipio" value="<?php echo $STRMUN ?>">
            </div>


            <div class="col-sm-4">
                <label for="celular" class=" control-label">Estado: </label>
                <input type="text" required class="form-control" id="STREST" name="STREST" placeholder="Estado: " value="<?php echo $STREST ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <label for="password" class=" control-label">Domicilio: </label>
                <input type="text" required class="form-control" id="STRDOM" name="STRDOM" placeholder="Domicilio" value="<?php echo $STRDOM ?>">
            </div>
            <div class="col-sm-4">
                <label for="registro" class=" control-label">Codigo Postal: </label>
                <input type="text" required class="form-control" id="STRCP" name="STRCP" placeholder="Codigo: " value="<?php echo $STRCP ?>">
            </div>


            <div class="col-sm-4">
                <label for="registro" class=" control-label">Pais: </label>
                <input type="text" class="form-control" id="STRPAI" name="STRPAI" placeholder="Pais: " required value="<?php echo $STRPAI ?>">
            </div>
        </div>

    </div>

    <div class="col-sm">
        <div class="form-group">

        


           
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <label for="registro" class=" control-label">Correo Electronico: </label>
                <input type="email" class="form-control" id="STRCOR" name="STRCOR" placeholder="Email: " onchange="validarExistencia(this.value,'tblcatemp','STRCOR')" required value="<?php echo $STRCOR ?>">
                <span id="MSTRCOR"> </span>
            </div>


            <div class="col-sm-4">
                <label for="registro" class=" control-label">Contraseña: </label>
                <input type="password" class="form-control" id="STRPWS" name="STRPWS" placeholder="Contraseña: ">
            </div>
            <div class="col-sm-4">
                <label for="registro" class=" control-label">Estado: </label>
                <select class="form-control" name="BITSUS" id="BITSUS">
                    <option value="1" <?php if ($BITSUS == 1) echo "selected"; ?>>Activo</option>
                    <option value="2" <?php if ($BITSUS == 2) echo "selected"; ?>>Inactivo</option>
                </select>
            </div>
        </div>
    </div>




</div>
</div>
</div>