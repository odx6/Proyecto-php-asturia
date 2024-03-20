<?php

use FontLib\Table\Type\head;

require '../vendor/autoload.php';
require '../config/config.php';
session_start();

date_default_timezone_set('America/Mexico_City');



class MYPDF extends TCPDF
{



    //Page header
    public function Header()
    {

        $this->SetFont('helvetica', 'B', 15);
        // Title
        $this->Cell(0, 10, 'Fernanda Asturias S.A de C.V', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 5, 'Av.Simbolos Patrios No.520 San Agustin de las Juntas ,Oaxaca', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        // $this->SetFont('helvetica', 'B', 8);
        // $this->Cell(0, 5, 'Reporte de existencia General -Bodega 25  de 27/12/2023-al 27/12/2023 Estado: Normal', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Ln();
        // Obtiene la posición actual
        $x = $this->GetX();
        $y = $this->GetY();

        // Dibuja una línea bajo el título
        $this->SetLineWidth(0.25); // Establece el grosor de la línea
        $this->Line($x, $y + 2, $x + $this->getPageWidth() - $this->lMargin - $this->rMargin, $y + 2); // Dibuja una línea


    }

    // Page footer
    public function Footer()
    {
        $this->SetY(-15);
        // Establece el grosor de la línea
        $this->SetLineWidth(0.25);
        // Establece el color de la línea (opcional)
        $this->SetDrawColor(0, 0, 0);
        // Dibuja una línea horizontal
        $this->Line(10, $this->GetY(), $this->getPageWidth() - 10, $this->GetY());

        // Posiciona la primera sección
        $this->SetY(-15);
        // Establece la fuente para la primera sección
        $this->SetFont('helvetica', '', 8);
        // Imprime la primera sección
        $this->Cell(0, 10,  'Pagina' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' ' . $_SESSION['NOMBREUSER'], 0, false, 'L', 0, '', 0, false, 'T', 'M');


        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, $_SESSION['NOMBREMPRESA'], 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // Posiciona la tercera sección
        $this->SetY(-15);
        // Establece la fuente para la tercera sección
        $this->SetFont('helvetica', '', 8);
        // Imprime la tercera sección
        $this->Cell(0, 10,  ' ' . $_SERVER['SERVER_NAME'] . ' ' . date("Y-m-d H:i:s"), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$fechainicial = $_POST['Inicio'];
$fechaFinal = $_POST['Final'];
$Tipo = $_POST['Tipo'];


($Tipo == 1) ? $aux = "General" : $aux = "Detallada";


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);


$pdfname = 'Reporte ' . $aux . ' de compras del  ' . $fechainicial . ' al ' . $fechaFinal;
$pdf->SetAuthor('Fernanda Asturias');
$pdf->SetTitle($pdfname);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);

// add a page

// ---------------------------------------------------------

//Close and output PDF document


//============================================================+
// END OF FILE


$pdf->AddPage('L', 'A4');
$pdf->SetFont('helvetica', '', 10);
$filas = "";
$productos = "";


// set some text to print

// print a block of text using Write() 






$txt = <<<EOD
Reporte de existencia $aux  del $fechainicial al $fechaFinal 


EOD;
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);


if ($Tipo == 1) {

    $query = mysqli_query($con, "SELECT tblcom.*, tblcatprov.STRNOM AS nameProveedor, tblcatemp.STRNOM as nameEmpleado FROM ((tblcom INNER JOIN tblcatprov ON tblcom.FK_PROVE=tblcatprov.pk_prov ) INNER JOIN tblcatemp ON tblcom.FK_EMP=tblcatemp.IDEMP) WHERE tblcom.DTHOR >='$fechainicial' AND tblcom.DTHOR<='$fechaFinal';");





    while ($row = mysqli_fetch_array($query)) {
        $FK_COM = $row["PK_COMPRA"];
        $FK_PROVE = $row["FK_PROVE"];
        $nombreprove = $row['nameProveedor'];

        $FK_EMP = $row["FK_EMP"];
        $nameempleado = $row['nameEmpleado'];
        $STREMI = $row["STREMI"];
        $STRFACT = $row["STRFACTURA"];
        $DTHORFAC = $row["DTHORFAC"];
        $DTHOTPAG = $row["DTHORPAG"];
        $DTHOR = $row["DTHOR"];



        $filas .= "
            <tr>
                
                
                <td > $FK_COM</td>
                <td> $nombreprove</td>
                <td>   $nameempleado  </td>
                <td> $STREMI</td>
                <td> $STRFACT</td>
                <td>  $DTHORFAC</td>
                <td>   $DTHOTPAG </td>
                <td>    $DTHOR  </td>
               
                
                
           
            </tr>
        ";
    }
} else {
    $consulta = "SELECT tblcom.*, tblcatprov.STRNOM AS nameProveedor, tblcatemp.STRNOM as nameEmpleado FROM ((tblcom INNER JOIN tblcatprov ON tblcom.FK_PROVE=tblcatprov.pk_prov ) INNER JOIN tblcatemp ON tblcom.FK_EMP=tblcatemp.IDEMP) WHERE tblcom.DTHOR>='$fechainicial' AND tblcom.DTHOR <='$fechaFinal';";
    $query = mysqli_query($con, $consulta);
    while ($row = mysqli_fetch_array($query)) {


        $PK_COMPRA = $row["PK_COMPRA"];
        $FK_PROVE = $row["FK_PROVE"];
        $nombreprove = $row['nameProveedor'];
        $FK_EMP = $row["FK_EMP"];
        $nameempleado = $row['nameEmpleado'];
        $STREMI = $row["STREMI"];
        $STRFACT = $row["STRFACTURA"];
        $DTHORFAC = $row["DTHORFAC"];
        $DTHOTPAG = $row["DTHORPAG"];
        $DTHOR = $row["DTHOR"];








        $filas .= '
        <tr>
            
            
        <td colspan="10">' . ' <div>IDCOMPRA : ' . $PK_COMPRA . ' FECHA : ' . $DTHOR . ' PROVEEDOR  : ' . $nombreprove . ' EMPLEADO: ' . $nameempleado . ' REMISION : ' . $STREMI . ' FACTURA : ' . $STRFACT . ' F/FACTURA : ' . $DTHORFAC . ' F/PAGO : ' . $DTHOTPAG . '</div> <hr> </td>
           
           
            
            
       
        </tr>';

        
        $detalle = "SELECT tbldetcom.*,tblcatuni.STRNOMUNI, tblcatpro.STRDESPRO FROM `tbldetcom` INNER JOIN tblcatuni on tbldetcom.FK_UNI=tblcatuni.INTIDUNI INNER JOIN tblcatpro ON tbldetcom.FK_SKU=tblcatpro.STRSKU WHERE tbldetcom.FK_COM='$PK_COMPRA';";
        $querydetalle = mysqli_query($con, $detalle);
        $total = 0;
        while ($row2 = mysqli_fetch_array($querydetalle)) {
            
            $FK_SKU = $row2["FK_SKU"];
            $STRDESPRO = $row2["STRDESPRO"];
            $INTCANT = $row2["INTCANT"];
            $STRNOMUNI = $row2["STRNOMUNI"];
            $PCRCOST = $row2["PCRCOST"];
            $PCRCOSTANTE = $row2["PCRCOSTANTE"];
            $TOTAL = $row2["TOTAL"];
            $total +=$TOTAL;
            $PCRCOST = "$" . number_format($PCRCOST, 2, '.', ',');
            $PCRCOSTANTE = "$" . number_format($PCRCOSTANTE, 2, '.', ',');
            $TOTAL = "$" . number_format($TOTAL, 2, '.', ',');
           


            $filas .= '<tr>
            <td style="text-align: center">' . $INTCANT . '</td>
            <td style="text-align: left">' . $STRNOMUNI . '</td>
            <td style="text-align: left">' . $FK_SKU . '</td>
            <td colspan="5">' . $STRDESPRO . '</td>
                <td style="text-align: right">   ' . $PCRCOST . ' </td>
                <td style="text-align: right">' . $TOTAL . '</td>
                
               </tr>
            
            ';
            
        }
        $total = "$" . number_format($total, 2, '.', ',');

        $filas.='<tr><hr> <td colspan="10" style="text-align:right; "  > Total Compra : </td> </tr> <tr> <td colspan="10" style="text-align:right; margin-bottom:15px; " > <div > <u>' . $total . ' </u></div></td> </tr>
        
        ';
        
    }
}




if ($Tipo == 1) {

    $pdf->writeHTML('<table border="1">
<thead>
    <tr>
       

        <th style="background-color:orange ;">#id compra</th>
        <th style="background-color:orange ;">Proveedor</th>
        <th style="background-color:orange ;">Empleado</th>
        <th style="background-color:orange ;">Remision</th>
        <th style="background-color:orange ;">Facturas</th>
        <th style="background-color:orange ;">Fecha de la factura</th>
        <th style="background-color:orange ;">Fecha Pago</th>
        <th style="background-color:orange ;">Fecha de creacion</th>
        
       
    </tr>
</thead>
<tbody>' . $filas . '
</tbody>
</table>');
} else {
    $pdf->writeHTML('<table>
<thead>
    <tr>
       

        
        <th style="background-color:orange; text-align: center;">Cantidad</th>
        <th style="background-color:orange; text-align: center;">Medida</th>
        <th style="background-color:orange; text-align: center;">SKU</th>
        <th style="background-color:orange; text-align: center;" colspan="5">Descripcion del producto</th>
        <th style="background-color:orange; text-align: center;">P/U</th>
        <th style="background-color:orange; text-align: center;"  >P/T</th>
     
       
    </tr>
</thead>
<tbody>' . $filas . '
</tbody>
</table>');
}







// Obtener el PDF como una cadena base64
$pdfData = $pdf->Output('Reporte.pdf', 'S');

// Codificar el PDF en base64 para enviarlo al cliente
$pdfBase64 = base64_encode($pdfData);

// Devolver el PDF codificado en base64
echo $pdfBase64;
