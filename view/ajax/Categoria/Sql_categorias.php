<?php
    include("../is_logged.php");
    require_once ("../../config/config.php");

    $resultado = $con->query('SELECT * FROM categorias');
    $categorias = array();
    while ($fila = $resultado->fetch_assoc()) {
        $categorias[] = array('id' => $fila['id'], 'nombre' => $fila['nombre']);
    }
    echo json_encode($categorias);
?>