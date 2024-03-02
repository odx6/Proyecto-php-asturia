<?php
include("../is_logged.php");
require_once("../../../config/config.php");
if (isset($_REQUEST["id"])) { //codigo para eliminar 
    $id = $_REQUEST["id"];
    $id = intval($id);
    $resultado = $con->query('SELECT * FROM `tbldetcom` INNER JOIN tblcatpro ON tbldetcom.FK_SKU=tblcatpro.STRSKU WHERE FK_COM=' . $id . ';');
    $productos = array();
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = array('PK_DETCOM' => $fila['PK_DETCOM'],'STRDES'=>$fila['STRDESPRO'],'FK_SKU' => $fila['FK_SKU'],'INTCANT' => $fila['INTCANT'],'FK_UNI' => $fila['FK_UNI'],'PCRCOST' => $fila['PCRCOST'],'PCRCOSTANTE' => $fila['PCRCOSTANTE'],'TOTAL' => $fila['TOTAL'],'DTHOR' => $fila['DTHOR']);
    }
    echo json_encode($productos);

}