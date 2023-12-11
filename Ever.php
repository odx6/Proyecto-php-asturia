<?php

$datos = array(
    0 => array('id' => 15,


        'fk_invetario' => 25,
        'sku' => "prueba123",
        'referencia' => 12345678,
        'cantidad' => 2,
        'unidad' => 6,
        'precio' => 40000,
        'total' => 80000
    ),

    1 => array(
        'id' => 16,
        'fk_invetario' => 25,
        'sku' => 10055646544,
        'referencia' => 12345678,
        'cantidad' => 2,
        'unidad' => 6,
        'precio' => 4300,
        'total' => 8600
    ),

    2 => array(
        'id' => 17,
        'fk_invetario' => 25,
        'sku' => "prueba123",
        'referencia' => 12345678,
        'cantidad' => 2,
        'unidad' => 6,
        'precio' => 4300,
        'total' => 8600
    )
);

function  SeEncuentra($dato, $arrays)
{
    $flag = false;

    foreach ($arrays as $array) {


        if (in_array($dato, $array))  $flag = true;
    }
    echo $flag;
}

SeEncuentra("16", $datos);
