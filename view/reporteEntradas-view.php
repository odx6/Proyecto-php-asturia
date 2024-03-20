<?php
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
$movi = $_POST['Tabla'];

($Tipo == 1) ? $aux = "General" : $aux = "Detallada";


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);


$pdfname='Reporte '.$aux.' de entradas y salidas del '.$fechainicial.' al '.$fechaFinal;
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
$pdf->SetFont('times', '', 10);
$filas = "";


// set some text to print

// print a block of text using Write()






$txt = <<<EOD
Reporte de existencia $aux  del $fechainicial al $fechaFinal 


EOD;
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);


if ($Tipo == 1) {

    $query = mysqli_query($con, "SELECT tblcatemp.STRNOM ,tblcatemp.STRAPE , tblcattop.STRNOMTPO , tblcatalm.STRNOMALM ,tblinv.* FROM `tblinv` INNER JOIN tblcatemp ON tblinv.IDEMP=tblcatemp.IDEMP INNER JOIN tblcattop ON tblcattop.INTIDTOP= tblinv.INTIDTOP INNER JOIN tblcatalm ON tblcatalm.INTIDALM=tblinv.INTALM WHERE DTEFEC >= '$fechainicial' AND DTEFEC <= '$fechaFinal'AND INTTIPMOV='$movi';");





    while ($row = mysqli_fetch_array($query)) {
        $INTIDINV = $row['INTIDINV'];
        $DTEFEC = $row['DTEFEC'];
        $INTIDTOP = $row['INTIDTOP'];
        $STRNOMTPO = $row['STRNOMTPO'];

        $INTTIMOV = $row['INTTIPMOV'];
        $INTFOL = $row['INTFOL'];
        $IDEMPLE = $row['IDEMP'];
        $STRNOM     = $row['STRNOM'];
        $STRAPE     = $row['STRAPE'];
        $STROBS = $row['STROBS'];
        $DTEHOR = $row['DTEHOR'];
        $INTALM = $row['INTALM'];
        $STRNOMALM = $row['STRNOMALM'];
        $DTEHOR = $row['DTEHOR'];

        ($INTTIMOV == 1) ? $aux = "Entrada" : $aux = "Salida";
        $NOMBRE = $STRNOM . " " . $STRAPE;

        $filas .= "
            <tr>
                
                
                <td style='font-size:x-small;'> $INTIDINV</td>
                <td> $DTEFEC</td>
                <td> $STRNOMTPO</td>
                <td> $aux</td>
                <td> $INTFOL</td>
                <td> $NOMBRE  </td>
                <td> $STRNOMALM  </td>
                <td> $STROBS  </td>
                <td> $DTEHOR  </td>
               
                
                
           
            </tr>
            ";
    }
} else {




    $query = mysqli_query($con, "SELECT tblcatemp.STRNOM ,tblcatemp.STRAPE , tblcattop.STRNOMTPO , tblcatalm.STRNOMALM ,tblinv.* FROM `tblinv` INNER JOIN tblcatemp ON tblinv.IDEMP=tblcatemp.IDEMP INNER JOIN tblcattop ON tblcattop.INTIDTOP= tblinv.INTIDTOP INNER JOIN tblcatalm ON tblcatalm.INTIDALM=tblinv.INTALM WHERE DTEFEC >= '$fechainicial' AND DTEFEC <= '$fechaFinal'AND INTTIPMOV='$movi';");





    while ($row = mysqli_fetch_array($query)) {
        $INTIDINV = $row['INTIDINV'];
        $DTEFEC = $row['DTEFEC'];
        $INTIDTOP = $row['INTIDTOP'];
        $STRNOMTPO = $row['STRNOMTPO'];

        $INTTIMOV = $row['INTTIPMOV'];
        $INTFOL = $row['INTFOL'];
        $IDEMPLE = $row['IDEMP'];
        $STRNOM     = $row['STRNOM'];
        $STRAPE     = $row['STRAPE'];
        $STROBS = $row['STROBS'];
        $DTEHOR = $row['DTEHOR'];
        $INTALM = $row['INTALM'];
        $STRNOMALM = $row['STRNOMALM'];
        $DTEHOR = $row['DTEHOR'];

        ($INTTIMOV == 1) ? $aux = "Entrada" : $aux = "Salida";
        $NOMBRE = $STRNOM . " " . $STRAPE;

        $filas .= '
            <tr>
                
                
                <td colspan="11"  ><div>IDINVENTARIO : '.$INTIDINV.' FECHA : '.$DTEFEC.' FOLIO :  '.$INTFOL.' DESC :'.$STROBS.' ALMACEN : '.$STRNOMALM.' EMPLEADO : '.$NOMBRE.' </div>   <hr> </td>
               
               
                
                
           
            </tr>
            ';
            $consulta2="SELECT tblinvdet.*, tblcatpro.STRDESPRO, tblcatuni.STRNOMUNI FROM `tblinvdet` INNER JOIN tblcatpro ON tblcatpro.STRSKU= tblinvdet.SKU INNER JOIN tblcatuni ON tblcatuni.INTIDUNI=tblinvdet.INTIDUNI WHERE tblinvdet.INTIDINV='$INTIDINV';";
            $query2 = mysqli_query($con, $consulta2);
            $total = 0;
        
        
            while ($row2 = mysqli_fetch_array($query2)) {
                $INTIDINV = $row2['INTIDINV'];
                $DTEFEC = $row2['DTEHOR'];
               
                $SKU = $row2['SKU'];
                $STRDESPRO = $row2['STRDESPRO'];
                $STRREF = $row2['STRREF'];
                $INTCAN = $row2['INTCAN'];
                $STRNOMUNI = $row2['STRNOMUNI'];
                $MONPRCOS = $row2['MONPRCOS'];
                $MONCTOPRO = $row2['MONCTOPRO'];
                $total +=$MONCTOPRO;
              
                $MONPRCOS="$". number_format($MONPRCOS, 2, '.', ',');
                $MONCTOPRO="$". number_format($MONCTOPRO, 2, '.', ',');
        
                $filas .= '
                    <tr>
                        
                        
                        <td style="text-align: center">'. $INTCAN.'</td>
                        <td style="text-align: left">'.$STRNOMUNI.'</td>
                        <td style="text-align: left">'.$SKU.'</td>
                        <td colspan="5" style="text-align: left">'.$STRDESPRO.'</td>
                        <td style="text-align: right">'.$MONPRCOS.'</td>
                        <td style="text-align: right">'.$MONCTOPRO.'</td>
                       
                       
                        
                        
                   
                    </tr>
                    ';
                   
            }
            $total = "$" . number_format($total, 2, '.', ',');

            $filas.='<tr> <hr><td colspan="10" style="text-align:right; margin-bottom:15px; " > <div > <u> Total ' .$aux.'   :  '.  $total . ' </u></div></td> </tr>
            
            ';


    }

   
   
}


if ($Tipo == 1 ) {

    $pdf->writeHTML('<table border="1">
<thead>
    <tr>
       

        <th style="background-color:orange ;">#id inventario</th>
        <th style="background-color:orange ;">Fecha</th>
        <th style="background-color:orange ;">tipo</th>
        <th style="background-color:orange ;">moviemiento</th>
        <th style="background-color:orange ;">Folio</th>
        <th style="background-color:orange ;">empleado</th>
        <th style="background-color:orange ;">almacen</th>
        <th style="background-color:orange ;">Descripcion</th>
        <th style="background-color:orange ;">Fecha-Hora</th>

       
    </tr>

</thead>
<tbody>' . $filas . '
</tbody>
</table>');
} else {
    $pdf->writeHTML('<table >
<thead>
    <tr border="1">
       

        
        <th style="background-color:orange; text-align: center;" >Cantidad</th>
        <th style="background-color:orange; text-align: center" >Medida</th>
        <th style="background-color:orange; text-align: center" >SKU</th>
        <th colspan="5" style="background-color:orange; text-align: center" >Descripcion del producto</th>
        <th style="background-color:orange; text-align: center">P/U</th>
        <th style="background-color:orange; text-align: center">P/T</th>
       

       
    </tr>
    <tr> 
    <td>&nbsp;</td>
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
