
{{-- <h1>cotizaciones {{$user->name}}</h1> --}}
<h4 style="width: 200%;">ANEXO 1</h4>
<h4 style="width: 200%;">FORMATO DE ESTIMACIÓN DE PROPUESTA ECONÓMICA</h4>
<h4 style="width: 200%;">PARA LA ADQUISICIÓN DE INSUMOS ALIMENTICIOS PARA EL COMEDOR INSTITUCIONAL</h4>
<h4 style="width: 200%;">PERIODO: APARTIR DEL 2  DE ENERO AL 30 DE DICIEMBRE DEL 2023</h4>
<br>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #616568;
        color: white;
    }

    td {
        text-align: right;
    }
</style>
<table  style="border-collapse: collapse; width: 100%;">
    <thead >
        <tr>
            <th style="background-color: #bdc0c3; width: 200%;">SUB PARTIDA</th>
            <th style="background-color: #bdc0c3; width: 500%;">PRODUCTO</th>
            <th style="background-color: #bdc0c3; width: 100%;">UNIDAD</th>
            <th style="background-color: #bdc0c3; width: 250%;">PRECIO UNITARIO</th>
            <th style="background-color: #bdc0c3; width: 100%;">IVA</th>
            <th style="background-color: #bdc0c3; width: 100%;">MINIMA</th>
            <th style="background-color: #bdc0c3; width: 100%;">MINIMA</th>
            <th style="background-color: #bdc0c3; width: 250%;">TOTAL MÍNIMO</th>
            <th style="background-color: #bdc0c3; width: 250%;">TOTAL MÁXIMO</th>
            <th style="background-color: #bdc0c3; width: 500%;">MARCA OFERTADA</th>
        </tr>
    </thead>
    <tbody>
        <?php $id_tabla = 1;
        
        ?>
        @foreach($products as $prod)
            <tr>
                <td>{{ $id_tabla }}</td>
                <td>{{ $prod->product->name }}</td>
                <td>{{ $prod->product->grammage->name }}</td>
                <td style="text-align: right;">$ {{ $prod->price_prod }}</td>
                <td>{{ '' }}</td>
                <td>{{$prod->min}}</td>
                <td>{{$prod->max}}</td>
                <td style="text-align: right;">$ {{ $prod->min *$prod->price_prod}}</td>
                <td style="text-align: right;">$ {{ $prod->max *$prod->price_prod}}</td>
                <td>{{ $prod->product->Brand->name }}</td>
            </tr>
            <?php $id_tabla++;?>

        @endforeach
            
    </tbody>
</table>


