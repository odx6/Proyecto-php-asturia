<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty($_POST['campo']) && empty($_POST['tabla']) && empty($_POST['columna'])) {
    $errors[] = "Los datos estan  vacíos.";
} elseif (
    !empty($_POST['campo']  && !empty($_POST['tabla']) && !empty($_POST['columna']))

) {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos


    $campo = mysqli_real_escape_string($con, (strip_tags($_POST["campo"], ENT_QUOTES)));
    $tabla = mysqli_real_escape_string($con, (strip_tags($_POST["tabla"], ENT_QUOTES)));
    $columna = mysqli_real_escape_string($con, (strip_tags($_POST["columna"], ENT_QUOTES)));



    $sql = "SELECT count(*) AS numrows FROM " . $tabla . "   WHERE   " . $columna . "=" . $campo . "; ";


    $count_query   = mysqli_query($con, $sql = "SELECT count(*) AS numrows FROM " . $tabla . " WHERE " . $columna . " = '" . $campo . "';");
    if ($row = mysqli_fetch_array($count_query)) {
        $numrows = $row['numrows'];
    } else {
        echo mysqli_error($con, $sql);
    }


    if ($numrows > 0) {
        echo "existe";
    } else {
        echo "noexiste";
    }
} else {
    $errors[] = "desconocido.";
}

if (isset($errors)) {

?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
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
            echo $message;
        }
        ?>
    </div>
<?php
}
?>