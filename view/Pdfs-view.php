<?php
$active2="active";
		require_once ("./config/config.php");
    //Archivo comprueba si el usuario esta logueado	
    include_once "./vendor/autoload.php";
    use Dompdf\Dompdf;
    session_start();
if (!isset($_SESSION['user_id'])){
	header("location: ./?view=index");//Redirecciona 
	exit;
}
  if ($_SESSION['solicitud']==1){
	if (isset($_POST["id"])){
		$id=$_POST["id"];
		$id=intval($id);
		$sql="select * from solicitud where pk_solicitud='$id'";
		$query=mysqli_query($con,$sql);
		$num=mysqli_num_rows($query);
		if ($num==1){
			$rw=mysqli_fetch_array($query);
			$pk_solicitud=$rw['pk_solicitud'];
			$fk_empleado=$rw['fk_empleado'];
			$NumeroFolio=$rw['NumeroFolio'];
			$fecha=$rw['fecha'];
			$operador=$rw['operador'];
			$NoCarro=$rw['NoCarro'];
			$Kilometraje=$rw['Kilometraje'];
			$NoPlacas=$rw['NoPlacas'];
			$DetallesServicio=$rw['DetallesServicio'];
			$Observaciones=$rw['Observaciones'];
			
		}
	}	
	else{exit;}

 
$dompdf = new Dompdf();
$NoOrden=4;
$html='<!DOCTYPE html>
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
            background-color:white;
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
                <th>'.$pk_solicitud.'</th>
                <th>No. de Folio :</th>
                <th>'.$NumeroFolio.'</th>
                <th>Fecha</th>
                <th>'.$fecha.'</th>
            </tr>
          
        </table>
        <h5>Datos Generales-Orden</h5>
         <table class="invoice-table">
            <tr>
                <th>Operador </th>
                <th>'.$operador.'</th>
              
            </tr>
          
        </table>
         <table class="invoice-table">
            <tr>
                <th>No. de Carro :</th>
                <th>'.$NoCarro.'</th>
                <th>Kilometraje :</th>
                <th>'.$Kilometraje.'</th>
                <th>No.Placas :</th>
                <th>'.$NoPlacas.'</th>
              
            </tr>
          
        </table>
         <h5>Detalles de Servicio</h5>
         <textarea row="30">'.$DetallesServicio.'</textarea>
          <h5>Observaciones</h5>
         <textarea row="30">'.$Observaciones.' </textarea>
        <div><h1>ORDEN DE SERVICIO-TALLER</h1></div>

        <div class="signature">
        <br>
            <p>AUTORIZO</p> 
            <p>'.$fk_empleado.'</p><br>
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
$dompdf->loadHtml($html);
$dompdf->render();
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
echo $dompdf->output();

}else{
  require 'resources/acceso_prohibido.php';
}
ob_end_flush(); 
?>
