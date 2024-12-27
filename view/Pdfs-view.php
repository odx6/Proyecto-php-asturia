<?php
$active2 = "active";

require_once("./config/config.php");
require_once("./config/funciones.php");
//Archivo comprueba si el usuario esta logueado	
include_once "./vendor/autoload.php";

use Dompdf\Dompdf;


if (!isset($_SESSION['user_id']) | empty($_POST["id"])) {
    header("location: ./?view=index"); //Redirecciona 
    exit;
}
if ($_SESSION['solicitud'] == 1) {
   if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $id = intval($id);
        $sql = "select * from tblcatslc where 	LNGIDNSLC='".$id."';";
        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            while ($rw = mysqli_fetch_array($query)) {
                $LNGIDNSLC = $rw['LNGIDNSLC'];
                $LNGIDNUSR = $rw['LNGIDNUSR'];
                $INTFOLSLC = $rw['INTFOLSLC'];
                $INTFOLSLCE = $rw['INTFOLSLCE'];
                $DTFCHSLC = $rw['DTFCHSLC'];
                $LNGIDNCNT = $rw['LNGIDNCNT'];
                $LNGIDNORG = $rw['LNGIDNORG'];
                $STRNMRSR = $rw['STRNMRSR'];
                $STRKLM = $rw['STRKLM'];
                $STROBSRPT = $rw['STROBSRPT'];
                $STRDGN = $rw['STRDGN'];
                $LNGIDNMCN = $rw['LNGIDNMCN'];
                $DTFCHDGN = $rw['DTFCHDGN'];
                $BITCNCSLC = $rw['BITCNCSLC'];
            }
        }
    } else {
        exit;
    }
  
   

    $nombre = getDato($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRNOM');
    $apellido =getDato($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRAPE');
    $LICENCIA = getDato($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRNDL');
    $ORIGEN = getDato($LNGIDNORG, 'tblcatorg', 'LNGIDNORG', 'STRDSCORG');
    $ContactoN=getDato($LNGIDNCNT, 'tblcatemp', 'IDEMP', 'STRNOM'); 
    $ContactoA=getDato($LNGIDNCNT, 'tblcatemp', 'IDEMP', 'STRAPE');
    $ContactoTel=getDato($LNGIDNCNT, 'tblcatemp', 'IDEMP', 'STRTEL');
    $FolioG=getDato($INTFOLSLC,'tblcatfol','id_folio','folio');
    $FolioE=getDato($INTFOLSLCE,'tblcatfol','id_folio','folio');
    $MecanicoN=getDato($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRNOM');
    $MecanicoA=getDato($LNGIDNUSR, 'tblcatemp', 'IDEMP', 'STRAPE');
    $vigencia=getDato($LNGIDNCNT ,'tblcatemp', 'IDEMP', 'DTHLIC');

    // Fecha actual
$fecha_actual = time();

// Fecha a comparar (formato 'Y-m-d')
$fecha_vigencia = strtotime('vigencia');
$icon;

// Comparar fechas
if ($fecha_actual <= $fecha_vigencia) {
   $icon="<i class='fa-solid fa-check'></i>";
} else {
  $icon="<i class='fa-solid fa-xmark'></i>";
}

    
   
    //data vehiculo 
     $car="SELECT * FROM `tblcatveh`  WHERE STRNMRSR='".$STRNMRSR."' ";
     try {
		$cars = mysqli_query($con,$car);
	} catch (mysqli_sql_exception $e) {
		$errors[] = "Error de mysql" . $e->getMessage() . "codigo" . $e->getCode();
	}
    if($cars){
      $filas=mysqli_fetch_assoc($cars);

    }
    $tipo=getDato($filas['STRTPVH'], 'tbltpveh', 'STRTPVH', 'STRNOM');
    $OrigenVeh=getDato($filas['LNGIDNORG'], 'tblcatorg', 'LNGIDNORG', 'STRDSCORG');

    //
    $dompdf = new Dompdf();
    $NoOrden = 4;
    $html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
  <style>
    *{margin:0;
    
}

    body {
      
      font-family: sans-serif;
      font-size:16px;
    }

    div.page {
      margin: 10mm;
      padding: 10mm;
      border: 0.5pt solid gray;
    }

    div.bgcolor {
      background-color: #e0e0e0;
      line-height: 170%;
    }
    td{
    border-bottom:1px solid rgb(10, 10, 10);

}
    
  </style>
</head>

<body>
  <div class="page">
    <h2>SOLICITUD DE INGRESO A TALLER N° '.$FolioG.'</h2>



 
    <table >
      <tbody>
        <tr>
          <td>
            <p style="background:rgb(15, 15, 15); line-height:170%; color: #e0e0e0; " >FECHA DE <br> SOLICITUD</p>
          </td>
          <td style="border-top:1px solid  rgb(10, 10, 10) ">'.$DTFCHSLC.'</td>
        </tr>
      </tbody>
    </table>



 
    <p style="background:rgb(15, 15, 15); line-height:170%; color: #e0e0e0; text-align: center;">DATOS DEL SOLICITANTE
    </p>
    <table style="width: 100%;">
      <tbody>
        <tr class="line">
          <td  style=" width: 20%;">NOMBRE</td>
          <td colspan="4">'.$nombre."  ".$apellido.'</td>
        </tr>
        <tr style="border-top: 0.5pt solid black;">
          <td style=" width: 20%;">LICENCIA</td>
          <td >'.$LICENCIA.'</td>
          <td style=" width: 20%;">VIGENCIA</td>
          <td >'.$vigencia.' '.$icon.'</td>
        </tr>
        <tr>
          <td style=" width: 20%;">ORIGEN</td>
          <td colspan="4">'.$ORIGEN."-".$FolioE.'</td>
        </tr>
        <tr>
          <td style=" width: 20%;">CONTACTO</td>
          <td colspan="4">'.$ContactoN." ".$ContactoA.'-'.$ContactoTel.'</td>
        </tr>
         <tr>
          <td style=" width: 20%;" rowspan="10">FIRMA</td>
          <td colspan="4" rowspan="10"></td>
        </tr>
    
         

      </tbody>
    </table>
    <p style="background:rgb(15, 15, 15); line-height:170%; color: #e0e0e0; text-align: center;">DATOS DEL JEFE DE AREA
    </p>
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td style=" width: 20%;">NOMBRE</td>
          <td style="width=100%"></td>
        </tr>
     
       
        <tr >
          <td style=" width: 20%;">CONTACTO</td>
         <td ></td>
        </tr>
           <tr>
          <td style=" width: 20%;" rowspan="10" >FIRMA</td>
          <td  rowspan="10"></td>
        </tr>

      </tbody>
    </table>
    <p style="background:rgb(15, 15, 15);  color: #e0e0e0; text-align: center;">DATOS DE LA UNIDAD
    </p>
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td style=" width: 20%;">IDENTIFICADOR</td>
          <td>'.$STRNMRSR.'</td>
        </tr>
        <tr> 
          <td style=" width: 20%;">NUMERO</td>
          <td>'.$filas['STRNMR'].'</td>
        </tr>
        <tr>
          <td style=" width: 20%;">KILOMETRAJE</td>
          <td>'.$STRKLM.'</td>
        </tr>
        <tr>
          <td style=" width: 20%;">MARCA</td>
          <td>'.$filas['STRMRC'].'</td>
        </tr>
        <tr>
          <td style=" width: 20%;">TIPO</td>
          <td>'.$tipo.'</td>
        </tr>
        <tr>
          <td style=" width: 20%;">ORIGEN</td>
          <td>'.$OrigenVeh.'</td>
        </tr>
        
       

      </tbody>
    </table>
    <p style="background:rgb(15, 15, 15); line-height:170%; color: #e0e0e0; text-align: center;">DESCRIPCIÓN DE FALLAS O DESPERFECTOS DETECTADOS 
    </p>

    <TEXtarea style="width: 100% ;"  rows="70">'.$STRDGN.'</TEXtarea>
    <p style="background:rgb(15, 15, 15); line-height:170%; color: #e0e0e0; text-align: center;">ORDEN DE TRABAJO RECONOCIDA POR
    </p>
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td style=" width: 20%;">NOMBRE</td>
          <td>'.$MecanicoN."  ".$MecanicoA.'</td>
        </tr>
     
        <tr>
          <td style=" width: 20%;">FECHA</td>
          <td style="width:100%">'.$DTFCHDGN.'</td>
        </tr>
        <tr>
          <td style=" width: 20%;" rowspan="10">FIRMA</td>
          <td colspan="2" rowspan="10"></td>
        </tr>
      </tbody>
    </table>


</body>

</html>
';

    $dompdf->loadHtml($html);
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=documento.pdf");
    echo $dompdf->output();
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();