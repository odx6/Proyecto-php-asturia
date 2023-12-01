<?php
include("../is_logged.php");
require_once("../../../config/config.php");
if (isset($_REQUEST["categoria"])) { //codigo para eliminar 
    $id = $_REQUEST["categoria"];
    $id = intval($id);
    $resultado = $con->query('SELECT * FROM tblcatsbc WHERE INTIDCAT=' . $id . ';');
    $categorias = array();
    while ($fila = $resultado->fetch_assoc()) {
        $categorias[] = array('id' => $fila['INTIDSBC'], 'nombre' => $fila['STRNOMSBC']);
    }
    echo json_encode($categorias);
}
