function renderTable() {

    button = ["excel", "print"];
    var button1 = [];

    $("#example1").DataTable({
        "language":
        {
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
        "buttons": button,
        "lengthMenu": [
            [10, 25, 100, -1],
            [10, 25, 100, 'All']
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    var btn = document.createElement('button');

    // Asignar el texto del botón
    btn.textContent = 'Nuevo registro';
    btn.className = 'btn btn-secondary buttons-excel buttons-html5';
    btn.setAttribute('data-toggle', 'modal');
    btn.setAttribute('data-target', '#formModal');


    btn.addEventListener('click', function () {

        resetForm();
    });

    // creacion de los botones y los input para el filtado por fechas 




    //
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(btn);


}

function renderTable2() {

    $("#example1").DataTable({
        "language":
        {
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
        "buttons": ["excel", "print"],

        "lengthMenu": [
            [10, 25, 100, -1],
            [10, 25, 100, 'All']
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



}

function renderTable3() {


    $("#example1").DataTable({
        "language":
        {
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
        //"buttons": ['excel', 'print','colvis'],
        //"buttons": ['excel', 'colvis'],
        "buttons": [
        ],
        "lengthMenu": [
            [10, 25, 100, -1],
            [10, 25, 100, 'All']
        ]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    var btn = document.createElement('button');

    // Asignar el texto del botón
    btn.textContent = 'Nuevo registro';
    btn.className = 'btn btn-secondary buttons-excel buttons-html5';
    btn.setAttribute('data-toggle', 'modal');
    // btn.setAttribute('data-target', '#formModal');
    btn.addEventListener('click', function () {

        window.location.href = './?view=AgregarEntrada';
    });

    var initDate = document.createElement('input');
    initDate.className = 'form-control-xs btn btn-secondary buttons-excel buttons-html5';
    initDate.setAttribute('type', 'date');
    initDate.setAttribute('title', 'fecha de inicio');

    initDate.setAttribute('value', 'default');
    initDate.setAttribute('name', 'FechaInicio');
    initDate.setAttribute('id', 'FechaInicio');

    var endDate = document.createElement('input');
    endDate.className = 'form-control-xs btn btn-secondary buttons-excel buttons-html5';
    endDate.setAttribute('type', 'date');
    endDate.setAttribute('title', 'fecha final');
    endDate.setAttribute('value', 'default');
    endDate.setAttribute('name', 'endfecha');
    endDate.setAttribute('id', 'endfecha');
    endDate.style.cssText = 'display: inline-block;'
    // creacion de los botones y los input para el filtado por fechas 

    var search = document.createElement('button');
    search.innerHTML = '<i class="fas fa-search"></i>';
    search.className = 'btn btn-secondary buttons-excel buttons-html5';

    //crear el select

    let select = document.createElement("select");
    select.className = 'btn btn-secondary buttons-excel buttons-html5';
    select.setAttribute('id', 'TipoBus');
    select.setAttribute('name', 'TipoBus');

    // Crear opciones
    let option1 = document.createElement("option");
    option1.setAttribute("value", "1");
    let option1Texto = document.createTextNode("General");
    option1.appendChild(option1Texto);

    let option2 = document.createElement("option");
    option2.setAttribute("value", "2");
    let option2Texto = document.createTextNode("Detallada");
    option2.appendChild(option2Texto);



    // Agregar opciones al select
    select.appendChild(option1);
    select.appendChild(option2);

    // Insertar el select en el cuerpo del documento
    document.body.appendChild(select);
    var search = document.createElement('button');
    search.innerHTML = '<i class="fas fa-search"></i>';
    search.className = 'btn btn-secondary buttons-excel buttons-html5';

    //crear el select

    let movimiento = document.createElement("select");
    movimiento.className = 'btn btn-secondary buttons-excel buttons-html5';
    movimiento.setAttribute('id', 'Movi');
    movimiento.setAttribute('name', 'Movi');

    // Crear opciones
    let option4 = document.createElement("option");
    option4.setAttribute("value", "1");
    let option4Texto = document.createTextNode("Entradas");
    option4.appendChild(option4Texto);

    let option5 = document.createElement("option");
    option5.setAttribute("value", "2");
    let option5Texto = document.createTextNode("Salidas");
    option5.appendChild(option5Texto);



    // Agregar opciones al select
    movimiento.appendChild(option4);
    movimiento.appendChild(option5);

    // Insertar el select en el cuerpo del documento
    document.body.appendChild(movimiento);









    //en select 
    search.addEventListener('click', function () {



        var table = $('#example1').DataTable();
        table.clear().draw();



        var Inicio = $('#FechaInicio').val();
        var Final = $('#endfecha').val();
        var Tipo = $('#TipoBus').val();
        var Movi = $('#Movi').val();


        if (typeof Inicio !== 'undefined' && Inicio !== null && typeof Final !== undefined && Final !== null && typeof Tipo !== undefined && Tipo !== null && typeof Movi !== undefined && Movi !== null) {
            //alert("Inicio :" + Inicio + "Final" + Final + "Busqueda" + Tipo)
            sessionStorage.setItem("Inicio", Inicio);
            sessionStorage.setItem("Final", Final);
            sessionStorage.setItem("Tipo", Tipo);
            sessionStorage.setItem("Tabla", Inicio);
            sessionStorage.setItem("Movi", Movi);




            var parametros = {
                'Inicio': Inicio,
                'Final': Final,
                'Tipo': Tipo,
                'Movi': Movi,


            }

            $.ajax({
                type: "POST",
                url: 'view/ajax/Entradas/EntradasDate.php',
                data: parametros,
                beforeSend: function (objeto) {
                    $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                },
                success: function (data) {
                    $(".outer_div").html(data).fadeIn('slow');
                    $("#loader").html("");
                    renderTable3();
                    window.setTimeout(function () {
                        $(".alert").fadeTo(500, 0).slideUp(500, function () {
                            $(this).remove();
                        });
                    }, 5000);
                }
            })



        } else {

            alert("Erro ! : no puede haber campos vacios");
        }





    });

    //exportar
    var btnExpo = document.createElement('button');
    btnExpo.className = ' form-control-xs btn btn-secondary buttons-excel buttons-html5';
    // Asignar el texto del botón
    btnExpo.textContent = 'PDF';


    //  btnExpo.setAttribute('data-toggle', 'modal');
    // btn.setAttribute('data-target', '#formModal');
    btnExpo.addEventListener('click', function () {
        var tbody = document.querySelector('#example1 tbody');

        // Crear un array para almacenar los datos de la tabla
        var data = [];

        // Iterar sobre las filas del tbody
        for (var i = 0; i < tbody.rows.length; i++) {
            var row = tbody.rows[i];
            var rowData = [];

            // Iterar sobre las celdas de la fila y obtener los datos
            for (var j = 0; j < row.cells.length; j++) {
                var cell = row.cells[j];
                rowData.push(cell.textContent);
            }

            // Agregar la fila al array de datos
            data.push(rowData);
        }

        var tabla = JSON.stringify(data);

        // Mostrar el array de datos en la consola


        var Inicio = sessionStorage.getItem("Inicio");
        var Final = sessionStorage.getItem("Final");
        var Tipo = sessionStorage.getItem("Tipo");
        var Tabla = sessionStorage.getItem("Movi");
        if (typeof Inicio !== 'undefined' && Inicio !== null && typeof Final !== undefined && Final !== null && typeof Tipo !== undefined && Tipo !== null && typeof Movi !== undefined && Movi !== null) {

            var parametros = {
                'Inicio': Inicio,
                'Final': Final,
                'Tipo': Tipo,
                'Tabla': Tabla

            }

            $.ajax({
                type: "POST",
                url: 'view/reporteEntradas-view.php',
                data: parametros,
                beforeSend: function (objeto) {
                    $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                },
                success: function (data) {
                    var pdfWindow = window.open("reporte", "_blank");
                    pdfWindow.document.write('<embed src="data:application/pdf;base64,' + data + '" type="application/pdf" width="100%" height="100%" />');

                    //$(".outer_div").html('<embed src="' + data + '" type="application/pdf" width="100%" height="600px" />');
                    // window.open('generated_pdf.pdf', '_blank');
                    /*               $(".outer_div").html('<iframe src="data:application/pdf;base64,' + data + '"></iframe>');
          
                       
                         $(".outer_div").html(data).fadeIn('slow');
                          $("#loader").html("");
                          renderTable3();
                          window.setTimeout(function () {
                              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                  $(this).remove();
                              });
                          }, 5000); */
                },
            })
        } else {
            alert("Erro ! : no puede haber campos vacios");
        }



        // alert("Inicio" + Inicio + "Final" + Final + "tipo" + Tipo)



    });

    //endExportar
    var expodina = document.createElement('button');
    expodina.innerHTML = 'pdf2';
    expodina.className = 'btn btn-secondary buttons-excel buttons-html5';
    expodina.addEventListener('click', function () {

        Imprimir();
    });


    //
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(btnExpo);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(btn);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(initDate);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(endDate);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(select);

    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(movimiento);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(search);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(expodina);




}

function renderTableCompras() {
    $("#example1").DataTable({
        "language":
        {
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
        "buttons": [
        ],
        "lengthMenu": [
            [10, 25, 100, -1],
            [10, 25, 100, 'All']
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    var btn = document.createElement('button');

    // Asignar el texto del botón
    btn.textContent = 'Nuevo registro';
    btn.className = 'btn btn-secondary buttons-excel buttons-html5';
    btn.setAttribute('data-toggle', 'modal');
    // btn.setAttribute('data-target', '#formModal');
    btn.addEventListener('click', function () {

        window.location.href = './?view=AgregarCompra';
    });
    $('#example1_wrapper .col-md-6:eq(0)').append(btn);
    var initDate = document.createElement('input');
    initDate.className = 'form-control-xs btn btn-secondary buttons-excel buttons-html5';
    initDate.setAttribute('type', 'date');
    initDate.setAttribute('title', 'fecha de inicio');

    initDate.setAttribute('value', 'default');
    initDate.setAttribute('name', 'FechaInicio');
    initDate.setAttribute('id', 'FechaInicio');

    var endDate = document.createElement('input');
    endDate.className = 'form-control-xs btn btn-secondary buttons-excel buttons-html5';
    endDate.setAttribute('type', 'date');
    endDate.setAttribute('title', 'fecha final');
    endDate.setAttribute('value', 'default');
    endDate.setAttribute('name', 'endfecha');
    endDate.setAttribute('id', 'endfecha');
    endDate.style.cssText = 'display: inline-block;'
    // creacion de los botones y los input para el filtado por fechas 

    var search = document.createElement('button');
    search.innerHTML = '<i class="fas fa-search"></i>';
    search.className = 'btn btn-secondary buttons-excel buttons-html5';

    //crear el select

    let select = document.createElement("select");
    select.className = 'btn btn-secondary buttons-excel buttons-html5';
    select.setAttribute('id', 'TipoBus');
    select.setAttribute('name', 'TipoBus');

    // Crear opciones
    let option1 = document.createElement("option");
    option1.setAttribute("value", "1");
    let option1Texto = document.createTextNode("General");
    option1.appendChild(option1Texto);

    let option2 = document.createElement("option");
    option2.setAttribute("value", "2");
    let option2Texto = document.createTextNode("Detallada");
    option2.appendChild(option2Texto);



    // Agregar opciones al select
    select.appendChild(option1);
    select.appendChild(option2);

    // Insertar el select en el cuerpo del documento









    //en select 
    search.addEventListener('click', function () {

  

    var table = $('#example1').DataTable();
        table.clear().draw();



        var Inicio = $('#FechaInicio').val();
        var Final = $('#endfecha').val();
        var Tipo = $('#TipoBus').val();
        var Movi = $('#Movi').val();


        if (typeof Inicio !== 'undefined' && Inicio !== null && typeof Final !== undefined && Final !== null && typeof Tipo !== undefined && Tipo !== null && typeof Movi !== undefined && Movi !== null) {
            alert("Inicio :" + Inicio + "Final" + Final + "Busqueda" + Tipo)
            sessionStorage.setItem("Inicio", Inicio);
            sessionStorage.setItem("Final", Final);
            sessionStorage.setItem("Tipo", Tipo);
            sessionStorage.setItem("Tabla", Inicio);




            var parametros = {
                'Inicio': Inicio,
                'Final': Final,
                'Tipo': Tipo,
                'Movi': Movi,


            }

            $.ajax({
                type: "POST",
                url: 'view/ajax/Compras/ComprasDate.php',
                data: parametros,
                beforeSend: function (objeto) {
                    $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                },
                success: function (data) {
                    $(".outer_div").html(data).fadeIn('slow');
                    $("#loader").html("");
                    renderTableCompras();
                    window.setTimeout(function () {
                        $(".alert").fadeTo(500, 0).slideUp(500, function () {
                            $(this).remove();
                        });
                    }, 5000);
                }
            })



        } else {

            alert("Erro ! : no puede haber campos vacios");
        }




    });

    //exportar
    var btnExpo = document.createElement('button');
    btnExpo.className = ' form-control-xs btn btn-secondary buttons-excel buttons-html5';
    // Asignar el texto del botón
    btnExpo.textContent = 'PDF';


    //  btnExpo.setAttribute('data-toggle', 'modal');
    // btn.setAttribute('data-target', '#formModal');
    btnExpo.addEventListener('click', function () {
       var tbody = document.querySelector('#example1 tbody');

        // Crear un array para almacenar los datos de la tabla
        var data = [];

        // Iterar sobre las filas del tbody
        for (var i = 0; i < tbody.rows.length; i++) {
            var row = tbody.rows[i];
            var rowData = [];

            // Iterar sobre las celdas de la fila y obtener los datos
            for (var j = 0; j < row.cells.length; j++) {
                var cell = row.cells[j];
                rowData.push(cell.textContent);
            }

            // Agregar la fila al array de datos
            data.push(rowData);
        }

        var tabla = JSON.stringify(data);

        // Mostrar el array de datos en la consola


        var Inicio = sessionStorage.getItem("Inicio");
        var Final = sessionStorage.getItem("Final");
        var Tipo = sessionStorage.getItem("Tipo");
        //  var Tabla = sessionStorage.getItem("Movi");
        if (typeof Inicio !== 'undefined' && Inicio !== null && typeof Final !== undefined && Final !== null && typeof Tipo !== undefined && Tipo !== null) {

            var parametros = {
                'Inicio': Inicio,
                'Final': Final,
                'Tipo': Tipo


            }

            $.ajax({
                type: "POST",
                url: 'view/reporteCompras-view.php',
                data: parametros,
                beforeSend: function (objeto) {
                    $("#loader").html("<img src='./assets/img/ajax-loader.gif'>");
                },
                success: function (data) {
                    var pdfWindow = window.open("reporte", "_blank");
                    pdfWindow.document.write('<embed src="data:application/pdf;base64,' + data + '" type="application/pdf" width="100%" height="100%" />');

                    //$(".outer_div").html('<embed src="' + data + '" type="application/pdf" width="100%" height="600px" />');
                    // window.open('generated_pdf.pdf', '_blank');
                    /*               $(".outer_div").html('<iframe src="data:application/pdf;base64,' + data + '"></iframe>');
          
                       
                         $(".outer_div").html(data).fadeIn('slow');
                          $("#loader").html("");
                          renderTable3();
                          window.setTimeout(function () {
                              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                  $(this).remove();
                              });
                          }, 5000);
                          */
                },
            })
        } else {
            alert("Erro ! : no puede haber campos vacios");
        }




        // alert("Inicio" + Inicio + "Final" + Final + "tipo" + Tipo)



    });

    //exportar dinamico
    var expodina = document.createElement('button');
    expodina.innerHTML = 'imprimir';
    expodina.className = 'btn btn-secondary buttons-excel buttons-html5';
    expodina.addEventListener('click', function () {

        Imprimir();
    });

    //
   

    //
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(btnExpo);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(btn);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(initDate);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(endDate);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(select);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(search);
    $("#example1_wrapper > div:nth-child(1) > div:nth-child(1) > div.dt-buttons.btn-group.flex-wrap").append(expodina);




}
function Imprimir() {




    // Obtener la instancia de la tabla
    var tabla = $('#example1').DataTable();

    // Obtener los títulos de las columnas
    var titulosColumnas = tabla.columns().header().toArray().map(function (columna) {
        return $(columna).text();
    });
    titulosColumnas.pop();
    // Imprimir los títulos de las columnas en la consola
    console.log(titulosColumnas);



    var tabla = $('#example1').DataTable();


    // Aplicar los filtros de búsqueda y obtener los datos filtrados en un array de objetos
    var datosFiltrados = tabla.rows({ search: 'applied' }).data().toArray();
   
    var jsonResultante = JSON.stringify(datosFiltrados);
    var  titulos = JSON.stringify(titulosColumnas);


    console.log(jsonResultante);
    var parametros = {
        'code': jsonResultante,
        'titulos':titulos

    };
    
    $.ajax({
        url: 'view/pdfDinamico-view.php',
        type: 'POST',
        data: parametros,
        beforeSend: function (objeto) {
            // $('#loader').html('<img src='./assets/img/ajax-loader.gif'>');
        },
        success: function (data) {
            var pdfWindow = window.open("reporte", "_blank");
            pdfWindow.document.write('<embed src="data:application/pdf;base64,' + data + '" type="application/pdf" width="100%" height="100%" />');

        }
    })


}