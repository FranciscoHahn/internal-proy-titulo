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
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />


    <title>Siglo 21 - Interno</title>
</head>

<body style="">

    @yield('content')


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>



    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
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
