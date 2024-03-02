<?php
include "resources/header copy.php";
if (in_array(2, $_SESSION['Habilidad']['compras']) && isset($_POST["idecompra"])) {

    require_once("./config/config.php");
    require_once("./config/funciones.php");
    if (isset($_POST["idecompra"])) {
        $idempleado = $_SESSION['user_id'];
        $id = $_POST["idecompra"];


        $id = intval($id);
        //$sql = " select * from tbcom where PK_COMPRA='$id' and loked=1 and Editor='0' or INTIDINV='$id' and loked=0 and Editor='$idempleado';";
        $sql = " select * from tblcom where PK_COMPRA='$id';";


        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            // $Editor = "UPDATE tblinv SET loked = '0',Editor = '$idempleado' WHERE INTIDINV='$id';";
            //$query1 = mysqli_query($con, $Editor);
            while ($row = mysqli_fetch_array($query)) {
                $PK_COMPRA = $row["PK_COMPRA"];
                $FK_PROVE = $row["FK_PROVE"];
                $FK_EMP = $row["FK_EMP"];
                $INTIDALM = $row["FK_ALMACEN"];
                $STREMI = $row["STREMI"];
                $STRFACT = $row["STRFACTURA"];
                $DTHORFAC = $row["DTHORFAC"];
                $DTHORPAG = $row["DTHORPAG"];
                $DTHOR = $row["DTHOR"];
            }
        }
    } else {
        exit;
    }

?>




    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> <i class="fas fa-dolly"></i> Editar Compra</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Editar Compra </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="container-fluid">
                <?php include "modals/Productos_modal.php"; ?>
                <div class="resultados_ajax"></div>
                <div class="row">
                    <button class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#myModal">Agregar Producto<i class="fa fa-plus"></i></button>
                </div>
                <br>


                <form class="form-horizontal" role="form" method="post" id="update_register" name="update_register" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="FK_PROVE" required class="col-form-label">Proveedor: </label>
                                <?php

                                // Consulta SQL para obtener los datos
                                $consulta = "SELECT  pk_prov,STRNOM FROM tblcatprov ORDER BY STRNOM ASC";
                                $resultado = mysqli_query($con, $consulta);


                                // Crear el elemento select
                                echo ' <select class="form-control" name="FK_PROVE" id="FK_PROVE" required>';

                                if (isset($resultado) && $resultado != NULL &&  mysqli_num_rows($resultado) > 0) {

                                    // Iterar sobre los resultados y crear una opción para cada uno

                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        echo '<option value="' . $fila['pk_prov'] . '"  <?php if($FK_PROVE= $fila["pk_prov"]) echo  "selected" ?>   ' . $fila['STRNOM'] . '</option>';
                                    }
                                } else {

                                    echo  '<option value="" disabled  selected >No hay proveedores  en la base. </option>';
                                }

                                echo '</select>';
                                ?>


                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="STREMI" class=" col-form-label">Numero de Remision: </label>
                                <input type="text" required class="form-control" id="STREMI" name="STREMI" placeholder="remision: " value="<?php echo $STREMI; ?>">
                                <span id="STREMI"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="STRFACTURA" class=" col-form-label">Numero de Factura: </label>
                                <input type="number" class="form-control" id="STRFACTURA" name="STRFACTURA" placeholder="Factura: " value="<?php echo $STRFACT ?>">
                                <span id="STREMI"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="DTHORFAC" class=" col-form-label">Fecha de la factura : </label>
                                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                    <input type="date" class="form-control datetimepicker-input" id="DTHORFAC" name="DTHORFAG" value="<?php echo $DTHORFAC ?>" />
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="DTHORFAC" class=" col-form-label">Fecha de pago: </label>
                                <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                    <input type="date" class="form-control datetimepicker-input" data-target="#datetimepicker3" id="DTHORPAG" name="DTHORPAG" value="<?php echo $DTHORPAG; ?>" />
                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        echo '<option value="' . $fila['INTIDALM'] . '"  <?php if($INTIDALM= $fila["INTIDALM"]) echo "selected" ?>   ' . $fila['STRNOMALM'] . '</option>';
                                    }
                                } else {

                                    echo  '<option value="" disabled  selected >No hay datos de almacen en la base de datos registre nuevos </option>';
                                }

                                echo '</select>';
                                ?>

                            </div>
                        </div>

                    </div>
            </div>
            <input type="hidden" required class="form-control is-invalid" id="IDEMP" name="IDEMP" placeholder="Folio: " value="<?php echo $_SESSION['user_id'] ?>">
            <input type="hidden" required class="form-control" id="PK_COMPRA" name="PK_COMPRA" placeholder="Folio:" value="<?php echo $PK_COMPRA; ?>">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de productos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="comprasUpdate" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Indice</th>
                                    <th>FK_SKU</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Precio anterior</th>
                                    <th>Subtotal</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Indice</th>
                                    <th>FK_SKU</th>
                                    <th>Descripcion</th>
                                    <th>precio</th>
                                    <th>Cantidad</th>
                                    <th>Precio Anterior</th>
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
                <div class="modal-footer">

                    <button type="submit" id="guardar_datos" class="btn btn-primary" style="margin-top: 15px;">Guardar</button>
                    </form>
                    <a href="./?view=AgregarCompra"><button type="button" id="cancelar_datos" class="btn btn-danger" style="margin-top: 15px;">Cancelar</button></a>

                </div>




            </div>
    </div>





    </div>
    <!-- /.container-fluid -->
    </section>


    <?php
    include "resources/footer.php";



    ?>
    <Script>
        $(document).ready(function() {
            var ide = $('#PK_COMPRA').val();

            ComprasEdit(ide);


        });
    </Script>
    <script>
        $(function() {

            $("#comprasUpdate").DataTable({
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

        function ActualizarReferencia(sku) {
            var Dato = $("#R" + sku).val();
            $("#C" + sku).val("");
            //  alert(Dato);

            if (Dato > 0) {

                var temp = inventarioUpdate[getIndice(inventarioUpdate, sku)];

                temp.PCRCOST = Dato;
            } else {
                alert("ingresa un precio mayor a 0")
                $("#R" + sku).val("");







            }
        }

        function ActualizarCantidad(sku) {
            var cantidad = $("#R" + sku).val();
            var Dato = $("#C" + sku).val();
            if (cantidad > 0) {
                if (Dato > 0) {
                    var temp = inventarioUpdate[getIndice(inventarioUpdate, sku)];

                    temp.INTCANT = Dato;
                    temp.TOTAL = Dato * temp.PCRCOST;
                    document.getElementById("S" + sku).innerText = temp.TOTAL;
                    calcularTotal(inventarioUpdate);
                } else {
                    alert("ingresa una cantidad mayor a 0")
                    $("#C" + sku).val("");

                }


            } else {


                alert("ingresa un precio mayor a 0")
                $("#C" + sku).val("");
            }
        }

        function buscarPorSKU(arr, sku) {
            return arr.find(item => item.FK_SKU === sku);
        }

        function getIndice(array, sku) {
            return inventarioUpdate.indexOf(buscarPorSKU(array, sku));
        }

        function Agregar(sku, precio, des, iduni) {
            const duplicado = buscarPorSKU(inventarioUpdate, sku);



            if (duplicado) {

                alert("El articulo ya esta en la lista");
            } else {
                inventarioUpdate.push({
                    "FK_SKU": sku,
                    "STRDES": des,
                    "PCRCOST": '0',
                    "INTCANT": '0',
                    "INTIDUNI": iduni,
                    "MONPRCOS": precio,
                    "MONCTOPRO": '0'
                });


                contador++;

                indice = contador - 1;
                moneda = precio.toLocaleString('es-MX', {
                    style: 'currency',
                    currency: 'MXN'
                });
                var table = $('#comprasUpdate').DataTable();

                table.row.add([
                    contador,
                    sku,
                    des,
                    '<input type="number" required class="form-control" id="R' + sku + '" name="Referencia[' + sku + ']"  onchange="ActualizarReferencia(\'' + sku + '\')" placeholder="rd4385: "  >',
                    '<input type="number" required class="form-control" id="C' + sku + '" name="C' + sku + '" placeholder="stock: " onchange="ActualizarCantidad(\'' + sku + '\')" onchange="Subtotal(' + sku + ',' + precio + ')"  min="1">',
                    precio,
                    '  <span id="S' + sku + '">' + TotalP + '</span>',
                    '<button class="btn btn-danger btn-square btn-xs"   onclick="DeleteTable(' + indice + ',\'' + sku + '\')"><i class="far fa-trash-alt"></i></button> ',
                ]).draw(false);


            }






        }
    </script>
    <script>
        $("#update_register").submit(function(event) {
            $('#actualizar_datos').attr("disabled", true);
            if (inventarioUpdate.length > 0) {
                inventario = JSON.stringify(inventarioUpdate);
                var formData = new FormData(this);


                formData.append('inventario', inventario);

                $.ajax({
                    type: "POST",
                    url: "view/ajax/editar/editar_compra.php",
                    data: formData,
                    processData: false, // Indicar a jQuery que no procese los datos
                    contentType: false,
                    beforeSend: function(objeto) {
                        $("#resultados_ajax").html("Enviando...");
                    },
                    success: function(datos) {

                        $(".resultados_ajax").html(datos);
                        $('#actualizar_datos').attr("disabled", false);
                        load(1);
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                $(this).remove();
                            });
                        }, 5000);
                        $('#modal_update').modal('hide');


                    }
                });
            } else {

                var datos = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Error! No se puede editar una compra  sin productos </strong></div>';
                $(".resultados_ajax").html(datos);
            }
            event.preventDefault();
        });
    </script>

    <script>
        function ComprasEdit(id) {
            //Funcion Mostrar productos update

            var parametros = {
                "id": id


            };

            $.ajax({
                url: './view/ajax/compras/sql_compras.php',
                type: 'post',
                data: parametros,
                dataType: 'json',

                success: function(data) {


                    inventarioUpdate = data;
                    suma = 0;


                    inventarioUpdate.forEach(function(Elemento, indice) {
                        count = indice - 1;
                        suma += Elemento.PCRCOST * Elemento.INTCANT;
                        var table = $('#comprasUpdate').DataTable();
                        table.row.add([
                            indice + 1,
                            Elemento.FK_SKU,
                            Elemento.STRDES,
                            '<input type="text" required class="form-control" id="R' + Elemento.FK_SKU + '" name="Referencia[' + Elemento.FK_SKU + ']"  onchange="ActualizarReferencia(\'' + Elemento.FK_SKU + '\')" placeholder="rd4385: " value="' + Elemento.PCRCOST + '" >',
                            '<input type="number" required class="form-control" id="C' + Elemento.FK_SKU + '" name="C' + Elemento.FK_SKU + '" placeholder="21: " onchange="ActualizarCantidad(\'' + Elemento.FK_SKU + '\')" onchange="Subtotal(' + Elemento.FK_SKU + ',' + Elemento.PCRCOST + ')"  min="1" value="' + Elemento.INTCANT + '">',
                            Elemento.PCRCOSTANTE,
                            '  <span id="S' + Elemento.FK_SKU + '">' + Elemento.PCRCOST * Elemento.INTCANT + '</span>',
                            '<button type="button" class="btn btn-danger btn-square btn-xs"   onclick="DeleteTable(' + indice + ',\'' + Elemento.FK_SKU + '\')"><i class="far fa-trash-alt"></i></button> ',
                        ]).draw();

                    });

                    $("#Total").val(suma);


                }

            })

        }

        function calcularTotal(array) {
            var Total = 0;
            array.forEach(function(elemento) {

                Total += elemento.TOTAL;

            });
            $("#Total").text(Total);
        }

        function DeleteTable(fila, sku) {
            //alert("Hola desde eliminar" + fila);
            var table = $('#comprasUpdate').DataTable();
            table.row(fila).remove().draw();



            var IndiceDelete = getIndice(inventarioUpdate, sku);

            var temp = inventarioUpdate[IndiceDelete];
            TotalP -= temp.MONCTOPRO;

            inventarioUpdate.splice(IndiceDelete, 1);
            $('#comprasUpdate').DataTable();
            table.clear().draw();

            inventarioUpdate.forEach(function(Elemento, indice) {
                count = indice - 1;
                suma += Elemento.PCRCOST * Elemento.INTCANT;
                var table = $('#comprasUpdate').DataTable();
                table.row.add([
                    indice + 1,
                    Elemento.FK_SKU,
                    Elemento.STRDES,
                    '<input type="text" required class="form-control" id="R' + Elemento.FK_SKU + '" name="Referencia[' + Elemento.FK_SKU + ']"  onchange="ActualizarReferencia(\'' + Elemento.FK_SKU + '\')" placeholder="rd4385: " value="' + Elemento.PCRCOST + '" >',
                    '<input type="number" required class="form-control" id="C' + Elemento.FK_SKU + '" name="C' + Elemento.FK_SKU + '" placeholder="21: " onchange="ActualizarCantidad(\'' + Elemento.FK_SKU + '\')" onchange="Subtotal(' + Elemento.FK_SKU + ',' + Elemento.PCRCOST + ')"  min="1" value="' + Elemento.INTCANT + '">',
                    Elemento.PCRCOSTANTE,
                    '  <span id="S' + Elemento.FK_SKU + '">' + Elemento.PCRCOST * Elemento.INTCANT + '</span>',
                    '<button type="button" class="btn btn-danger btn-square btn-xs"   onclick="DeleteTable(' + indice + ',\'' + Elemento.FK_SKU + '\')"><i class="far fa-trash-alt"></i></button> ',
                ]).draw();

            });









        }
    </script>

<?php
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
?>