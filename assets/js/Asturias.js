

   $(document).ready(function(){

      $(".categorias").change(function(){
        var categoriaID = $(this).val();
      // alert("cambio en boton"+categoriaID);
        $.ajax({
          url: './view/ajax/Categoria/Sql_categorias.php',
          type: 'post',
          data: {categoria:categoriaID},
          dataType: 'json',
          success:function(response){
            //alert(response)
            var len = response.length;

            if(len>0){ $(".Subcategorias").empty();
            for( var i = 0; i<len; i++){
              var id = response[i]['id'];
              var nombre = response[i]['nombre'];
              $(".Subcategorias").append("<option value='"+id+"'>"+nombre+"</option>");
            }
         }else{
            $(".Subcategorias").empty();
            $(".Subcategorias").append('<option value="" disabled  selected >No hay Subcategorias  en la  bd agregue datos </option>');
         }
           
          }
        });
      });



    });