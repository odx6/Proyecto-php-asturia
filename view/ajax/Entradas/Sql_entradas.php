<?php
include("../is_logged.php");
require_once("../../../config/config.php");
if (isset($_REQUEST["id"])) { //codigo para eliminar 
    $id = $_REQUEST["id"];
    $id = intval($id);
    $resultado = $con->query('SELECT * FROM tblinvdet WHERE INTIDINV=' . $id . ';');
    $productos = array();
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = array('id' => $fila['INTIDDET'], 'fk_inventario' => $fila['INTIDINV'],'sku' => $fila['SKU'],'referencia' => $fila['STRREF'],'cantidad' => $fila['INTCAN'],'unidad' => $fila['INTIDUNI'],'precio' => $fila['MONPRCOS'],'total' => $fila['MONCTOPRO']);
    }
    echo json_encode($productos);
}