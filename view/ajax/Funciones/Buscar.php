<?php
include("../is_logged.php");
require_once("../../../config/config.php");
$columna = mysqli_real_escape_string($con, (strip_tags($_POST["columna"], ENT_QUOTES)));
$tabla = mysqli_real_escape_string($con, (strip_tags($_POST["tabla"], ENT_QUOTES)));
$valor = mysqli_real_escape_string($con, (strip_tags($_POST["campo"], ENT_QUOTES)));

if (isset($columna) && isset($tabla) && isset($valor)) {

    $sql = "SELECT * FROM $tabla WHERE $columna LIKE '%$valor%';";
    $query_new = mysqli_query($con, $sql);
    $resultados = array();

    // Recorre los resultados y los agrega al arreglo
    while ($fila = mysqli_fetch_assoc($query_new)) {
        $resultados[] = $fila;
    }

    // Convierte el arreglo a JSON
    $json = json_encode($resultados);

    // Imprime el JSON
    echo $json;
}
