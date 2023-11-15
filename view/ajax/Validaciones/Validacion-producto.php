<?php
include("../is_logged.php"); //Archivo comprueba si el usuario esta logueado
if (empty($_POST['categoria'])) {
    $errors[] = "categoria está vacío.";
} elseif (
    !empty($_POST['categoria'])

) {
    require_once("../../../config/config.php"); //Contiene las variables de configuracion para conectar a la base de datos


    $sku = mysqli_real_escape_string($con, (strip_tags($_POST["categoria"], ENT_QUOTES)));



    $sql =  "SELECT * FROM `tblcatpro` WHERE STRSKU=10005631120;";
    $query_new = mysqli_query($con, $sql);


    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM `tblcatpro` where STRSKU=" . $sku . " ");
    if ($row = mysqli_fetch_array($count_query)) {
        $numrows = $row['numrows'];
    } else {
        echo mysqli_error($con);
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