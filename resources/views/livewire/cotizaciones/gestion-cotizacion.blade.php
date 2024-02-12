<div wire:init='loadOrders'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('Cotizaciones') }}
        </h2>



    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5">

            <div class=" py-6 px-4 bg-gray-200 flex">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="form-control" wire:model.live='list'>
                        @foreach ($entrada as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span>Entradas</span>
                </div>

                <x-input type="text" placeholder="Busca un cotización" class="w-full ml-4"
                    wire:model.live='form.search' />

                {{-- <x-button class="ml-4" wire:click="openModal">Nuevo</x-button> --}}
                <x-button class="ml-4" wire:click="redirectToRoute">Nuevo</x-button>

            </div>

            @if (count($orders))

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 text-center">
                        <tr>
                            <th scope="col" class="w-24 px-4 py-2 cursor-pointer" wire:click="order('id')">ID
                                @if ($sort == 'id')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('name')">
                                CONTACTO
                                @if ($sort == 'name')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('email')">
                                CORREO

                                @if ($sort == 'email')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('cliente')">
                                CLIENTE
                                @if ($sort == 'cliente')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('rfc')">
                                RFC
                                @if ($sort == 'rfc')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('phone')">
                                TELÉFONO
                                @if ($sort == 'phone')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('created_at')">
                                FECHA DE COTIZACIÓN
                                @if ($sort == 'created_at')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">DETALLES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @foreach ($orders as $order)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $order->id }}</td>

                                <td class="px-6 py-4">{{ $order->name }}</td>
                                <td class="px-6 py-4">{{ $order->email }}</td>


                                <td class="px-6 py-4">{{ $order->cliente }}</td>
                                <td class="px-6 py-4">{{ $order->rfc }}</td>
                                <td class="px-6 py-4">{{ $order->phone }}</td>
                                <td class="px-6 py-4">{{ $order->created_at }}</td>

                                <td>

                                    {{-- <p class="mt-4 flex"> --}}
                                    <a class="btn btn-green mr-2 p-2"
                                        href="{{ route('clientes.cotizacion.excel', ['user' => $order->id]) }}">
                                        Excel<i class="fa fa-download" aria-hidden="true"></i>

                                    </a>
                                    {{-- </p> --}}
                                    <button class="btn btn-blue mr-2 p-2" wire:click='openModalD({{ $order->id }})'>
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>

                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($orders->hasPages())
                    <div class="px-6 py-3 text-gray-500">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                @if ($readyToLoad)
                    <h1 class="px-6 py-3 text-gray-500 ">No hay datos disponibles</h1>
                @else
                    <!-- Muestra un spinner mientras los datos se cargan -->
                    <div class="flex justify-center items-center h-40">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500">
                        </div>
                    </div>
                @endif
            @endif


        </div>

    </div>



    <x-dialog-modal-xl wire:model.live="openD">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Productos de la cotización</h1>
            </div>
        @endslot
        @slot('content')


            <table class="w-full text-sm text-left text-gray-500">
                <thead class="items-center  bg-gray-50 overflow-x-auto shadow-md sm:rounded-lg">
                    <th class="px-6 py-4">Nombre producto</th>
                    <th class="px-6 py-4">Presentación</th>
                    <th class="px-6 py-4">Gramage</th>

                    <th class="px-6 py-4">Precio unitario</th>
                    <th class="px-6 py-4">Maximo</th>
                    <th class="px-6 py-4">Minimo</th>
                    <th class="px-6 py-4">Total maximo</th>
                    <th class="px-6 py-4">Total minimo</th>
                </thead>
                <tbody>
                    @if ($products)
                        @foreach ($products['data'] as $product)
                            <tr class="text-center table-row bg-white border-b hover:bg-gray-50 px-4 py-2 ">
                                <td>{{ $product['product']['name'] }}</td>
                                <td>{{ $product['product']['presentation']['name'] }}</td>
                                {{-- <td>{{ $clienteProduct->producto->presentacion->nombre }}</td> --}}

                                <td>{{ $product['product']['grammage']['name'] }}</td>

                                <td>{{ $product['price_prod'] }}</td>
                                <td>{{ $product['min'] }}</td>
                                <td>{{ $product['max'] * $product['price_prod'] }}</td>
                                <td>{{ $product['min'] * $product['price_prod'] }}</td>
                                <td>{{ $product['id'] }}</td>


                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalD">Cerrar</x-secondary-button>
            {{-- <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button> --}}
        @endslot
    </x-dialog-modal-xl>

    @push('js')
    <script>
        
    </script>
        
    @endpush
</div>
