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