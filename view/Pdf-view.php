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
$html2 = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <style>
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #b4d10e;
            color: rgb(0, 0, 0);
            text-align: left;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: yellow;
            color: black;
            text-align: center;
            line-height: 35px;
            border-top: 1px solid black;


        }

        .main {
            padding-top: 15px;
            padding-bottom: 2px;
            margin-top: 75.8px;
            height: 800px;
            background-color: rgb(228, 146, 146);
        }

        th {
            background-color:aliceblue ;
        }

        p {
            text-align: justify;
        }
    </style>

</head>

<body>

    <header>

     <p>CEMENTO ACERO Y ACABADOS ROMA, S.A C.V
                SIMBOLOS PATRIOS N°730 COL.ELISEO JIMENEZ RUIZ C.P 68120</p>
    
       

    </header>
    
    <footer>


        <div class="col-sm-6">lado 1</div>
        <div class="col-sm-6">lado 2</div>

    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>';
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
$dompdf->loadHtml($html2);

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
