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
<div class="form-group">
    <label for="dni" class="col-sm-2 control-label">NSS: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRNSS" name="STRNSS" placeholder="NSS: "  value="<?php echo $STRNSS ?>">
    </div>
</div>
<div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">RFC: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRRFC" name="STRRFC" placeholder="RFC: " value="<?php echo $STRRFC ?>">
    </div>
</div>
<div class="form-group">
    <label for="apellido" class="col-sm-2 control-label">CURP: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRCUR" name="STRCUR" placeholder="CURP: " value="<?php echo $STRCUR ?>">
    </div>
</div>
<div class="form-group">
    <label for="usuario" class="col-sm-2 control-label">Nombre: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRNOM" name="STRNOM" placeholder="Nombre: " value="<?php echo $STRNOM ?>">
    </div>
</div>
<div class="form-group">
    <label for="email" class="col-sm-2 control-label">Apellidos: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRAPE" name="STRAPE" placeholder="Apellidos: " value="<?php echo $STRAPE ?>">
    </div>
</div>
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">Domicilio: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRDOM" name="STRDOM" placeholder="Domicilio" value="<?php echo $STRDOM ?>">
    </div>
</div>

<div class="form-group">
    <label for="localidad" class="col-sm-2 control-label">Localidad: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="STRLOC" name="STRLOC" placeholder="Localidad: " value="<?php echo $STRLOC ?>">
    </div>
</div>
<div class="form-group">
    <label for="telefono" class="col-sm-2 control-label">Municipio</label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STRMUN" name="STRMUN" placeholder="Municipio" value="<?php echo $STRMUN ?>">
    </div>
</div>
<div class="form-group">
    <label for="celular" class="col-sm-2 control-label">Estado: </label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="STREST" name="STREST" placeholder="Estado: " value="<?php echo $STREST ?>">
    </div>
</div>
<div class="form-group">
    <label for="registro" class="col-sm-2 control-label">Codigo Postal: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="STRCP" name="STRCP" placeholder="Codigo: " value="<?php echo $STRCP ?>">
    </div>
</div>
<div class="form-group">
    <label for="registro" class="col-sm-2 control-label">Pais: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="STRPAI" name="STRPAI" placeholder="Pais: " value="<?php echo $STRPAI ?>">
    </div>
</div>
<div class="form-group">
    <label for="registro" class="col-sm-2 control-label">Telefono: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="STRTEL" name="STRTEL" placeholder="Telefono: " value="<?php echo $STRTEL ?>">
    </div>
</div>
<div class="form-group">
    <label for="registro" class="col-sm-2 control-label">Correo Electronico: </label>
    <div class="col-sm-10">
        <input type="email" class="form-control" id="STRCOR" name="STRCOR" placeholder="Email: " value="<?php echo $STRCOR ?>">

    </div>
</div>
<div class="form-group">
    <label for="registro" class="col-sm-2 control-label">Contraseña: </label>
    <div class="col-sm-10">
        <input type="password" class="form-control" id="STRPWS" name="STRPWS" placeholder="Contraseña: " >
    </div>
</div>

<div class="form-group">
    <label for="estado" class="col-sm-2 control-label">Estado: </label>
    <div class="col-sm-10">
        <select class="form-control" name="BITSUS" id="BITSUS">
            <option value="1" <?php if($BITSUS==1 ) echo "selected"; ?>>Activo</option>
            <option value="2" <?php if($BITSUS==2 ) echo "selected"; ?>>Inactivo</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="permisos" class="col-sm-2 control-label">Permisos: </label>
    <div class="col-sm-10">
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