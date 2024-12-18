<?php
include("../is_logged.php");
require_once("../../../config/config.php");

    $FolioProximo="SELECT MIN(valor + 1) AS siguiente
    FROM (
        SELECT valor
        FROM folios
        UNION
        SELECT 0 AS valor 
        UNION
        SELECT MAX(valor) + 1  
        FROM folios
    ) AS folios_disponibles
    WHERE valor + 1 NOT IN (SELECT valor FROM folios)";
    $query_folio = mysqli_query($con, $FolioProximo);

    $dato= mysqli_fetch_array($query_folio);
    $dato=str_pad($dato['siguiente'],6,'0',STR_PAD_LEFT);

     echo $dato;


   

