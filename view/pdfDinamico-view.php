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
        $this->Cell(0, 10, 'Fernanada Asturias S.A de C.V', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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

$json_data = $_POST['code'];

// Decodificar los datos JSON
$datos = json_decode($json_data, true);
$json_data2 = $_POST['titulos'];

// Decodificar los datos JSON
$titulos = json_decode($json_data2, true);

$filas="";
$columnas="";
$count=count($titulos);
foreach($datos as $dato){
    array_pop($dato);


    
    $filas.='<tr>';
    for($i=0;$i<$count ;$i++){
        $filas.='<td style="text-align: center; ">'.$dato[$i].'</td>';

    }
    
   
   
    $filas.='</tr>';
    
    

}



if(is_array($datos)){
    

    if(is_array($titulos)){
       foreach($titulos as $titulo){
        $columnas.= '<th style="background-color:orange ;  text-align: center;">'.$titulo.'</th>';

       }
        
     


    }

      
    $html='<table border="0.25">
    <thead>
        <tr>'.$columnas.'
            
           
        </tr>
    </thead>
    <tbody>' . $filas . '
    </tbody>
    </table>';
   
   // print_r($datos);
}else{

    
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
$pdf->SetFont('times', '', 8);

// add a page

// ---------------------------------------------------------

//Close and output PDF document


//============================================================+
// END OF FILE


$pdf->AddPage();
//$pdf->SetFont('helvetica', 'BI', 8);


// set some text to print

// print a block of text using Write()









    $txt = <<<EOD
 Datos de la compra


EOD;




$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

$pdf->writeHTML($html);



// Obtener el PDF como una cadena base64
$pdfData = $pdf->Output('Reporte.pdf', 'S');

// Codificar el PDF en base64 para enviarlo al cliente
$pdfBase64 = base64_encode($pdfData);

// Devolver el PDF codificado en base64
echo $pdfBase64;

