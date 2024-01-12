function   Editarloked(){
   
    var id=$('#sku').val();
    if(id !=null && id)
    $.ajax({
        url: './view/ajax/Funciones/loked.php',
        type: 'post',
        data: { id: id},
        dataType: 'json',
        success: function (response) {
          console.log(response);
         
  
        }
      });
  
  
  
}


function editloked(){


var id=$('#INTIDINV').val();
if(id !=null && id){
  $.ajax({
    url: './view/ajax/Funciones/lokedinv.php',
    type: 'post',
    data: { id: id},
    dataType: 'json',
    success: function (response) {
      console.log(response);
     

    }
  });

}


}

function Ever(variable){
  var ideHabilidad=$('#'+variable).val();
  var idTabla=$('#'+variable).data('info');
  var Bandera=$('#'+variable).is(":checked");

  alert("Hola" + variable +"ide de habilidad "+ideHabilidad+"ideTabla "+idTabla+"Valor de la bandera"+Bandera );
}