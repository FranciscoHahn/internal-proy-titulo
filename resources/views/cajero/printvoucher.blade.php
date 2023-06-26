<!DOCTYPE html>
<html>

<head>
    <title>Voucher de Atención</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <h1>Voucher de Atención</h1>

    <h2>Información de la Atención</h2>
    <table>
        <tr>
            <th>Atención</th>
            <th>Mesa</th>
            <th>Fecha de Atención</th>
        </tr>
        <tr>
            <td># {{ $atencion_actual->id }}</td>
            <td># {{ $atencion_actual->numero }}</td>
            <td>{{ $atencion_actual->fecha_atencion }}</td>
        </tr>
    </table>

    <h2>Pedidos Entregados</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($pedidos_entregados as $pedido)
            <tr>
                <td>{{ $pedido->nombre }}</td>
                <td>{{ $pedido->descripcion }}</td>
                <td style="word-wrap: nowrap;">$&nbsp;{{ intval($pedido->precio_pedido) }}</td>
                <td>{{ $pedido->cantidad }}</td>
                <td style="word-wrap: nowrap;">$&nbsp;{{ $pedido->cantidad * $pedido->precio_pedido }}</td>
            </tr>
        @endforeach
    </table>

    <h2>Total y Propina Sugerida</h2>
    <table>
        <tr>
            <th>Total</th>
            <th>Propina Sugerida (10%)</th>
            <th>Total + propina</th>
        </tr>
        <tr>
            <td style="word-wrap: nowrap;">$&nbsp;{{ $total }}</td>
            <td style="word-wrap: nowrap;">$&nbsp;{{ $propina_sugerida }}</td>
            <td style="word-wrap: nowrap;">$&nbsp;{{ $total + $propina_sugerida }}</td>
        </tr>
    </table>
    <h3>
        Muchas gracias por su visita a Siglo XXI
    </h3>
</body>

</html>
