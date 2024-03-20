<?php
$active2 = "active";
include "resources/header copy.php";
if (in_array(1, $_SESSION['Habilidad']['Entradas'])) {
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-dolly"></i> Agregar Entradas y Salidas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Agregar Entradas y Salidas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="container-fluid">
                <div class="resultados_ajax"></div>
                <?php include "modals/Productos_modal.php"; ?>

                <div class="row">

                    <button class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#myModal">Agregar Producto <i class="fa fa-plus"></i></button>

                </div>
                <br>

                <form class="form-horizontal" role="form" method="post" id="new_register" name="new_register" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTIDTOP" required class="col-form-label">INTIDTOP: </label>
                                <?php

                                // Consulta SQL para obtener los datos
                                $consulta = "SELECT  INTIDTOP,STRNOMTPO FROM tblcattop ORDER BY STRNOMTPO ASC";
                                $resultado = mysqli_query($con, $consulta);


                                // Crear el elemento select
                                echo ' <select class="form-control" name="INTIDTOP" id="INTIDTOP">';

                                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                    // Iterar sobre los resultados y crear una opción para cada uno

                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        echo '<option value="' . $fila['INTIDTOP'] . '"  <?php if($INTIDTOP= $fila["INTIDTOP"]) selected ?>   ' . $fila['STRNOMTPO'] . '</option>';
                                    }
                                } else {

                                    echo  '<option value="" disabled  selected >No hay TBLCATTOP  bd agregue datos </option>';
                                }

                                echo '</select>';
                                ?>


                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTTIPMOV" class=" col-form-label">Movimiento: </label>
                                <select class="form-control select2" onchange="ValidarEntradaSalida(inventario)" name="INTTIPMOV" id="INTTIPMOV" required>
                                    <option value="1">Entrada</option>
                                    <option value="2">Salida</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTFOL" class=" col-form-label">Folio: </label>
                                <input type="text" required class="form-control" id="INTFOL" name="INTFOL" placeholder="Folio: ">
                                <span id="MINTFOL"></span>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="INTIDALM" reuired class="col-form-label">ALMACEN: </label>
                                <?php

                                // Consulta SQL para obtener los datos
                                $consulta = "SELECT  INTIDALM,STRNOMALM FROM tblcatalm ORDER BY STRNOMALM  ASC";
                                $resultado = mysqli_query($con, $consulta);


                                // Crear el elemento select
                                echo ' <select class="form-control" name="INTIDALM" id="INTIDALM">';

                                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                    // Iterar sobre los resultados y crear una opción para cada uno

                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        echo '<option value="' . $fila['INTIDALM'] . '"  <?php if($INTIDALM= $fila["INTIDALM"]) selected ?>   ' . $fila['STRNOMALM'] . '</option>';
                                    }
                                } else {

                                    echo  '<option value="" disabled  selected >No hay datos de almacen en la base de datos registre nuevos </option>';
                                }

                                echo '</select>';
                                ?>

                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="STROBS" class=" col-form-label">Descripcion: </label>
                                <input type="text" required class="form-control" id="STROBS" name="STROBS" placeholder="Descripcion: ">
                                <span id="STROBS"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <input type="hidden" required class="form-control " id="IDEMP" name="IDEMP" placeholder="Folio: " value="<?php echo $_SESSION['user_id'] ?>">


                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de productos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Indice</th>
                                                <th>SKU</th>
                                                <th>Descripcion</th>
                                                <th>Referencia</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Indice</th>
                                                <th>SKU</th>
                                                <th>Descripcion</th>
                                                <th>Referencia</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Total</th>
                                                <th>Accion</th>
                                            </tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="Total"></th>
                                            <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <button type="submit" id="guardar_datos" class="btn btn-info">Guardar</button>
                </form>
            </div>









    </div>
    <!-- /.container-fluid -->
    </section>



    <?php
    include "resources/footer.php";
    ?>
    <script>
        $(function() {

            $("#example4,#example3").DataTable({
                "language": {
                    "aria": {
                        "sortAscending": "Activar para ordenar la columna de manera ascendente",
                        "sortDescending": "Activar para ordenar la columna de manera descendente"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Rellene todas las celdas con <i>%d<\/i>",
                        "fillHorizontal": "Rellenar celdas horizontalmente",
                        "fillVertical": "Rellenar celdas verticalmente"
                    },
                    "buttons": {
                        "collection": "Colección",
                        "colvis": "Visibilidad",
                        "colvisRestore": "Restaurar visibilidad",
                        "copy": "Copiar",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %d fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir",
                        "createState": "Crear Estado",
                        "removeAllStates": "Borrar Todos los Estados",
                        "removeState": "Borrar Estado",
                        "renameState": "Renombrar Estado",
                        "savedStates": "Guardar Estado",
                        "stateRestore": "Restaurar Estado",
                        "updateState": "Actualizar Estado"
                    },
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "searchBuilder": {
                        "add": "Añadir condición",
                        "button": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "clearAll": "Borrar todo",
                        "condition": "Condición",
                        "deleteTitle": "Eliminar regla de filtrado",
                        "leftTitle": "Criterios anulados",
                        "logicAnd": "Y",
                        "logicOr": "O",
                        "rightTitle": "Criterios de sangría",
                        "title": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "value": "Valor",
                        "conditions": {
                            "date": {
                                "after": "Después",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "not": "Diferente de",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "gt": "Mayor a",
                                "gte": "Mayor o igual a",
                                "lt": "Menor que",
                                "lte": "Menor o igual a",
                                "not": "Diferente de",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío"
                            },
                            "string": {
                                "contains": "Contiene",
                                "empty": "Vacío",
                                "endsWith": "Termina con",
                                "equals": "Igual a",
                                "not": "Diferente de",
                                "startsWith": "Inicia con",
                                "notEmpty": "No vacío",
                                "notContains": "No Contiene",
                                "notEndsWith": "No Termina",
                                "notStartsWith": "No Comienza"
                            },
                            "array": {
                                "equals": "Igual a",
                                "empty": "Vacío",
                                "contains": "Contiene",
                                "not": "Diferente",
                                "notEmpty": "No vacío",
                                "without": "Sin"
                            }
                        },
                        "data": "Datos"
                    },
                    "searchPanes": {
                        "clearMessage": "Borrar todo",
                        "collapse": {
                            "0": "Paneles de búsqueda",
                            "_": "Paneles de búsqueda (%d)"
                        },
                        "count": "{total}",
                        "emptyPanes": "Sin paneles de búsqueda",
                        "loadMessage": "Cargando paneles de búsqueda",
                        "title": "Filtros Activos - %d",
                        "countFiltered": "{shown} ({total})",
                        "collapseMessage": "Colapsar",
                        "showMessage": "Mostrar Todo"
                    },
                    "select": {
                        "cells": {
                            "1": "1 celda seleccionada",
                            "_": "%d celdas seleccionadas"
                        },
                        "columns": {
                            "1": "1 columna seleccionada",
                            "_": "%d columnas seleccionadas"
                        },
                        "rows": {
                            "1": "1 fila seleccionada",
                            "_": "%d filas seleccionadas"
                        }
                    },
                    "thousands": ",",
                    "datetime": {
                        "previous": "Anterior",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "am",
                            "pm"
                        ],
                        "next": "Siguiente",
                        "months": {
                            "0": "Enero",
                            "1": "Febrero",
                            "10": "Noviembre",
                            "11": "Diciembre",
                            "2": "Marzo",
                            "3": "Abril",
                            "4": "Mayo",
                            "5": "Junio",
                            "6": "Julio",
                            "7": "Agosto",
                            "8": "Septiembre",
                            "9": "Octubre"
                        },
                        "weekdays": [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado"
                        ]
                    },
                    "editor": {
                        "close": "Cerrar",
                        "create": {
                            "button": "Nuevo",
                            "title": "Crear Nuevo Registro",
                            "submit": "Crear"
                        },
                        "edit": {
                            "button": "Editar",
                            "title": "Editar Registro",
                            "submit": "Actualizar"
                        },
                        "remove": {
                            "button": "Eliminar",
                            "title": "Eliminar Registro",
                            "submit": "Eliminar",
                            "confirm": {
                                "_": "¿Está seguro que desea eliminar %d filas?",
                                "1": "¿Está seguro que desea eliminar 1 fila?"
                            }
                        },
                        "multi": {
                            "title": "Múltiples Valores",
                            "restore": "Deshacer Cambios",
                            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
                            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga click o toque aquí, de lo contrario conservarán sus valores individuales."
                        },
                        "error": {
                            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\"> Más información<\/a>)."
                        }
                    },
                    "decimal": ".",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "zeroRecords": "No se encontraron coincidencias",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoFiltered": "(Filtrado de _MAX_ total de registros)",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "stateRestore": {
                        "removeTitle": "Eliminar",
                        "creationModal": {
                            "search": "Buscar",
                            "button": "Crear",
                            "columns": {
                                "search": "Columna de búsqueda",
                                "visible": "Columna de visibilidad"
                            },
                            "name": "Nombre:",
                            "order": "Ordenar",
                            "paging": "Paginar",
                            "scroller": "Posición de desplazamiento",
                            "searchBuilder": "Creador de búsquedas",
                            "select": "Selector",
                            "title": "Crear nuevo",
                            "toggleLabel": "Incluye:"
                        },
                        "duplicateError": "Ya existe un valor con el mismo nombre",
                        "emptyError": "No puede ser vacío",
                        "emptyStates": "No se han guardado",
                        "removeConfirm": "Esta seguro de eliminar %s?",
                        "removeError": "Fallo al eliminar",
                        "removeJoiner": "y",
                        "removeSubmit": "Eliminar",
                        "renameButton": "Renombrar",
                        "renameLabel": "Nuevo nombre para %s:",
                        "renameTitle": "Renombrar"
                    },
                    "infoEmpty": "No hay datos para mostrar"
                },
                "responsive": true,

                "lengthChange": true,
                "autoWidth": false,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');




        });
    </script>
    <script>
        function Agregar(sku, precio, des, iduni) {
            const duplicado = buscarPorSKU(inventario, sku);



            if (duplicado) {

                alert("El articulo ya esta en la lsita");
            } else {
                inventario.push({
                    "SKU": sku,
                    "STRDES": des,
                    "STRREF": 'r',
                    "INTCANT": '0',
                    "INTIDUNI": iduni,
                    "MONPRCOS": precio,
                    "MONCTOPRO": '0'
                });
                ValidarEntradaSalida(inventario);
                console.log(JSON.stringify(inventario));

                contador++;

                indice = contador - 1;
                moneda = precio.toLocaleString('es-MX', {
                    style: 'currency',
                    currency: 'MXN'
                });
                var table = $('#example3').DataTable();

                table.row.add([
                    contador,
                    sku,
                    des,
                    '<input type="text" required class="form-control" id="R' + sku + '" name="Referencia[' + sku + ']"  onchange="ActualizarReferencia(\'' + sku + '\')" placeholder="rd4385: "  >',
                    '<input type="number" required class="form-control" id="C' + sku + '" name="C' + sku + '" placeholder="stock: " onchange="ActualizarCantidad(\'' + sku + '\')" onchange="Subtotal(' + sku + ',' + precio + ')"  min="1">',
                    formatToPesos(precio),
                    '  <span id="S' + sku + '">' + formatToPesos(TotalP) + '</span>',
                    '<button type="button" class="btn btn-danger btn-square btn-xs"   onclick="DeleteTable(' + indice + ',\'' + sku + '\')"><i class="far fa-trash-alt"></i></button> ',
                ]).draw(false);


            }






        }

        function Subtotal(sku, precio) {


            var subtotal = document.getElementById("C" + sku).value * precio;
            document.getElementById("S" + sku).innerText = formatToPesos(subtotal);

        }

        function DeleteTable(fila, sku) {
            // alert("Hola desde eliminar" + fila);
            var table = $('#example3').DataTable();
            table.row(fila).remove().draw();

            contador--;
            suma = 0;
            var IndiceDelete = getIndice(inventario, sku);

            var temp = inventario[IndiceDelete];
            TotalP -= temp.MONCTOPRO;

            inventario.splice(IndiceDelete, 1);
            ValidarEntradaSalida(inventario);
            $('#example3').DataTable();
            table.clear().draw();
            inventario.forEach(function(Elemento, indice) {
                count = indice - 1;
                suma += Elemento.MONPRCOS * Elemento.INTCANT;
                var table = $('#example3').DataTable();
                table.row.add([
                    indice + 1,
                    Elemento.SKU,
                    Elemento.STRDES,
                    '<input type="text" required class="form-control" id="R' + Elemento.SKU + '" name="Referencia[' + Elemento.SKU + ']"  onchange="ActualizarReferencia(\'' + Elemento.SKU + '\')" placeholder="rd4385: " value="' + Elemento.STRREF + '" >',
                    '<input type="number" required class="form-control" id="C' + Elemento.SKU + '" name="C' + Elemento.SKU + '" placeholder="21: " onchange="ActualizarCantidad(\'' + Elemento.SKU + '\')" onchange="Subtotal(' + Elemento.SKU + ',' + Elemento.MONPRCOS + ')"  min="1" value="' + Elemento.INTCANT + '">',
                    formatToPesos(Elemento.MONPRCOS),
                    '  <span id="S' + Elemento.SKU + '">' + formatToPesos(Elemento.MONPRCOS * Elemento.INTCANT) + '</span>',
                    '<button type="button" class="btn btn-danger btn-square btn-xs"  onclick="DeleteTable(' + indice + ',\'' + Elemento.SKU + '\')"><i class="far fa-trash-alt"></i></button>',
                ]).draw();

            });






        }


        function ActualizarReferencia(sku) {
            var Dato = $("#R" + sku).val();
            //  alert(Dato);

            console.log(sku);
            var temp = inventario[getIndice(inventario, sku)];

            temp.STRREF = Dato;


        }

        function ActualizarCantidad(sku) {
            var Dato = $("#C" + sku).val();

            if(Dato>0){
                var TipoMov = $("#INTTIPMOV").val();
            if (TipoMov == 1) {
                var temp = inventario[getIndice(inventario, sku)];

                temp.INTCANT = Dato;
                temp.MONCTOPRO = Dato * temp.MONPRCOS;
                document.getElementById("S" + sku).innerText = formatToPesos(temp.MONCTOPRO);
                calcularTotal(inventario);

            } else {

                validarStock(sku, Dato);
            }

            }else{alert("no se permiten numeros negativos");
                $("#C" + sku).val("");
            }
           







        }

        function buscarPorSKU(arr, sku) {
            return arr.find(item => item.SKU === sku);
        }

        function getIndice(array, sku) {
            return inventario.indexOf(buscarPorSKU(array, sku));
        }

        function validarStock(sku, cantidad) {
            parametros = {
                'id': sku,
                'cantidad': cantidad

            }
            $.ajax({
                type: "POST",
                url: "view/ajax/Funciones/Stock.php",
                data: parametros, // Usar el objeto FormData como los datos de la petición
                // Indicar a jQuery que no establezca el tipo de contenido
                success: function(data) {
                    if (data.trim() == "stock") {
                        $("#C" + sku).removeClass('is-invalid');
                        $("#C" + sku).addClass('is-valid');
                        var Dato = $("#C" + sku).val();
                        if (Dato > 0) {
                            //alert(Dato);
                            var temp = inventario[getIndice(inventario, sku)];

                            temp.INTCANT = Dato;
                            temp.MONCTOPRO = Dato * temp.MONPRCOS;
                            document.getElementById("S" + sku).innerText = temp.MONCTOPRO;
                            calcularTotal(inventario);


                        }

                    } else {
                        $("#C" + sku).removeClass('is-valid');
                        $("#C" + sku).addClass('is-invalid');
                        $("#C" + sku).val('');
                        $("#C" + sku).attr('placeholder', 'stock disponible :' + data.trim());



                    }


                }
            });

        }

        function ValidarEntradaSalida(array) {

            (array.length > 0) ? document.getElementById('INTTIPMOV').disabled = true: document.getElementById('INTTIPMOV').disabled = false;


        }

        function calcularTotal(array) {
            var Total = 0;
            array.forEach(function(elemento) {

                Total += elemento.MONCTOPRO;

            });
            $("#Total").text(formatToPesos(Total));
        }
    </script>
    <script>
        $("#new_register").submit(function(event) {
            event.preventDefault();

            $('#guardar_datos').attr("disabled", true);
            if (inventario.length > 0) {
                INTTIPMOV = $('#INTTIPMOV').val();
                inventario = JSON.stringify(inventario);


                var formData = new FormData(this);

                formData.append('inventario', inventario); // Crear un objeto FormData
                formData.append('INTTIPMOV', INTTIPMOV);
                $.ajax({
                    type: "POST",
                    url: "view/ajax/agregar/agregar_entrada.php",
                    data: formData, // Usar el objeto FormData como los datos de la petición
                    processData: false, // Indicar a jQuery que no procese los datos
                    contentType: false, // Indicar a jQuery que no establezca el tipo de contenido
                    beforeSend: function(objeto) {
                        $(".resultados_ajax").html("Enviando...");
                    },
                    success: function(datos) {

                        $(".resultados_ajax").html(datos);
                        $('#guardar_datos').attr("disabled", false);
                        load(1);
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                $(this).remove();
                            });
                        }, 5000);
                        inventario = [];
                        table = $('#example3').DataTable();
                        table.clear().draw();
                        //$('#formModal').modal('hide');

                    }
                });
            } else {
                var datos = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Error! No se puede crear una entrada o salida sin datos </strong></div>';
                $(".resultados_ajax").html(datos);

            }


        });
    </script>
<?php
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
?>