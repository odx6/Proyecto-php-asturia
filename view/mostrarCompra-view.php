<?php
include "resources/header copy.php";
if (in_array(2, $_SESSION['Habilidad']['compras']) && isset($_POST["idecompra"]) ) {

    require_once("./config/config.php");
    require_once("./config/funciones.php");
    if (isset($_POST["idecompra"])) {
        $idempleado = $_SESSION['user_id'];
        $id = $_POST["idecompra"];


        $id = intval($id);
        //$sql = " select * from tbcom where PK_COMPRA='$id' and loked=1 and Editor='0' or INTIDINV='$id' and loked=0 and Editor='$idempleado';";
        $sql = " select * from tblcom where PK_COMPRA='$id';";
        $sql = "  select tblcom.*,tblcatprov.STRNOM,tblcatalm.STRNOMALM from tblcom INNER JOIN tblcatprov on tblcatprov.pk_prov=tblcom.FK_PROVE INNER JOIN tblcatalm on tblcatalm.INTIDALM=tblcom.FK_ALMACEN where PK_COMPRA='$id';";
      


        $query = mysqli_query($con, $sql);
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            // $Editor = "UPDATE tblinv SET loked = '0',Editor = '$idempleado' WHERE INTIDINV='$id';";
            //$query1 = mysqli_query($con, $Editor);
            while ($row = mysqli_fetch_array($query)) {
                $PK_COMPRA = $row["PK_COMPRA"];
                $FK_PROVE = $row["FK_PROVE"];
                $name = $row["STRNOM"];
                $almacen=$row['STRNOMALM'];
                $FK_EMP = $row["FK_EMP"];
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
                        <h1> <i class="fas fa-dolly"></i>Datos de la compra : <?php echo $PK_COMPRA ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Mostrar Compra</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="container-fluid">
                <?php include "modals/Productos_modal.php"; ?>
                <div class="resultados_ajax"></div>



                <form class="form-horizontal" role="form" method="post" id="update_register" name="update_register" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" required class="form-control is-invalid" id="IDEMP" name="IDEMP" placeholder="Folio: " value="<?php echo $_SESSION['user_id'] ?>">
                        <input type="hidden" required class="form-control" id="PK_COMPRA" name="PK_COMPRA" placeholder="Folio:" value="<?php echo $PK_COMPRA; ?>">
                        <div class="col-2">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-text-width"></i>
                                        Datos de la compra
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <dl>
                                        <dt>Proveedor</dt>
                                        <dd> <?php

                                                echo $name;

                                                ?></dd>
                                        <dt>Numero de remision</dt>
                                        <dd><?php echo $STREMI; ?></dd>
                                       
                                        <dt>Numero de Factura</dt>
                                        <dd><?php echo $STRFACT ?></dd>
                                        <dt>Fecha de la factura</dt>
                                        <dd><?php echo $DTHORFAC ?></dd>
                                        <dt>Fecha de pago</dt>
                                        <dd> <?php echo $DTHORPAG; ?></dd>
                                        <dt>Almacen</dt>
                                        <dd> <?php echo $almacen; ?></dd>
                                    </dl>
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de productos detalle compra</h3>
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

                                            </tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="Totalm"></th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer">


                </form>
                <a href="./?view=Compras"><button type="button" id="cancelar_datos" class="btn btn-success" style="margin-top: 15px;">Regresar</button></a>

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
                            Elemento.PCRCOST,
                            Elemento.INTCANT,

                            Elemento.PCRCOSTANTE,
                            Elemento.TOTAL,

                        ]).draw(false);

                    });

                    $("#Totalm").text(suma);


                }

            })

        }
    </script>
<?php
} else {
    require 'resources/acceso_prohibido.php';
}
ob_end_flush();
?>