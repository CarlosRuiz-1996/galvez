<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-2">
                <img src="{{ public_path() . '/img/logo.png' }}" alt="Nombre alternativo" class="mb-3"
                    style="max-width: 100px; float: left; margin-right: 10px;">
            </div>
            <div class="col-md-10 col-10">
                <h5 class="text-dark text-center" style="margin-top: 10px;">
                    Grupo Gastronómico Gálvez: </h5>
                <h6 class="text-dark text-center">Todos los días
                    producimos calidad</h6>
            </div>
            <div class="col-md-12 col-12">
                @php
                    $fecha_creacion = \Carbon\Carbon::parse($order->created_at);
                    $nombre_mes = Str::upper($fecha_creacion->translatedFormat('F'));
                    $dia = $fecha_creacion->format('d');
                    $anio = $fecha_creacion->format('Y');
                @endphp
                <h6 class="text-dark text-right " style="margin-top: 25px;margin-right: 8%; font-size: 10px;">CIUDAD DE MÉXICO, A
                    {{ $dia . ' DE ' . $nombre_mes . ' DEL ' . $anio }}.</h6>
            </div>
        </div>

        {{-- fecha --}}

        {{-- datos cliente --}}
        <div class="row">
            <div class="col-md-11 col-11">
                <table class="table table-bordered" style="margin-top: 15px; font-size: 10px;">
                    <tr>
                        <td colspan="2"></td>
                        <td style="background-color: #a9a9a9;">

                            <span class="font-weight-bold" style="font-size: 12px;">NO CONTRATO:</span>

                        </td>
                        <td class="text-uppercase">
                            {{ $order->user->no_contrato }}
                        </td>

                    </tr>
                    <tr>
                        <td style="background-color: #a9a9a9;">
                            <span class="font-weight-bold" style="font-size: 12px;">RAZÓN SOCIAL:</span>
                        </td>
                        <td class="text-uppercase">{{ $order->user->cliente }}</td>
                        <td style="background-color: #a9a9a9;">

                            <span class="font-weight-bold" style="font-size: 12px;">CONTACTO:</span>

                        </td>
                        <td class="text-uppercase">
                            {{ $order->user->name }}
                        </td>

                    </tr>
                    <tr>
                        <td style="background-color: #a9a9a9;">
                            <span class="font-weight-bold" style="font-size: 12px;">RFC:</span>
                        </td>
                        <td class="text-uppercase">{{ $order->user->rfc }}</td>
                        <td style="background-color: #a9a9a9;">

                            <span class="font-weight-bold" style="font-size: 12px;">TELÉFONO:</span>

                        </td>
                        <td>{{ $order->user->phone }}
                        </td>

                    </tr>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-11 col-11">
                <!-- Tabla para servicios normales -->
                <table class="table table-bordered">
                    <thead style="margin-top: 15px; font-size: 16px; background-color: #a9a9a9;">
                        <th class="px-6 py-4 ">Nombre producto</th>
                        <th class="px-6 py-4">Presentación</th>
                        <th class="px-6 py-4">Gramage</th>

                        <th class="px-6 py-4">Marca</th>
                        <th class="px-6 py-4">Cantidad</th>
                        <th class="px-6 py-4">Precio</th>

                    </thead>
                    <tbody>
                        @foreach ($order->details as $detalle)
                            <tr style="font-size: 10px;" class="text-center table-row bg-white border-b hover:bg-gray-50 px-4 py-2">
                                <td class="px-6 py-4">
                                    {{ $detalle->clienteProduct->product->name }}
                                </td>
                                <td> {{ $detalle->clienteProduct->product->presentation->name }}</td>
                                <td> {{ $detalle->clienteProduct->product->grammage->name }}</td>
                                <td> {{ $detalle->clienteProduct->product->brand->name }}</td>

                                <td> {{ $detalle->order->status == 1 ? $detalle->clienteProduct->max : $detalle->clienteProduct->min }}
                                </td>
                                <td> ${{ $detalle->clienteProduct->price_prod }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4"></td>
                            <td>Total:</td>
                            <td class="text-right">${{$order->total}}</td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
         

        <div class="row">
            <div class="col-md-11 col-11">
                <table class="table table-bordered" style="margin-top: 15px; font-size: 8px;">
                    <tr style="background-color: #a9a9a9;">
                        <td>
                            <span class="font-weight-bold">DOMICILIO DE ENTREGA:</span>
                        </td>

                    </tr>
                    <tr>
                        <td>{{ Str::upper(
                            $order->user->address . ' '.$order->user->cp->municipio->municipio.' '. $order->user->cp->cp . ' ' .
                            $order->user->cp->estado->estado,

                            ) }}
                        </td>
                    </tr>
                    <tr style="background-color: #a9a9a9;">
                        <td>
                            <span class="font-weight-bold">OBSERVACIONES:</span>
                        </td>

                    </tr>
                    <tr>
                        <td>{{Str::upper($order->observations)}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
