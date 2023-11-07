<?php

	require './vendor/autoload.php'; // Carga el archivo autoloader de Composer

// Crequire 'vendor/autoload.php'; // Asegúrate de incluir el autoloader de DOMPDF

use Dompdf\Dompdf;
use Dompdf\Options;

// Crea una instancia de DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// Lee el contenido del archivo HTML
$html = '<!DOCTYPE html>
<html>
<head>
    <style>
        .invoice {
            width: 90s%;
            margin: 0 auto;
           
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            text-align:  center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color:yellow;
            color:black;
            text-align: center;
            line-height: 35px;
            border-top: 1px solid black;


        }
         .con
        .invoice-details {
            margin: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table, th, td {
            border: 1px solid #000;
        }

        .signature {
            width: 50%;
            float: left;
        }
     
        h5{
        	background-color:black;
        	color:white;
        	text-align:center;
        }
        p{
        	text-align:center;
        }
        h1{
        	text-align:center;
        }
    </style>
</head>
<body>
<header>
    
    <h4>CEMENTO ACERO Y ACABADOS ROMA, S.A C.V <br>SIMBOLOS PATRIOS N°730 COL.ELISEO JIMENEZ RUIZ C.P 68120</h4>
    <h3></h3>
   
   
</header>
<footer>


<strong> MANUEL F.RODRIGUEZ MARRON GERENTE <?php echo date ("Y");?></strong>

</footer>

    <div class="invoice">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        <table class="invoice-table">
            <tr>
                <th>Id Orden :</th>
                <th>2747</th>
                <th>No. de Folio :</th>
                <th>2699</th>
                <th>Fecha</th>
                <th>23/02/23</th>
            </tr>
          
        </table>
        <h5>Datos Generales-Orden</h5>
         <table class="invoice-table">
            <tr>
                <th>Operador </th>
                <th>Evarado Alvaro Agustin Cruz</th>
              
            </tr>
          
        </table>
         <table class="invoice-table">
            <tr>
                <th>No. de Carro :</th>
                <th>2247</th>
                <th>Kilometraje :</th>
                <th>2233</th>
                <th>No.Placas :</th>
                <th>Ry-31618</th>
              
            </tr>
          
        </table>
         <h5>Detalles de Servicio</h5>
         <textarea row="30">cambiar disco de cluth valvula de puie freno</textarea>
          <h5>Observaciones</h5>
         <textarea row="30">Ninguno </textarea>
        <div><h1>ORDEN DE SERVICIO-TALLER</h1></div>

        <div class="signature">
        <br>
            <p>AUTORIZO</p> 
            <p>Catarino</p><br>
            <p>__________________________</p>
        </div>
        <div class="signature">
        <br>
          <p>AUTORIZO</p> 
            <p>Chofer</p><br>
            <p>__________________________</p>
        </div>

        
    </div>
  	 
</body>
</html>
';

// Carga el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// Renderiza el PDF (puedes ajustar la orientación y el tamaño del papel aquí)
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Guarda el PDF en una variable
$pdfData = $dompdf->output();

// Envía los encabezados para indicar que se trata de un archivo PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="plantilla_firmas.pdf"');

// Envía el contenido del PDF al navegador
echo $pdfData;

// Abre el PDF en una nueva ventana utilizando JavaScript


?>



