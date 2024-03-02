
var contador = 0;
var TotalP = 0;

var inventario = [];

var inventarioUpdate = [];

var TotalUpdate = 0;
var bandera = false;

var DropElements = [];

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


  $("#outproduct").on("change", function () {
    if ($("#outproduct option:selected").length > 1) {
      $("#outproduct option:selected").prop("selected", false);
      $(this).find("option:selected:last").prop("selected", true);
    }
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

  var column = $("#outproduct").val();
  var query = "";
  var per_page = 1000;
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
      renderTable();
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
    var query = "";
    var per_page = "";
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
        renderTable();


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


function validarImg(parametro) {
  alert(parametro);
}

function per_page(valor) {
  $("#per_page").val(valor);
  load(1);
  $('.dropdown-menu li').removeClass("active");
  $("#" + valor).addClass("active");
}








//end-validar img

function CalcularTotal(precio, cantidad) {

  if (precio != null && cantidad != null && cantidad > 0 && precio > 0) return precio * cantidad;

}





function EliminarArray(id) {
  //funcion Eliminar update
  //alert(id);

  elemento = inventarioUpdate[id];
  DropElements.push(elemento);
  total = parseInt(elemento.total);
  inventarioUpdate.splice(id, 1);
  var numeroElementos = inventarioUpdate.length;
  $('#CountU').val(numeroElementos);
  TotalUpdate = TotalUpdate - total;
  var tabla = document.getElementById("miTablaUpdate");
  var cuerpoTabla = tabla.getElementsByTagName("tbody")[0];
  cuerpoTabla.innerHTML = '';

  inventarioUpdate.forEach(function (Elemento, indice) {

    // Crear una nueva fila
    var fila = cuerpoTabla.insertRow();

    // Insertar celdas en la fila
    var numero = fila.insertCell(0);
    var CALLSKU = fila.insertCell(1);
    var CELLREF = fila.insertCell(2);
    var CELLCAT = fila.insertCell(3);
    var CELLPRECIO = fila.insertCell(4);
    var CELLTOTAL = fila.insertCell(5);
    var Accion = fila.insertCell(6);

    // Llenar las celdas con datos del Elemento
    numero.textContent = indice + 1;
    CALLSKU.textContent = Elemento.sku;
    CELLREF.textContent = Elemento.referencia;
    CELLCAT.textContent = Elemento.cantidad;

    let formatoPesos = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' });

    CELLPRECIO.textContent = formatoPesos.format(Elemento.precio);

    CELLTOTAL.textContent = formatoPesos.format(Elemento.total);


    var boton = document.createElement('button');
    boton.innerHTML = '<i class="far fa-trash-alt"></i>';
    boton.type = 'button';

    boton.setAttribute("data-info", indice);


    boton.className = 'btn btn-danger btn-square btn-xs';

    // Establecer el atributo data-toggle del botón

    // Establecer el atributo data-target del botón


    // Agregar un escuchador de eventos al botón para llamar a la función validarImg() cuando se haga clic en el botón
    boton.onclick = function () {
      EliminarArray(indice);
    }
    Accion.appendChild(boton);


  });
  $('#MONCTOPROU').val(TotalUpdate);
  (inventarioUpdate.length > 0) ? document.getElementById('INTTIPMOVU').disabled = true : document.getElementById('INTTIPMOVU').disabled = false;



}
function vselect() {
  //alert("Hola");
  if ($("#outproductU option:selected").length > 1) {
    $("#outproductU option:selected").prop("selected", false);
    $(this).find("option:selected:last").prop("selected", true);
  }
}


//Estado de resultados


function HistorialEntradassalidas(id) {

  //alert(id);
  var page = 1;

  var per_page = 1000;
  var parametros = {
    "action": "ajax",
    "page": page,
    "per_page": per_page,
    "id": id,

  };

  $.ajax({
    url: 'view/ajax/control_ajax-copy.php',
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
    },
    success: function (data) {
      localStorage.setItem('datos', JSON.stringify(data));
      window.location.href = './?view=control';
      /*$(".outer_div").html(data).fadeIn('slow');
      $("#loader").html("");*/
    }
  })
}



function validarStock(id, cantidad) {

  var parametros = {
    "id": id,
    "cantidad": cantidad


  };

  $.ajax({
    url: './view/ajax/Funciones/Stock.php',
    type: 'post',
    data: parametros,

    success: function (data) {
      if (data.trim() == "stock") {
        bandera = true;
        //alert("Es mayor al stock");
      } else {
        bandera = false;
        $('#INTCAN').val(data.trim());
        $('#INTCAN').css('color', 'red');
        $('#MINTCAN').css('color', 'red');
        $('#MINTCAN').text("Stock disponible :" + data.trim());

      }
    }

  })


}

function ValidarSku(array, valor) {
  indice = false;
  for (i = 0; i < array.length; i++) {

    var indice = array[i].SKU.includes(valor);
    if (indice) {
      return indice;
    }
  }

  return indice;
  // Buscar el elemento "Manzana" con indexOf

}
function ValidarSkuUpdate(array, valor) {
  indice = false;
  for (i = 0; i < array.length; i++) {

    var indice = array[i].sku.includes(valor);
    if (indice) {
      return indice;
    }
  }

  return indice;
  // Buscar el elemento "Manzana" con indexOf

}

function stockEliminado(array, sk) {
  for (i = 0; i < array.length; i++) {
    if (array[i].sku === sk) {
      return array[i];
    }
  }

}

//endEstado de resultados




//imprimir el detalle 
function pdfInventario() {

  alert("Desea imprimir los datos");
  var contenido = document.querySelector('#printentrada').innerHTML;

  var contenidoOriginal = document.body.innerHTML;

  document.body.innerHTML = contenido;

  window.print();

  document.body.innerHTML = contenidoOriginal;
}

//


function descargarPDF() {

  /*
    var doc = new jsPDF();
  var codigo = document.querySelector("#printentrada").innerText;
  doc.text(codigo, 10, 10);
  doc.save('codigo.pdf');*/
  var doc = new jsPDF();

  // Añades un título al documento
  doc.setFontSize(22);
  doc.text("Reporte de Ventas", 105, 30, null, null, "center");

  // Añades una tabla de ventas
  doc.autoTable({ html: '#printentrada' })

  // Añades un total al final de la tabla
  doc.setFontSize(18);
  doc.text("Total: $600", 180, doc.autoTable.previous.finalY + 20);

  // Guardas el documento como un archivo PDF
  doc.save('reporte.pdf');
}

function resetForm() {

  document.querySelector("#new_register").reset();
}

function reportInputOutput() {



  var id = $('#INTIDINV').val();
  $('#idinventario').val(id);


}

function ValidarEntradaSalida(array) {

  (array.length > 0) ? document.getElementById('INTTIPMOV').disabled = true : document.getElementById('INTTIPMOV').disabled = false;


}
function calcularTotal(array) {
  var Total = 0;
  array.forEach(function (elemento) {

    Total += elemento.MONCTOPRO;

  });
  $("#Total").text(Total);





}
 function img(id){
  //alert("Hola"+id)
  $("#"+id).click();
 
 }

