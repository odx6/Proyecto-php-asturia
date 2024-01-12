<?php
session_start();
require_once("../../../config/config.php");
if(in_array(4,$_SESSION['Habilidad']['Empleados'])){

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
<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="<?php echo $STRIMG ?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title" > <strong>IDENTIFICADOR</strong> : <?php echo $IDEMP; ?> </h5>
                <p class="card-text"><strong>NSS :</strong> <?php echo $STRNSS; ?> </p>
                <p class="card-text"><strong>RFC :</strong> <?php echo $STRRFC; ?> </p>
                <p class="card-text"><strong>CURP : </strong><?php echo $STRCUR ?> </p>
                <p class="card-text"><strong>NOMBRE :</strong> <?php echo $STRNOM; ?> </p>
                <p class="card-text"><strong>DOMICILIO : </strong><?php echo $STRDOM; ?> </p>
                <p class="card-text"><strong>LOCALIDAD :</strong> <?php echo $STRLOC; ?> </p>
                <p class="card-text"><strong>MUNICIPIO :</strong> <?php echo $STRMUN; ?> </p>
                <p class="card-text"><strong>ESTADO :</strong> <?php echo $STREST; ?> </p>
                <p class="card-text"><strong>CODIGO POSTAL :</strong> <?php echo $STRCP; ?> </p>
                <p class="card-text"><strong>PAIS :</strong> <?php echo $STRPAI; ?> </p>
                <p class="card-text"><strong>TELEFONO :</strong> <?php echo $STRTEL; ?> </p>
                <p class="card-text"><strong>CORREO :</strong> <?php echo $STRCOR; ?> </p>
                <p class="card-text"><small class="text-muted"> Fecha de creacion : <?php echo $CREATE_AT; ?></small></p>
                <p class="card-text"><strong>PERMISOS :</strong>  </p>
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
       

            
        </div>
    </div>


    
</div>
<?php  }?>