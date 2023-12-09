
var contador = 0;
var TotalP = 0;

var inventario = [];

var inventarioUpdate = [];

var TotalUpdate = 0;


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


function validarImg(parametro) {
  alert(parametro);
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

  TotalP = TotalP + CalcularTotal(precio, cantidad);
  $('#MONCTOPRO').val(TotalP);

  inventario.push({
    "SKU": valor,
    "STRREF": referencia,
    "INTCANT": cantidad,
    "INTIDUNI": unidad,
    "MONPRCOS": precio,
    "MONCTOPRO": CalcularTotal(precio, cantidad)
  });
  //CONVERTIRLO A JSON

  var jsoninventario = JSON.stringify(inventario, null, 2);
  console.log(jsoninventario);


  var tabla = document.getElementById("miTabla");
  var cuerpoTabla = tabla.getElementsByTagName("tbody")[0];
  cuerpoTabla.innerHTML = '';
  // Iterar sobre cada inventario en el array y agregar una fila a la tabla por cada inventario
  inventario.forEach(function (Elemento, indice) {

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
    CALLSKU.textContent = Elemento.SKU;
    CELLREF.textContent = Elemento.STRREF;
    CELLCAT.textContent = Elemento.INTCANT;
    CELLPRECIO.textContent = Elemento.MONPRCOS;
    CELLTOTAL.textContent = Elemento.MONCTOPRO;
    var boton = document.createElement('button');
    boton.innerHTML = '<i class="fa fa-trash-o"></i>';
    boton.type = 'button';

    boton.setAttribute("data-info", indice);


    boton.className = 'btn btn-danger btn-square btn-xs';

    // Establecer el atributo data-toggle del botón

    // Establecer el atributo data-target del botón


    // Agregar un escuchador de eventos al botón para llamar a la función validarImg() cuando se haga clic en el botón
    boton.onclick = function () {
      EliminarArrayInsert(indice);
    }
    Accion.appendChild(boton);


  });
  var numeroElementos = inventario.length;
  $('#Count').val(numeroElementos);



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

        select.append('<option value="' + dato.STRSKU + '" data-info="' + dato.MONPCOS + '" data-unidad="' + dato.INTIDUNI + '"    ><b>SKU :&nbsp</b>  ' + dato.STRSKU + '&nbspCodigo :  &nbsp' + dato.STRCOD + '</option>');
      });
    }

  })







}
function mostrarProductosUpdate() {


  valor = $('.columnaU').val();
  campo = $('#campoU').val();


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

      var select = $('#outproductU');
      select.empty();
      $.each(data, function (i, dato) {

        select.append('<option value="' + dato.STRSKU + '" data-info="' + dato.MONPCOS + '" data-unidad="' + dato.INTIDUNI + '"    ><b>SKU :&nbsp</b>  ' + dato.STRSKU + '&nbspCodigo :  &nbsp' + dato.STRCOD + '</option>');
      });
    }

  })







}

//end-validar img
function EliminarArrayInsert(variable) {
  //alert(variable);
  elemento = inventario[variable];
  SKU = elemento.SKU[0];
  STRREF = elemento.STRREF;
  cantidad = elemento.INTCANT;
  total = elemento.MONCTOPRO;
  inventario.splice(variable, 1);
  var numeroElementos = inventario.length;
  $('#Count').val(numeroElementos);
  TotalP = TotalP - total;
  $('#MONCTOPRO').val(TotalP);
  var tabla = document.getElementById("miTabla");
  var cuerpoTabla = tabla.getElementsByTagName("tbody")[0];
  cuerpoTabla.innerHTML = '';
  // Iterar sobre cada inventario en el array y agregar una fila a la tabla por cada inventario
  inventario.forEach(function (Elemento, indice) {

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
    CALLSKU.textContent = Elemento.SKU;
    CELLREF.textContent = Elemento.STRREF;
    CELLCAT.textContent = Elemento.INTCANT;
    CELLPRECIO.textContent = Elemento.MONPRCOS;
    CELLTOTAL.textContent = Elemento.MONCTOPRO;
    var boton = document.createElement('button');
    boton.innerHTML = '<i class="fa fa-trash-o"></i>';
    boton.type = 'button';

    boton.setAttribute("data-info", indice);


    boton.className = 'btn btn-danger btn-square btn-xs';

    // Establecer el atributo data-toggle del botón

    // Establecer el atributo data-target del botón


    // Agregar un escuchador de eventos al botón para llamar a la función validarImg() cuando se haga clic en el botón
    boton.onclick = function () {
      EliminarArrayInsert(indice);
    }
    Accion.appendChild(boton);


  });

}

function CalcularTotal(precio, cantidad) {

  if (precio != null && cantidad != null && cantidad > 0 && precio > 0) return precio * cantidad;

}


function MostrarProductos(id) {
  //Funcion Mostrar productos update
  var parametros = {
    "id": id


  };

  $.ajax({
    url: './view/ajax/Entradas/Sql_entradas.php',
    type: 'post',
    data: parametros,
    dataType: 'json',
    beforeSend: function (objeto) {
      $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
    },
    success: function (data) {
      //sku=data[1].STRSKU;
      //alert(data);
      // console.log(data);
      inventarioUpdate = data;

      var tabla = document.getElementById("miTablaUpdate");
      var cuerpoTabla = tabla.getElementsByTagName("tbody")[0];
      cuerpoTabla.innerHTML = '';
      var numeroElementos = inventarioUpdate.length;
      $('#CountU').val(numeroElementos);
    
      // Iterar sobre cada inventario en el array y agregar una fila a la tabla por cada inventario
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
        CELLPRECIO.textContent = Elemento.precio;
        CELLTOTAL.textContent = Elemento.total;
        TotalUpdate = TotalUpdate + parseInt(Elemento.total);

        var boton = document.createElement('button');
        boton.innerHTML = '<i class="fa fa-trash-o"></i>';
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

      /* var select = $('#outproduct');
       select.empty();
       $.each(data, function (i, dato) {
   
         select.append('<option value="' + dato.STRSKU + '" data-info="' + dato.MONPCOS + '" data-unidad="' + dato.INTIDUNI + '"    ><b>SKU :&nbsp</b>  ' + dato.STRSKU + '&nbspCodigo :  &nbsp' + dato.STRCOD + '</option>');
       });*/
    }

  })
}

function agregarUpdate(){
 let valor = $('#outproductU').val();
  texto = $('#outproductU').text();
  cantidad = $('#INTCANU').val();
  referencia = $('#STRREFU').val();
  var precio = document.querySelector("#outproductU > option").dataset.info
  var unidad = document.querySelector("#outproductU > option").dataset.unidad
  var celdas = document.querySelectorAll('.total td');
  TotalUpdate = TotalUpdate + CalcularTotal(precio, cantidad);
  

  inventarioUpdate.push({
    "sku": valor,
    "referencia": referencia,
    "cantidad": cantidad,
    "unidad": unidad,
    "precio": precio,
    "total": CalcularTotal(precio, cantidad)
  });
  //CONVERTIRLO A JSON

  var jsoninventario = JSON.stringify(inventarioUpdate, null, 2);
 
  var numeroElementos = inventarioUpdate.length;
  $('#CountU').val(numeroElementos);

  var tabla = document.getElementById("miTablaUpdate");
  var cuerpoTabla = tabla.getElementsByTagName("tbody")[0];
  cuerpoTabla.innerHTML = '';
  // Iterar sobre cada inventario en el array y agregar una fila a la tabla por cada inventario
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
    CELLPRECIO.textContent = Elemento.precio;
    CELLTOTAL.textContent = Elemento.total;
    

    var boton = document.createElement('button');
    boton.innerHTML = '<i class="fa fa-trash-o"></i>';
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



}

function EliminarArray(id){
  //funcion Eliminar update
 //alert(id);
 
 elemento = inventarioUpdate[id];
 total=parseInt(elemento.total);
 inventarioUpdate.splice(id, 1);
 var numeroElementos = inventarioUpdate.length;
 $('#CountU').val(numeroElementos);
 TotalUpdate=TotalUpdate-total;
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
  CELLPRECIO.textContent = Elemento.precio;
  CELLTOTAL.textContent = Elemento.total;
 

  var boton = document.createElement('button');
  boton.innerHTML = '<i class="fa fa-trash-o"></i>';
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



}
