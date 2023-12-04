
var contador = 0;
var TotalP=0;

var inventario=[];
$(document).ready(function () {
  //alert("cargado"); 
  
  //load 
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
  /* $('.validarBtn').change(function (e) {
     // alert("listo")
     
   });*/


  // carga  todas las  solicitude  de las solicitudes
  //parametros por paginas tabla y columna por la cual se quiere buscar
  //
  /*$(document).on('change', 'input[type=file]', function (e) {
    // Obtenemos la ruta temporal mediante el evento
    var TmpPath = URL.createObjectURL(e.target.files[0]);
    // Mostramos la ruta temporal
    if(){


    }
    $(".EverCambio").attr("src", TmpPath);

    

  });*/

  //end 
  $(document).on('change', 'input[type=file]', function (e) {
    var inputValor = $(this).val();
    if (validarURLImagen(inputValor)) {
      // alert("es valida");
      var TmpPath = URL.createObjectURL(e.target.files[0]);
      $(".EverCambio").attr("src", TmpPath);
      // La URL de la imagen es válida, puedes realizar acciones adicionales aquí.
    } else {
      alert("por favor ingresa un archivo valido para la imagen");
      $(this).val('');
      $('.EverCambio').attr("src", 'view/resources/images/Default/productoinit.png');
    }


  });


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


//funcion para cambiar las imagenes 
//@param id
function upload_image(id_user, table, columna, path, cl) {
  $("#load_img").text('Cargando...');
  var inputFileImage = document.getElementById("STRIMG");
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('imagefile', file);
  data.append('id', id_user);
  data.append('table', table);
  data.append('columna', columna);
  data.append('path', path);
  data.append('cl', cl);

  $.ajax({
    url: "view/ajax/images/Cambio-img-generico.php", // Url to which the request is send
    type: "POST", // Type of request to be send, called as method
    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false, // To send DOMDocument or non processed data file it is set to false
    success: function (data) // A function to be called if request succeeds
    {
      $("#load_img").html(data);

    }
  });
}

//Cambio de imagen 

function cambio(url) {
  alert(url);

  $("#EverCambio").attr("src", url);

}
//validar img


function validarURLImagen(url) {
  // Expresión regular para validar URLs de imágenes (formatos comunes)
  var regex = /\.(jpeg|jpg|gif|png|bmp)$/i;
  return regex.test(url);
}


function validarImg() {
  alert("hola");
}

function per_page(valor) {
  $("#per_page").val(valor);
  load(1);
  $('.dropdown-menu li').removeClass("active");
  $("#" + valor).addClass("active");
}


function agregarInventario() {
  valor = $('#outproduct').val();
  texto = $('#outproduct').text();
  cantidad = $('#INTCAN').val();
  referencia = $('#STRREF').val();
  var precio = document.querySelector("#outproduct > option").dataset.info
  var unidad = document.querySelector("#outproduct > option").dataset.unidad
  var celdas = document.querySelectorAll('.total td');
    
   
  // Iterar sobre las celdas y hacer algo con cada una
  celdas.forEach(function (celda) {
    // Hacer algo con la celda, por ejemplo, imprimir su contenido
    console.log(celda.textContent);
  });

    TotalP=TotalP+CalcularTotal(precio, cantidad);
    $('#MONCTOPRO').val(TotalP);

    inventario.push({
      "SKU": valor,
      "STRREF": referencia,
      "INTCANT": cantidad,
      "INTIDUNI":unidad,
      "MONPRCOS": precio,
      "MONCTOPRO":CalcularTotal(precio, cantidad)
  });
 //CONVERTIRLO A JSON

 var jsoninventario = JSON.stringify(inventario, null, 2);
 console.log(jsoninventario);
 //
  // Imprimiendo el valor
  //console.log(precio); 

 /*alert("valor"+contador);

  //alert("hola" + valor + "precio" + precio + " referencia" + referencia + " Cantidad" + cantidad + "total");
  var nuevaFila = $("<tr> <th scope='row'>" + valor + "</th> <td>" + precio + "</td> <td>" + cantidad + "</td> <td>" + referencia + "</td> <td class='total'>" + CalcularTotal(precio, cantidad) + "</td> </tr>");
   contador++;
  // Agregar la nueva fila al cuerpo de la tabla
  $("#miTabla tbody").append(nuevaFila);*/

  var tabla = document.getElementById("miTabla");
var cuerpoTabla = tabla.getElementsByTagName("tbody")[0];

// Iterar sobre cada inventario en el array y agregar una fila a la tabla por cada inventario
/*inventario.forEach(function(Elemento) {
    // Crear una nueva fila
    var fila = cuerpoTabla.insertRow();

    // Insertar celdas en la fila
    var CALLSKU = fila.insertCell(0);
    var CELLREF = fila.insertCell(1);
    var CELLCAT = fila.insertCell(2);
    var CELLPRECIO = fila.insertCell(3);
    var CELLTOTAL = fila.insertCell(4);

    // Llenar las celdas con datos del Elemento
    CALLSKU.textContent = Elemento.SKU;
    CELLREF.textContent = Elemento.STRREF;
    CELLCAT.textContent = Elemento.INTCANT;
    CELLPRECIO.textContent = Elemento.MONPRCOS;
    CELLTOTAL.textContent = Elemento.MONCTOPRO;
});*/

   Elemento= inventario[inventario.length-1];
   console.log(Elemento.SKU);
   // Crear una nueva fila
   var fila = cuerpoTabla.insertRow();

   // Insertar celdas en la fila
   var CALLSKU = fila.insertCell(0);
   var CELLREF = fila.insertCell(1);
   var CELLCAT = fila.insertCell(2);
   var CELLPRECIO = fila.insertCell(3);
   var CELLTOTAL = fila.insertCell(4);

   // Llenar las celdas con datos del Elemento
   CALLSKU.textContent = Elemento.SKU;
   CELLREF.textContent = Elemento.STRREF;
   CELLCAT.textContent = Elemento.INTCANT;
   CELLPRECIO.textContent = Elemento.MONPRCOS;
   CELLTOTAL.textContent = Elemento.MONCTOPRO;

}



function mostrarProductos() {


  valor = $('.columna').val();
  campo = $('#campo').val();


  //alert("Hola funcion buscar productos"+valor+" campo"+campo);
  var parametros = {
    "columna": valor,
    "tabla": 'tblcatpro',
    "campo": campo

  };

  $.ajax({
    url: './view/ajax/Funciones/Buscar.php',
    type: 'post',
    data: parametros,
    dataType: 'json',
    beforeSend: function (objeto) {
      $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
    },
    success: function (data) {
      //sku=data[1].STRSKU;
      //alert(sku);

      var select = $('#outproduct');
      select.empty();
      $.each(data, function (i, dato) {

        select.append('<option value="' + dato.STRSKU + '" data-info="' + dato.MONPCOS +'" data-unidad="' + dato.INTIDUNI +'"    ><b>SKU :&nbsp</b>  ' + dato.STRSKU + '&nbspCodigo :  &nbsp' + dato.STRCOD + '</option>');
      });
    }

  })







}

//end-validar img


function CalcularTotal(precio, cantidad) {

  if (precio != null && cantidad != null && cantidad > 0 && precio > 0) return precio * cantidad;

}
