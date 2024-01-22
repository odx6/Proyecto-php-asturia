<?php 
function  recuperarDatos($consulta){
    global $con;
    $sqldelete=$consulta;
        $dataDelete=mysqli_query($con,$sqldelete);
        $data=mysqli_fetch_assoc($dataDelete);
        //$data=array_unique($data);
        $dataend=implode(',',$data);
    
        return $dataend;
    
    }

?>