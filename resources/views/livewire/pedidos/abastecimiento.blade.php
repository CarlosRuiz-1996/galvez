<div wire:init='loadOrders'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('Gestión de pedidos/abastecimiento') }}
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

                <x-input type="text" placeholder="Busca un producto" class="w-full ml-4"
                    wire:model.live='form.search' />

                {{-- <x-button class="ml-4" wire:click="create">Nuevo</x-button> --}}
            </div>

            @if (count($orders))

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
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
                            <th scope="col" class="w-40 px-4 py-2 cursor-pointer" wire:click="order('id')">CLIENTE
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
                            <th scope="col" class="w-28 px-4 py-2 cursor-pointer">RFC</th>
                            <th scope="col" class="w-40 px-4 py-2 cursor-pointer">CONTACTO</th>
                            <th scope="col" class="w-24 px-4 py-2 cursor-pointer">TELÉFONO</th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('created_at')">
                                FECHA DEL PEDIDO
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
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('deadline')">
                                FECHA DE ENTREGA

                                @if ($sort == 'deadline')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="w-24 px-4 py-2 cursor-pointer" wire:click="order('total')">TOTAL
                                @if ($sort == 'total')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('observations')">
                                OBSERVACIONES
                                @if ($sort == 'observations')
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
                    <tbody>

                        @foreach ($orders as $order)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $order->id }}</td>

                                <td class="px-6 py-4">{{ $order->user->cliente }}</td>
                                <td class="px-6 py-4">{{ $order->user->rfc }}</td>
                                <td class="px-6 py-4">{{ $order->user->name }}</td>

                                <td class="px-6 py-4">{{ $order->user->phone }}</td>

                                <td class="px-6 py-4">{{ $order->deadline }}</td>
                                <td class="px-6 py-4">{{ $order->created_at }}</td>
                                <td class="px-6 py-4">${{ $order->total }}</td>


                                <td class="px-6 py-4">{{ $order->observations }}</td>
                                <td class="text-center">
                                    <button class="btn btn-blue mr-2 p-2" wire:click='detail({{ $order->id }})'>
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

    <x-dialog-modal-xl wire:model.live="open">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Productos del pedido</h1>
            </div>
        @endslot
        @slot('content')


            <table class="w-full text-sm text-left text-gray-500">
                <thead class="items-center  bg-gray-50 overflow-x-auto shadow-md sm:rounded-lg">
                    <th class="px-6 py-4">Nombre producto</th>
                    <th class="px-6 py-4">Presentación</th>
                    <th class="px-6 py-4">Gramage</th>

                    <th class="px-6 py-4">Marca</th>
                    <th class="px-6 py-4">Maximo</th>
                    <th class="px-6 py-4">Minimo</th>
                    <th class="px-6 py-4">Existencia</th>
                </thead>
                <tbody>
                    @if ($products)
                        @foreach ($products as $product)
                            <tr class="text-center table-row bg-white border-b hover:bg-gray-50 px-4 py-2">

                                <td>{{ $product['cliente_product']['product']['name'] }}</td>
                                <td> {{ $product['cliente_product']['product']['presentation']['name'] }}</td>
                                <td> {{ $product['cliente_product']['product']['grammage']['name'] }}</td>
                                <td> {{ $product['cliente_product']['product']['brand']['name'] }}</td>

                                <td> {{ $product['cliente_product']['max'] }}</td>
                                <td> {{ $product['cliente_product']['min'] }}</td>
                                <td>

                                    @if (isset($existencias[$product['id']]) && $existencias[$product['id']]['existe'] == 1)
                                        <i class="fa fa-check text-green-500" aria-hidden="true"></i>
                                    @elseif(isset($existencias[$product['id']]) && $existencias[$product['id']]['existe'] == 2)
                                        <i class="fa fa-check text-orange-500" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times-circle text-red-500" aria-hidden="true"></i>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModal">Cerrar</x-secondary-button>
            <x-danger-button class="ml-2"
                wire:click="$dispatch('confirm',[1,{{ $apartar }}])">Surtir</x-danger-button>
        @endslot
    </x-dialog-modal-xl>


    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {

                @this.on('confirm', ([op, apartar]) => {

                    if (apartar == 1) {
                        Swal.fire({
                            title: '¿Estas seguro?',
                            text: op == 1 ? "Los productos seran apartados para este cliente." : "",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, adelante!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                @this.dispatch(op == 1 ? 'apartar-orden' : '');
                            }
                        })
                    } else {
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'error',
                            title: 'Ya se ha notificado a compras.',
                            text:"Debe esperar a que surtan todos los productos.",
                            showConfirmButton: true,
                            // timer: 1500
                        })
                    }
                })
                Livewire.on('alert', function(message) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: 'success',
                        title: message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });

            });
        </script>
    @endpush
</div>
