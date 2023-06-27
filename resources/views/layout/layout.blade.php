<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/fh-3.3.2/datatables.min.css"
        rel="stylesheet" />




    <title>Siglo 21 - Interno</title>
</head>

<body style="">

    @yield('content')


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/fh-3.3.2/datatables.min.js">
    </script>


    <script>
        $(document).ready(function() {
            if ($('#tabla-ventas').length) {
                // Setup - add a text input to each footer cell
                $('#tabla-ventas thead tr')
                    .clone(true)
                    .addClass('filters')
                    .appendTo('#tabla-ventas thead');

                var table = $('#tabla-ventas').DataTable({
                    search: false,
                    language: {
                        "sProcessing": "<small>Procesando...</small>",
                        "sLengthMenu": "<small>Mostrar _MENU_ registros</small>",
                        "sZeroRecords": "<small>No se encontraron resultados</small>",
                        "sEmptyTable": "<small>Ningún dato disponible en esta tabla</small>",
                        "sInfo": "<small>Registros del _START_ al _END_ de un total de _TOTAL_</small>",
                        "sInfoEmpty": "<small>registros del 0 al 0 de un total de 0 registros</small>",
                        "sInfoFiltered": "<small>(filtrado de un total de _MAX_ registros)</small>",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "<small>Cargando...</small>",
                        "oPaginate": {
                            "sFirst": "<small>Primero</small>",
                            "sLast": "<small>Último</small>",
                            "sNext": "&rarr;",
                            "sPrevious": "&larr;"
                        },
                        "oAria": {
                            "sSortAscending": ": <small>Activar para ordenar la columna de manera ascendente</small>",
                            "sSortDescending": ": <small>Activar para ordenar la columna de manera descendente</small>"
                        },
                        "buttons": {
                            "copyTitle": 'Copiado al portapapeles',
                            "copyKeys": 'Presiona <i>ctrl</i> o <i>\u2318</i> + <i>C</i> para copiar los datos de la tabla al portapapeles. <br><br>Para cancelar, haz clic en este mensaje o presiona Esc.',
                            "copySuccess": {
                                _: '%d filas copiadas',
                                1: '1 fila copiada'
                            }
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                            text: 'Copiar', // Cambia el nombre del botón de copiar
                            extend: 'copyHtml5'
                        },
                        {
                            text: 'Exportar a Excel', // Cambia el nombre del botón de Excel
                            extend: 'excelHtml5'
                        },
                        {
                            text: 'Exportar a PDF', // Cambia el nombre del botón de PDF
                            extend: 'pdfHtml5'
                        }
                    ],
                    orderCellsTop: true,
                    initComplete: function() {
                        var api = this.api();

                        // For each column
                        api
                            .columns()
                            .eq(0)
                            .each(function(colIdx) {
                                // Set the header cell to contain the input element
                                var cell = $('.filters th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();
                                $(cell).html('<input type="text" placeholder="' + title + '" />');

                                // On every keypress in this input
                                $(
                                        'input',
                                        $('.filters th').eq($(api.column(colIdx).header()).index())
                                    )
                                    .off('keyup change')
                                    .on('change', function(e) {
                                        // Get the search value
                                        $(this).attr('title', $(this).val());
                                        var regexr =
                                            '({search})'; //$(this).parents('th').find('select').val();

                                        var cursorPosition = this.selectionStart;
                                        // Search the column for that value
                                        api
                                            .column(colIdx)
                                            .search(
                                                this.value != '' ?
                                                regexr.replace('{search}', '(((' + this.value +
                                                    ')))') :
                                                '',
                                                this.value != '',
                                                this.value == ''
                                            )
                                            .draw();
                                    })
                                    .on('keyup', function(e) {
                                        e.stopPropagation();

                                        $(this).trigger('change');
                                        $(this)
                                            .focus()[0]
                                            .setSelectionRange(cursorPosition, cursorPosition);
                                    });
                            });
                    },
                });
            } else {
                // La tabla con ID 'tabla-ventas' no existe
                $('table').DataTable({
                    language: {
                        "sProcessing": "<small>Procesando...</small>",
                        "sLengthMenu": "<small>Mostrar _MENU_ registros</small>",
                        "sZeroRecords": "<small>No se encontraron resultados</small>",
                        "sEmptyTable": "<small>Ningún dato disponible en esta tabla</small>",
                        "sInfo": "<small>Registros del _START_ al _END_ de un total de _TOTAL_</small>",
                        "sInfoEmpty": "<small>registros del 0 al 0 de un total de 0 registros</small>",
                        "sInfoFiltered": "<small>(filtrado de un total de _MAX_ registros)</small>",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "<small>Cargando...</small>",
                        "oPaginate": {
                            "sFirst": "<small>Primero</small>",
                            "sLast": "<small>Último</small>",
                            "sNext": "&rarr;",
                            "sPrevious": "&larr;"
                        },
                        "oAria": {
                            "sSortAscending": ": <small>Activar para ordenar la columna de manera ascendente</small>",
                            "sSortDescending": ": <small>Activar para ordenar la columna de manera descendente</small>"
                        }
                    }
                });
            }
        });
    </script>

    <script>
        $('.entregarpedidococina').click(function() {
            var pedidoId = $(this).data('id'); // Obtener el ID del pedido
            var cardId = '#cuerpocarta-' + pedidoId; // Construir el ID de la carta

            $.post('{{ route('pedidodisponiblecocina') }}', {
                id: pedidoId
            }, function(data) {
                $(cardId).hide();
            });
        });

        //btnmeseroentregar
        $('.btnmeseroentregar').click(function() {

            var pedidoId = $(this).data('id'); // Obtener el ID del pedido
            var cardId = '#pedidocardmesero-' + pedidoId; // Construir el ID de la carta
            var badgeId = '#badgeestadoatencion-' + pedidoId;
            var divisionId = '#divisionpedido-' + +pedidoId;
            $(cardId).removeClass().addClass('card border border-info opacity-75');
            var spanElement = $('<span>').addClass('badge badge-info').text('Entregado');
            $(badgeId).replaceWith(spanElement);
            $(this).replaceWith(spanElement);

            $.post('{{ route('pedidoentregadomesa') }}', {
                id: pedidoId
            }, function(data) {});


            $('#pedidostodos').append($(divisionId));


        });


        //cancelarpedidomesero
        //btnmeserocancelarpedido
        $('.btnmeserocancelarpedido').click(function() {

            var pedidoId = $(this).data('id'); // Obtener el ID del pedido
            var cardId = '#pedidocardmesero-' + pedidoId; // Construir el ID de la carta
            var badgeId = '#badgeestadoatencion-' + pedidoId;
            var divisionId = '#divisionpedido-' + +pedidoId;
            $(cardId).removeClass().addClass('card border border-secondary opacity-50');
            var spanElement = $('<span>').addClass('badge badge-secondary opacity-50').text('cancelado');
            $(badgeId).replaceWith(spanElement);
            $(this).hide();
            //$(this).replaceWith(spanElement);

            $.post('{{ route('cancelarpedidomesero') }}', {
                id: pedidoId
            }, function(data) {});


            $('#pedidostodos').append($(divisionId));

        });
    </script>


</body>

</html>
