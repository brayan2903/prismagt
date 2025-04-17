<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .empresa-info {
            margin-bottom: 30px;
        }
        .empresa-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .empresa-info td {
            padding: 6px;
        }
        .empresa-info .label {
            font-weight: bold;
            width: 150px;
        }
        .productos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .productos th, .productos td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .productos th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2 class="header">COTIZACIÓN N° {{ $param2 }}</h2>

    <div class="empresa-info">
        <table>
            <tr>
                <td class="label">RUC:</td>
                <td>{{ $resultados[0]->RucAnx ?? 'No hay datos' }}</td>
            </tr>
            <tr>
                <td class="label">Razón Social:</td>
                <td>{{ $resultados[0]->NomAnx ?? 'No hay datos' }}</td>
            </tr>
            <tr>
                <td class="label">Dirección:</td>
                <td>{{ $resultados[0]->DirAnx ?? 'No hay datos' }}</td>
            </tr>
            <tr>
                <td class="label">Correo:</td>
                <td>{{ $resultados[0]->EmailAnx ?? 'No hay datos' }}</td>
            </tr>
            <tr>
                <td class="label">Teléfono:</td>
                <td>{{ $resultados[0]->TlfnAnx ?? 'No hay datos' }}</td>
            </tr>
            <tr>
                <td class="label">Giro:</td>
                <td>{{ $resultados[0]->GiroAnx ?? 'No hay datos' }}</td>
            </tr>
        </table>
    </div>

    <h3>Detalle de Cotización</h3>

    <table class="productos">
        <thead>
            <tr>
                <th>#</th>
                <th>Producto/Servicio</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->Producto ?? '-' }}</td>
                    <td>{{ $item->Descripcion ?? '-' }}</td>
                    <td>{{ $item->Cantidad ?? 0 }}</td>
                    <td>S/ {{ number_format($item->PrecioUnitario ?? 0, 2) }}</td>
                    <td>S/ {{ number_format($item->Total ?? 0, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
