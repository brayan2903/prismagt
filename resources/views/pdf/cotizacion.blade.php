<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <style>
        @page {
        header: pdfHeader; /* Aplica el encabezado a todas las páginas */
        margin-top: 50px; /* Aumenta el margen superior para evitar que el contenido se superponga */
        background-image: url("{{ public_path('images/fondo_aguas.png') }}");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 15cm 20cm; /* Ajusta el tamaño exacto de la imagen */
    }
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        /* Encabezado */
        .encabezado {
            width: 10%;
            border-collapse: collapse;
        }

        .cotizacion {
            background-color: #0D1F3C;
            color: white;
            padding: 15px;
            width: 500px;
            text-align: center;
            border-top-right-radius: 90px;
            border-bottom-left-radius: 90px;
        }


        .cotizacion h1 {
            margin: 100px;
            font-size: 3.1rem;
        }

        .cotizacion p {
            margin: 100px;
            font-size: 1.9rem;
        }

        .logo {
            text-align: right;
            vertical-align: top;
        }

        .logo img {
            width: 300px;
            height: auto;
            float: right;
        }

        .logo p {
            margin-top: 80px;
            font-size: 0.9rem;
        }

        /* Secciones generales */
        .section {
            margin-top: 20px;
        }

        .section h2 {
            font-size: 16px;
            background-color: #b0d3e87e;
            padding: 5px;
            border-left: 5px solid #2863c288;
        }

        /* Tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table, .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        /* Pie de página */
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
        .presentacion {
    font-family: Arial, sans-serif;
    font-size: 1rem;
    color: #333;
    text-align: justify;
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}
.cuadro-inversion {
    display: flex;
    justify-content: space-between;
    border: 2px solid #007BFF;
    border-radius: 5px;
    padding: 8px;
    font-weight: bold;
    width: 300px;
    text-align: center;
    margin: 10px auto; /* Centra el cuadro horizontalmente */
}
.beneficios-implementacion {
    font-family: Arial, sans-serif;
    color: #333;
    text-align: center;
}

.tabla-beneficios {
    width: 100%;
    max-width: 700px;
    margin: 10px auto;
    border-collapse: collapse;
}

.tabla-beneficios td {
    padding: 5px 10px;
    vertical-align: middle;
    font-size: 1rem;
}

.tabla-beneficios img {
    width: 12px; /* 🔹 Ícono pequeño */
    height: 12px;
    margin-right: 5px; /* Espacio entre icono y texto */
    vertical-align: middle;
}
.section p {
    display: inline-block;
    margin: 2px 0;
}






    </style>
</head>
<body>

    <!-- ENCABEZADO -->
    <table class="encabezado">
        <tr>
            <td class="cotizacion">
                <h1>COTIZACIÓN {{ $resultados[0]->SDoc ?? 'No hay datos' }}-{{ $resultados[0]->NDoc ?? 'No hay datos' }}</h1>
                <h3>Administración y Finanzas</h3>
            </td>
            <td class="logo">
                <img src="images/NavBar_ERP_Prisma.jpg" alt="ERP Prisma">
                <h3> Lima, {{ \Carbon\Carbon::parse($resultados[0]->FDoc)->translatedFormat('F Y') ?? 'No hay datos' }}</h3>
            </td>
        </tr>
    </table>
<br>
<br>
    <div class="container">
        <div class="presentacion">
            Reciba un cordial saludo de parte de <strong>GlobalTech Innovaciones SAC</strong>
            con RUC <strong>20552260679</strong>, me dirijo a ustedes con el fin de presentarnos
            como Empresa Proveedora de Servicios de Tecnologías de Información, nos especializamos en
            el desarrollo de soluciones informáticas relacionadas con Software del Rubro Comercial e Industrial.
        </div>

        <!-- DATOS DE LA EMPRESA -->
        <div class="section">
            <h2>Empresa</h2>
            <p><strong>RUC:</strong> {{ $resultados[0]->RucAnx ?? 'No hay datos' }}</p>
            <p><strong>Razón Social:</strong> {{ $resultados[0]->NomAnx ?? 'No hay datos' }}</p>
            <p><strong>Dirección:</strong> {{ $resultados[0]->DirAnx ?? 'No hay datos' }}</p>
            <p><strong>Correo:</strong> {{ $resultados[0]->EmailAnx ?? 'No hay datos' }}</p>
            <p><strong>Teléfono:</strong> {{ $resultados[0]->TlfnAnx ?? 'No hay datos' }}</p>
            <p><strong>Giro:</strong> {{ $resultados[0]->GiroAnx ?? 'No hay datos' }}</p>
        </div>

        <!-- COSTO DE IMPLEMENTACIÓN -->
        <div class="section">
            <h2>INVERSIÓN PARA LA IMPLEMENTACIÓN <span>(pago único)</span></h2>
            <div class="cuadro-inversion">
                <div>Costo de Implementación {{ $resultados[0]->sMnd ?? 'No hay datos' }} {{ $resultados[0]->ImpCP ?? 'No hay datos' }} + IGV</div>
            </div>
            <p>El pago para la Implementación es por anticipado. (para pago en soles se aplica al tipo de cambio de venta SUNAT.)</p>
        </div>


        <!-- BENEFICIOS -->
        <div class="section">
            <h2>Beneficios de la Implementación</h2>
            <table class="tabla-beneficios">
                <tr>
                    <td><img src="images/che.png" alt="check"> Migración de información desde otras fuentes en 4 días.</td>
                    <td><img src="images/che.png" alt="check"> Configuración de equipos de terminales.</td>
                </tr>
                <tr>
                    <td><img src="images/che.png" alt="check"> Capacitación al personal según áreas de trabajo.</td>
                    <td><img src="images/che.png" alt="check"> Configuración de celulares para el sistema de toma de pedidos.</td>
                </tr>
                <tr>
                    <td><img src="images/che.png" alt="check"> Puesta en marcha del sistema con prueba piloto.</td>
                    <td><img src="images/che.png" alt="check"> Refuerzo post implementación para el CLIENTE.</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>REQUERIMIENTOS:</h2>
            <ul>
                <li>Computadora con <strong>Windows 10 Pro</strong> o superior.</li>
                <li>Red <strong>LAN correctamente configurada</strong>.</li>
                <li>Conexión a <strong>Internet</strong>.</li>
                <li>Facilitar datos en <strong>Excel</strong> o base de datos compatible con la migración.</li>
                <li>El servidor debe tener <strong>16 GB de RAM como minimo</strong>.</li>
            </ul>
        </div>



        <!-- MEMBRESÍA -->
        <div class="section">
            <h2>INVERSIÓN PARA MEMBRESIA ANUAL (por 2 meses)</h2>

        <div style="max-width: 900px; margin: 20px auto; font-family: Arial, sans-serif;">
            <table border="1" width="100%" cellspacing="0" cellpadding="10" style="border-collapse: collapse; text-align: left;">
                <thead style="background-color: #0073e6; color: white;">
                    <tr>
                        <th style="width: 5%;"></th>
                        <th style="width: 25%;">Servicio</th>
                        <th style="width: 10%;">Cant. Eqps</th>
                        <th style="width: 20%;">Importe Anual</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPagar = 0; // Variable para almacenar la suma total
                    @endphp

                    @foreach ($resultados as $servicio)
                        @php
                            // Procesar imagen si existe, si no, usar imagen por defecto
                            $imagen = $servicio->iFoto
                                ? 'data:image/png;base64,' . base64_encode($servicio->iFoto)
                                : asset('images/default.png'); // Imagen genérica

                            // Datos del servicio
                            $cantEqps = $servicio->CantPza > 0 ? $servicio->CantPza : '-';
                            $valPerYear = ($servicio->ValVtaUniD ?? 0) * 12; // Cálculo del importe anual
                            $totalPagar += $valPerYear; // Sumar al total
                            $nombreServicio = $servicio->NomPrd ?? 'Sin Nombre';
                            $descripcion = $servicio->ObsItem ?? '-';
                        @endphp
                        <!-- Primera fila (nombre e imagen) -->
                        <tr>
                            <td style="text-align: center;" rowspan="2">
                                <img src="{{ $imagen }}" alt="icono" width="40">
                            </td>
                            <td><b>{{ $nombreServicio }}</b></td>
                            <td rowspan="2">{{ $cantEqps }}</td>
                            <td rowspan="2">{{ $sMnd ?? 'S/' }}{{ number_format($valPerYear, 2) }} +IGV</td>
                        </tr>
                        <!-- Segunda fila (descripción) -->
                        <tr>
                            <td><i>{{ $descripcion }}</i></td>
                        </tr>
                    @endforeach

                    <!-- Fila de Total a Pagar -->
                    <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="2" style="text-align: right;">Total a Pagar:</td>
                        <td></td> <!-- Celda vacía para mantener estructura -->
                        <td>{{ $sMnd ?? 'S/' }}{{ number_format($totalPagar, 2) }} +IGV</td>
                    </tr>
                </tbody>
            </table>



            <p style="font-size: 12px; color: #666; text-align: center;">
                El pago es por anticipado por cada año. El primer año tiene un plazo de 30 días después de la puesta en marcha del sistema.
            </p>
        </div>



        <!-- BENEFICIOS DE LA MEMBRESÍA -->
        <div class="section">
            <h2>Beneficios de la Membresía</h2>
            <table class="tabla-beneficios">
                <tr>
                    <td><img src="images/Prisma7.png" alt="check"> Confidencialidad de la información.</td>
                    <td><img src="images/Prisma7.png" alt="check"> Actualización mediante archivos adjuntos.</td>
                </tr>
                <tr>
                    <td><img src="images/Prisma7.png" alt="check"> Detección y notificación de inconsistencias.</td>
                    <td><img src="images/Prisma7.png" alt="check"> Soporte telefónico o remoto.</td>
                </tr>
                <tr>
                    <td><img src="images/Prisma7.png" alt="check"> Mantenimiento ante errores del sistema.</td>
                    <td><img src="images/Prisma7.png" alt="check"> Asesoría para backup en SQL Server.</td>
                </tr>
            </table>
        </div>
        <!-- PIE DE PÁGINA -->
        <div class="footer">
            Quedo a la espera de cualquier consulta adicional. Ofrecemos una demostración y periodo de prueba.
        </div>
        <br>
        <div class="" style="text-align:center;">
            <img src="images/cuentas.png"  height="300px" style="" alt='image' />
        </div>

    </div>

</body>
</html>
