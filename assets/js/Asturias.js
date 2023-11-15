

$(document).ready(function () {
  //alert("cargado");
  $(".categorias").change(function () {
    var categoriaID = $(this).val();
    // alert("cambio en boton"+categoriaID);
    $.ajax({
      url: './view/ajax/Categoria/Sql_categorias.php',
      type: 'post',
      data: { categoria: categoriaID },
      dataType: 'json',
      success: function (response) {
        //alert(response)
        var len = response.length;

        if (len > 0) {
          $(".Subcategorias").empty();
          for (var i = 0; i < len; i++) {
            var id = response[i]['id'];
            var nombre = response[i]['nombre'];
            $(".Subcategorias").append("<option value='" + id + "'>" + nombre + "</option>");
          }
        } else {
          $(".Subcategorias").empty();
          $(".Subcategorias").append('<option value="" disabled  selected >No hay Subcategorias  en la  bd agregue datos </option>');
        }

      }
    });

  });
  //load 


  // carga  todas las  solicitude  de las solicitudes
  //parametros por paginas tabla y columna por la cual se quiere buscar
  //


  //end 



});
//'view/ajax/Mostrar_Solicitudes_ajax.php'
function load(page, table, path, reload) {

  var column = $("#miSelect").val();
  var query = $("#q").val();
  var per_page = $("#per_page").val();
  var parametros = {
    "action": "ajax",
    "page": page,
    'query': query,
    'per_page': per_page,
    'column': column,
    'table': table


  };
  $("#loader").fadeIn('slow');
  $.ajax({
    url: path,
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn('slow');
      $("#loader").html("");
    }
  })
}

function per_page(valor) {
  $("#per_page").val(valor);
  load(1);
  $('.dropdown-menu li').removeClass("active");
  $("#" + valor).addClass("active");
}


//eliminar  y editar 
function eliminar(id, path, table) {
  if (confirm('Esta acción  eliminará de forma permanente la solicitud\n\n Desea continuar?')) {
    var page = 1;
    var query = $("#q").val();
    var per_page = $("#per_page").val();
    var parametros = {
      "action": "ajax",
      "page": page,
      "query": query,
      "per_page": per_page,
      "id": id,
      'table': table
    };

    $.ajax({
      url: path,
      data: parametros,
      beforeSend: function (objeto) {
        $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
      },
      success: function (data) {
        $(".outer_div").html(data).fadeIn('slow');
        $("#loader").html("");
        window.setTimeout(function () {
          $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
          });
        }, 5000);
      }
    })
  }
}

// editar
function editar(id, path) {
  var parametros = {
    "action": "ajax",
    "id": id
  };
  $.ajax({
    url: path,
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='./assets/img/ajax-loader.gif'>");
    },
    success: function (data) {
      $(".outer_div2").html(data).fadeIn('slow');
      $("#loader2").html("");
    }
  })
}
//endeditar

//mostrar
function mostrar(id, path) {
  var parametros = {
    "action": "ajax",
    "id": id
  };
  $.ajax({
    url: path,
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader3").html("<img src='./assets/img/ajax-loader.gif'>");
    },
    success: function (data) {
      $(".outer_div3").html(data).fadeIn('slow');
      $("#loader3").html("");
    }
  })
}

//end mostrar 

//pdf-export div
function exportpf(historial) {
  alert("Deseas Generar un pdf con los Datos");
  var contenido = document.getElementById(historial).innerHTML;
  var contenidoOriginal = document.body.innerHTML;

  document.body.innerHTML = contenido;

  window.print();

  document.body.innerHTML = contenidoOriginal;
}
//

function mensaje() {

  $(".categorias").change(function () {
    var categoriaID = $(this).val();
    // alert("cambio en boton"+categoriaID);
    $.ajax({
      url: './view/ajax/Categoria/Sql_categorias.php',
      type: 'post',
      data: { categoria: categoriaID },
      dataType: 'json',
      success: function (response) {
       // alert(response)
        var len = response.length;

        if (len > 0) {
          $(".Subcategorias").empty();
          for (var i = 0; i < len; i++) {
            var id = response[i]['id'];
            var nombre = response[i]['nombre'];
            $(".Subcategorias").append("<option value='" + id + "'>" + nombre + "</option>");
          }
        } else {
          $(".Subcategorias").empty();
          $(".Subcategorias").append('<option value="" disabled  selected >No hay Subcategorias  en la  bd agregue datos </option>');
        }

      }
    });

  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}


function UploadImng(){
  readURL(this);
alert("Hola");
}



