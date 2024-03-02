<?php
session_start();
if (in_array(4, $_SESSION['Habilidad']['registros'])) {

    require_once("../../../config/config.php");
    require_once("../../../config/funciones.php");

    if (isset($_GET["id"])) {
        $idempleado = $_SESSION['user_id'];
        $id = $_GET["id"];
        $id = intval($id);

        $sql = "SELECT * FROM logs where pk_registro='$id';";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {

            $datos = mysqli_fetch_array($query);

            //recuperar el nombre de la columna 
            $namesql = "SELECT COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '" . $datos['tabla'] . "' AND CONSTRAINT_NAME = 'PRIMARY';";
            $result = mysqli_query($con, $namesql);
            $nameColumn = mysqli_fetch_array($result);



            // $columnas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'taller' AND TABLE_NAME = 'tblcatcat';";

            //$columnas="SHOW COLUMNS FROM tblcatcat;";
            $columnas = "SELECT * FROM " . $datos['tabla'] . " WHERE " . $nameColumn['COLUMN_NAME'] . "='" . $datos['fk_registro'] . "';";
            $name = mysqli_query($con, $columnas);
            $columnas = mysqli_fetch_fields($name);
            $data = mysqli_fetch_array($name);
        }
        $valor = "view/resources/images/";
    } else {
        exit;
    }
}
?>

<p>Responsable :</p>
<p style="color:red"><?php consultarNombre($datos['fk_empleado'], 'tblcatemp', 'IDEMP', 'STRNOM');
                        echo " ";
                        consultarNombre($datos['fk_empleado'], 'tblcatemp', 'IDEMP', 'STRAPE'); ?></p>
<p>Tipo :</p>
<p style="color:red"><?php echo  $datos['Tipo'] ?></p>
<p>Tabla :</p>
<p style="color:red"><?php echo  $datos['tabla'] ?></p>
<p>Fecha y hora :</p>
<p style="color:red"><?php echo  $datos['fecha'] ?></p>


<table class="table table-bordered table-striped" style="font-size:xx-small">
    <thead>
        <tr>
            <?php
            foreach ($columnas as $columna) {
                echo '<th>' . $columna->name . '</th>';
            }
            ?>

        </tr>
    </thead>

    <tbody>
        <tr>
            <?php
            $arrayold = explode(",", $datos['sql']);
           // $arrayold = array_unique($arrayold);
            foreach ($arrayold as $x) {
                if (str_starts_with($x, $valor)) {
            ?>
                    <td>
                        <div>
                            <img width="50px" height="50px" src="<?php echo $x ?>" alt="Imagen Producto">
                        </div>
                    </td>
            <?php
                } else {
                    echo "<td> $x </td>";
                }
            }
            ?>
        </tr>
        <?php if ($datos['Tipo'] == "Actualizacion") { ?>
            <tr>

                <td>Actualizacion de datos</td>
            </tr>

        <?php } ?>

        <?php
        if (isset($datos['newvalue'])) {
            $arraynew = explode(",", $datos['newvalue']);
            //$arraynew = array_unique($arraynew);
            foreach ($arraynew as $x) {
                if (str_starts_with($x, $valor)) {
        ?>
                    <td>
                        <div>
                            <img width="50px" height="50px" src="<?php echo $x ?>" alt="Imagen Producto">
                        </div>
                    </td>
        <?php
                } else {
                    echo "<td> $x </td>";
                }
            }
        }
        ?>





    </tbody>


</table>