;

<?php
require './vendor/autoload.php';

date_default_timezone_set('America/Mexico_City');

use Dompdf\Dompdf;
use Dompdf\Options;

require_once("./config/config.php");
require_once("./config/funciones.php");
if (!isset($_SESSION['user_id']) | empty($_POST["ide"]) ){
    header("location: ./?view=index"); //Redirecciona 
    exit;
}

$dompdf = new Dompdf();
$filas = "";




if(isset($_REQUEST['ide']))$ID = $_REQUEST['ide'];



$sql = "SELECT * FROM tblinv WHERE INTIDINV='$ID';";
$fecha_actual = date('Y-m-d H:i:s');
$mov;
$query = mysqli_query($con, $sql);
$num = mysqli_num_rows($query);
if ($num == 1) {
    while ($row = mysqli_fetch_array($query)) {
        $INTIDINV = $row['INTIDINV'];
        $DTEFEC = $row['DTEFEC'];
        $INTIDTOP = $row['INTIDTOP'];
        $INTTIPMOV = $row['INTTIPMOV'];

        $INTFOL = $row['INTFOL'];
        $IDEMP = $row['IDEMP'];
        $STROBS = $row['STROBS'];
        $INTALM = $row['INTALM'];
        $DTEHOR = $row['DTEHOR'];

        ob_start();
        consultarNombre($INTALM, 'tblcatalm', 'INTIDALM', 'STRNOMALM');

        $alm = ob_get_clean();
        ob_start();
        consultarNombre($INTIDTOP, 'tblcattop', 'INTIDTOP', 'STRNOMTPO');

        $dtop = ob_get_clean();

        ob_start();
        consultarNombre($_SESSION['user_id'], 'tblcatemp', 'IDEMP', 'STRNOM');
        $emp = ob_get_clean();
    }
}

($INTTIPMOV == 1) ?  $mov = "Entrada" : $mov = "Salida";


$sql2 = "SELECT * FROM tblinvdet WHERE INTIDINV='$ID';";

$query2 = mysqli_query($con, $sql2);


while ($rw = mysqli_fetch_array($query2)) {
    $INTIDDET = $rw['INTIDDET'];
    $INTIDINV = $rw['INTIDINV'];
    $SKU = $rw['SKU'];
    $STRREF = $rw['STRREF'];
    $INTCAN = $rw['INTCAN'];
    $INTIDUNI = $rw['INTIDUNI'];
    $MONPRCOS = $rw['MONPRCOS'];
    $MONCTOPRO = $rw['MONCTOPRO'];
    $DTEHOR = $rw['DTEHOR'];

    ob_start();
    consultarNombre($INTIDUNI, 'tblcatuni', 'INTIDUNI', 'STRNOMUNI');

    $uni = ob_get_clean();

    ob_start();

    consultarNombre($SKU, 'tblcatpro', 'STRSKU', 'STRDESPRO');
    
        $DESCRIPCIONPRO= ob_get_clean();
        /*
        ob_start();
        consultarNombre($_SESSION['user_id'], 'tblcatemp', 'IDEMP', 'STRNOM');
        $emp= ob_get_clean();*/
    $MONPRCOS2 = number_format($MONPRCOS, 2, '.', ',');
    $MONCTOPRO2 = number_format($MONCTOPRO, 2, '.', ',');

    $filas .= "
    <tr>
        
        
        <td> $SKU</td>
        <td> $DESCRIPCIONPRO</td>
        <td> $STRREF</td>
        <td> $INTCAN</td>
        <td> $uni</td>
        <td> $ $MONPRCOS2  </td>
        <td> $ $MONCTOPRO2  </td>
        
   
    </tr>
    ";
}



$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <style>
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
            height: 100px;
            text-align: center;
            border-bottom: 2px solid black;
            font-size: x-small;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            
            text-align: center;
            border-top: 2px solid black;
            font-size: x-small
        }

      

        .pl {
            text-align: left;
            float: left;
        }

        .pr {
            text-align: right;
            float: right;
        }

        .pc {
            text-align: center;
            float: left;
            padding-left: 300px;

        }

        .mains {
            background-color: rgb(228, 146, 146);
           
            border:1px solid black;

        }
        .formato{
            width: 16%;
            float: left;
       
       background-color: green;
       

        }
     .tabla{
        //background-color: Yellow;
        width: 100%;
        float: buttom;
     }

     th{
        background-color: Orange;
        padding:8px;
        margin:15px;
        text-align: center;
        
     }
     .tabla td{

        border:.5px solid gray;
        padding:5px;
        text-align: left;
        font-size:x-small;
     }
     td{
        
        padding:5px;
        text-align: left;
        font-size:x-small;
        
     }

     .borde{

       // border: 1px solid black;
        text-align:center;
        background-color: #FCF3CF;
        border-radius:5% ;
      // border: 2px solid black;
     }
     h5{
        text-align:center;
        background-color:black;
        color:white;

     }   
     .saltopagina {page-break-after:always;}

     .datos{
       
       // background-color: #AED6F1 ;
       text-align:center;
     //  border-bottom: 2px solid black;
    
     }
       
    </style>


</head>

<body>

    <header>
        <h3> Fernanada Asturias S.A de C.V </h3>
        <p>Av.Simbolos Patrios No.520 San Agustin de las Juntas ,Oaxaca</p>
        <h4>Reporte de existencia General -Bodega-1-al 27/12/2023 Estado: Normal</h4>

    </header>
  

    <main>
    <h5>Datos del inventario</h5>
    <table style="width: 100%">
    <thead>
    
    
    </thead>
    <tbody>
    <tr>
    <td class="borde  ">ID</td>
    <td class="datos">' . $INTIDINV . '</td>
    <td class="borde"> FECHA</td>
    <td  class="datos">' . $DTEFEC . '</td>
    <td class="borde datos ">MOVIMIENTO</td>
    <td  class="datos">' . $dtop . '</td>
   
    
    
    </tr>
    <tr>
   
    <td class="borde datos "> TIPO</td>
    <td  class="datos">' . $mov . '</td>
    <td class="borde datos ">FOLIO</td>
    <td  class="datos">' . $INTFOL . '</td>
   
    <td class="borde datos ">EMPLEADO </td>
    <td  class="datos">' . $emp . '</td>
    
    
    
    </tr>
    <tr>
    
  
    <td class="borde datos " >DESCRIPCION</td>
    <td  class="datos">' . $STROBS . '</td>
    <td class="borde datos ">ALMACEN </td>
    <td  class="datos">' . $alm . '</td>
    <td class="borde datos ">FECHA DE CREACION</td>
    <td  class="datos">' . $DTEHOR . '</td>
    
    
    </tr>
    
    
    
    </tbody>
    </table>
   
   <h5>Detalle del inventario</h5>
    <div class="tabla">

    <table class="tabla" >
    <thead>
   
   
    <th>SKU</th>
    <th>DESCRIPCION</th>
    <th>REFERENCIA</th>
    <th>CANTIDAD</th>
    <th>UNIDAD</th>
    <th>PRECIO</th>
    <th>TOTAL</th>
  
   
    
    </thead>

    <tbody>
   ' . $filas . '
    

    
    </tbody>
    </table>
   
    
    </div>
     
     
     
    
   
    
    
        </main>
    
        <footer>


        <p class="pl">' . $emp . ' <br> Pagina 1</p>
        <p class="pc">Nombre Del Engargado <br> Gerente</p>
        <p class="pr">'. $_SERVER['SERVER_NAME'].' <br> ' . $fecha_actual . '</p>



    </footer>
      
   
</body>

</html>';

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream("nombre_del_archivo.pdf", array("Attachment" => 0));
?>