<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once("../../../config/config.php");
require_once("../../../config/funciones.php");
require_once("../../../config/RecuperarDatos.php");

if (isset($_REQUEST["id"])) { //codigo para eliminar 
    $id = $_REQUEST["id"];

    $sql2 = recuperarDatos("SELECT * from  tblcattik  WHERE STRPTIK='$id'");
    try {
        if (($delete = mysqli_query($con, "DELETE FROM  tblcattik  WHERE STRPTIK='$id'"))) {
            $messages[] = "Bien hecho!";
            $msj = "Datos eliminados .";
            $classM = "alert alert-success";
            $times = "&times;";
            if ($delete) {
                $tabla = "tblcattik";
                $tipo = "Eliminacion";
                $fecha = date("Y-m-d H:i:s");

                $sqllog = "INSERT INTO `logs`( `fk_empleado`, `fk_registro`, `tabla`, `Tipo`, `fecha`, `sql`) VALUES('" . $_SESSION['user_id'] . "','" . $id . "','" . $tabla . "','" . $tipo . "','" . $fecha . "','" . $sql2 . "');";
                $query = mysqli_query($con, $sqllog);
            }
        } else {
            $aviso = "Aviso!";
            $msj = "Error al eliminar los datos " . mysqli_error($con);
            $classM = "alert alert-danger";
            $times = "&times;";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            $aviso = "Aviso!";
            $msj = "El dato que intentas eliminar tiene relacion con otros registros por favor verifica que no dependa de otros registros Codigo de Error:" . $e->getCode();
            $classM = "alert alert-danger";
            $times = "&times;";
        } else {
            $aviso = "Aviso!";
            $msj = "Error al eliminar los datos " . $e->getMessage() . " " . $e->getCode();
            $classM = "alert alert-danger";
            $times = "&times;";
        }
    }
    if (isset($errors)) {

        ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong>
                <?php
                foreach ($errors as $error) {
                    echo $error."<br>";
                }
                ?>
            </div>
        <?php
        }
        if (isset($messages)) {
        
        ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Bien hecho!</strong>
                <?php
                foreach ($messages as $message) {
                    echo $message."<br>";
                }
                ?>
            </div>
        <?php
        }
}
?>