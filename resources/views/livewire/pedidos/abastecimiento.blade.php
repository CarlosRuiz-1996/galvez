<div wire:init='loadOrders'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('Gestión de pedidos/abastecimiento') }}
        </h2>



    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5">

            {{-- <div class=" py-6 px-4 bg-gray-50 flex"> --}}

            {{-- <div class="flex items-center">
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

                <x-button class="ml-4" wire:click="create">Nuevo</x-button> --}}
            {{-- </div> --}}

            @if (count($orders))

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                            {{-- <th scope="col" class="px-6 py-3">DETALLES</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $order->id }}</td>

                                <td class="px-6 py-4">{{ $order->name }}</td>
                                <td class="px-6 py-4">{{ $order->presentation->name }}</td>


                                <td class="px-6 py-4">{{ $order->description }}</td>
                                {{-- <td class="text-center">
                                <button class="btn btn-green mr-2 p-2" wire:click='edit({{ $order }})'>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td> --}}
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


</div>
