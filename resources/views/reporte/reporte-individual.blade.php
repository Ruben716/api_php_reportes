<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Individual de Asistencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin-right: 40px;
            margin-left: 40px;
            padding-bottom: 100px;
            min-height: 100vh;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .text-center {
            text-align: center;
        }

        .asistencia-table {
            width: 100%;
            border-collapse: collapse;
        }
        .asistencia-table th,

        .asistencia-table td {
            border: 0.5px solid #969696;
            padding: 4px;
            text-align: center;
        }
        .asistencia-table th {
            background-color: #eaeaea;
        }

    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: center;
        font-size: 8px;
        padding: 10px 0;
    }

    .footer a {
        color: black;
        text-decoration: none;
    }
    
    </style>
</head>
<body>
    <div class="">
        <table class="w-full">
            <tr>
                <td style="width:30%; text-align: center; padding-right:10px;">
                    @php $path = public_path('imagen/COA_Puno (1).png'); if (file_exists($path)) {
                    $imagenBase64 = base64_encode(file_get_contents($path));
                    $mimeType = mime_content_type($path);
                    } else {
                    $imagenBase64 = null;
                    }
                    @endphp
                    @if ($imagenBase64)
                    <div> <img height="60px" src="data:{{ $mimeType }};base64,{{ $imagenBase64 }}" alt="Imagen desde base64"></div> 
                    @else <p>Imagen no encontrada.</p> @endif
                </td>
                <td style="width: 50%; text-align: center; padding-top: 1px">
                    <h2 style="margin: 0px; font-size: 25px;">MUNICIPALIDAD PROVINCIAL DE PUNO</h2>
                    <h3 style="margin: 0px;">GERENCIA DE ADMINISTRACIÓN</h3>
                    <h3 style="margin: 0px;">SUB GERENCIA DE PERSONAL</h3>
                </td>
                <td style="text-align: center;">
                    @php $path = public_path('imagen/OTI_logo.png'); if (file_exists($path)) {
                    $imagenBase64 = base64_encode(file_get_contents($path));
                    $mimeType = mime_content_type($path);
                    } else {
                    $imagenBase64 = null;
                    }
                    @endphp
                    @if ($imagenBase64)
                    <div> <img height="40px" src="data:{{ $mimeType }};base64,{{ $imagenBase64 }}" alt="Imagen desde base64"></div> 
                    @else <p>Imagen no encontrada.</p> @endif
                </td>
            </tr>
        </table>

    </div>
       
    </div>
        <p class="text-center"><em>"Año de la recuperación y consolidación de la economía peruana"</em></p>
    <hr>

    <h4 class="text-center" style="text-decoration: underline;">HOJA DE CONTROL DE ASISTENCIA DE PRACTICANTE - 2025</h4>


    <table class="w-full">
        <tr style="font-size: 15px; margin-bottom: 0px;">
            <td style="width: 20%; padding-right: 70px;"><b>NOMBRES Y APELLIDOS</b></td>
            <td>: {{ $intern->name }} {{ $intern->lastname }}</td>
        </tr>
        <tr style="font-size: 15px; margin-bottom: 0px;">
            <td style="width: 20%; padding-right: 70px;"><b>OFICINA DESIGNADA</b></td>
            <td>: Oficina de Tecnología Informática</td>
        </tr>
        <tr style="font-size: 15px; margin-bottom: 0px;">
            <td style="width: 20%; padding-right: 70px;"><b>CARRERA PROFESIONAL</b></td>
            <td>: Ingeniería de Sistemas</td>
        </tr>
        <tr style="font-size: 15px; margin-bottom: 0px;">
            <td style="width: 20%; padding-right: 70px;"><b>FECHA DE INICIO</b></td>
            <td>: {{ $intern->start_date }}</td>
        </tr>
        <tr style="font-size: 15px; margin-bottom: 0px;">
            <td style="width: 20%; padding-right: 70px;"><b>FECHA DE TÉRMINO</b></td>
            <td>: {{ $intern->end_date }}</td>
        </tr>

    </table>


    <table class="asistencia-table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Fecha</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>¿Asistió?</th>
                <th>O.B.S</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['check_in'] }}</td>
                    <td>{{ $row['check_out'] }}</td>
                    <td>{{ $row['status'] }}</td>
                    <td></td>
                </tr>
            @endforeach
            {{-- @for ($i = count($reportData); $i < 30; $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td colspan="5">&nbsp;</td>
                </tr>
            @endfor --}}
        </tbody>
    </table>

    <div class="footer">
    <table class="w-full">
        <tr>
            <td style="width:5%; text-align: center;">
                @php
                $path = public_path('imagen/Logo-Puno-Renace.png');
                if (file_exists($path)) {
                $imagenBase64 = base64_encode(file_get_contents($path));
                $mimeType = mime_content_type($path);
                } else {
                $imagenBase64 = null;
                }
                @endphp
                @if ($imagenBase64)
                <div>
                    <img height="40px" src="data:{{ $mimeType }};base64,{{ $imagenBase64 }}" alt="Imagen desde base64">
                </div>
                @else
                <p>Imagen no encontrada.</p>
                @endif
            </td>
            <td class="w-half center" style="font-size: 8px">
                <p style="margin-bottom: 0px; font-weight: bold; font-size: 12px; background:#000000; padding:2px; color:white">
                    <strong>Puno renace</strong> | Jr. Deustua N° 453 Plaza Mayor | Teléfono: (051) 601000 | 
                    <a href="http://www.munipuno.gob.pe" target="_blank" style="color: white">www.munipuno.gob.pe</a>
                </p>
            </td>
        </tr>
    </table>
    </div>

</body>
</html>
