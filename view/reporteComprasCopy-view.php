<?php
require './vendor/autoload.php';



date_default_timezone_set('America/Mexico_City');



class MYPDF extends TCPDF
{



    //Page header
    public function Header()
    {

        $this->SetFont('helvetica', 'B', 15);
        // Title
        $this->Cell(0, 10, 'Fernanada Asturias S.A de C.V', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 5, 'Av.Simbolos Patrios No.520 San Agustin de las Juntas ,Oaxaca', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
      
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
        $this->Cell(0, 10,  'Pagina' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' Hola', 0, false, 'L', 0, '', 0, false, 'T', 'M');


        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, "Hola", 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // Posiciona la tercera sección
        $this->SetY(-15);
        // Establece la fuente para la tercera sección
        $this->SetFont('helvetica', '', 8);
        // Imprime la tercera sección
        $this->Cell(0, 10,  ' hola  ' . date("Y-m-d H:i:s"), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}



// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);



$pdf->SetAuthor('Fernanda Asturias');
$pdf->SetTitle('pdf');
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


$pdf->AddPage();
$pdf->SetFont('helvetica', 'BI', 8);



$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example
$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

// Multicell test
$pdf->MultiCell(55, 9, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(55, 5, '[RIGHT] '.$txt, 1, 'R', 0, 1, '', '', true);
$pdf->MultiCell(55, 5, '[CENTER] '.$txt, 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(55, 5, '[JUSTIFY] '.$txt."\n", 1, 'J', 1, 2, '' ,'', true);
$pdf->MultiCell(55, 5, '[DEFAULT] '.$txt, 1, '', 0, 1, '', '', true);

$pdf->Ln(4);

// set color for background
$pdf->SetFillColor(220, 255, 220);

// Vertical alignment
$pdf->MultiCell(55, 40, '[VERTICAL ALIGNMENT - TOP] '.$txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'T');
$pdf->MultiCell(55, 40, '[VERTICAL ALIGNMENT - MIDDLE] '.$txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'M');
$pdf->MultiCell(55, 40, '[VERTICAL ALIGNMENT - BOTTOM] '.$txt, 1, 'J', 1, 1, '', '', true, 0, false, true, 40, 'B');

$pdf->Ln(4);


















// Obtener el PDF como una cadena base64
$pdfData = $pdf->Output('Reporte.pdf', 'I');

// Codificar el PDF en base64 para enviarlo al cliente
$pdfBase64 = base64_encode($pdfData);

// Devolver el PDF codificado en base64
echo $pdfBase64;
