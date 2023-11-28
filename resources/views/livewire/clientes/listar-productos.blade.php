<div>
    {{-- {{ var_dump($productosArray)}} --}}

    @if ($productosArray)
        <x-button wire:click="openModalP">
            {{-- class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300"> --}}
            VER PRODUCTOS
        </x-button>
    @endif

    @if (count($FoodsArray))
        <x-button wire:click="openModalF">
            {{-- class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300"> --}}
            VER MENUS
        </x-button>
    @endif

    <x-dialog-modal-xl wire:model.live="openP">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                @if ($type == 2)
                    <h1>Productos para la cotización</h1>
                @else
                    <h1>Productos para el nuevo cliente</h1>
                @endif
            </div>
        @endslot
        @slot('content')
            {{-- {{var_dump($productosArray)}} --}}
            <table class="table">
                <thead class="text-center">
                    <th>NOMBRE</th>
                    <th>PRESENTACION</th>
                    <th>GRAMAGE</th>
                    <th>IMAGEN</th>
                    <th>{{ $type == 2 ? 'PRECIO UNITARIO' : 'DESCRIPCION' }}
                    </th>
                    <th>MAX</th>
                    <th>MIN</th>
                    <th>ELIMINAR</th>

                </thead>
                <tbody class="text-center">
                    {{-- {{ ($productosArray) }} --}}
                    @foreach ($productosArray as $index => $ingredient)
                        <tr>
                            <td class="px-6 py-4">{{ $ingredient['name'] }}</td>
                            {{-- <td class="px-6 py-4">{{ $ingredient['descripcion'] }}</td> --}}
                            <td class="px-6 py-4">{{ $ingredient['presentation'] }}</td>
                            <td class="px-6 py-4">{{ $ingredient['gramagge'] . ' ' . $ingredient['gramaje'] }}</td>
                            {{-- <td class="px-6 py-4">{{ $ingredient['gramaje'] }}</td> --}}
                            <td class="px-6 py-4">
                                <img class="p-8 rounded-t-lg h-40" <?php $nombreDeLaImagen = basename($ingredient['image_path']); ?>
                                    @if ($ingredient['image_path']) src="{{ asset('storage/products/' . $nombreDeLaImagen) }}"
                            alt="product image"
                        @else
                            src="{{ asset('img/producto.png/') }}"
                            alt="product image" @endif />

                            </td>
                            <td class="px-6 py-4">
                                {{ $ingredient['descripcion'] ? $ingredient['descripcion'] : '$' . $ingredient['price'] }}</td>
                            <td class="px-6 py-4">{{ $ingredient['max'] }}</td>
                            <td class="px-6 py-4">{{ $ingredient['min'] }}</td>
                            <td class="px-6 py-4">
                                <x-danger-button
                                    wire:click="deleteIntemProd({{ $ingredient['id'] }})">Borrar</x-danger-button>

                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalP">CERRAR</x-secondary-button>
            {{-- <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button> --}}
        @endslot
    </x-dialog-modal-xl>




    <x-dialog-modal-xl wire:model.live="openF">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Platillos para el nuevo cliente</h1>
            </div>
        @endslot
        @slot('content')
            <table class="table">
                <thead>
                    <th>NOMBRE</th>
                    <th>PRESENTACION</th>
                    <th>CATEGORIA</th>
                    <th>IMAGEN</th>
                    <th>DESCRIPCION</th>
                    <th>MAX</th>
                    <th>MIN</th>
                    <th>ELIMINAR</th>
                </thead>
                <tbody>
                    {{-- {{ ($productosArray) }} --}}
                    @foreach ($FoodsArray as $index => $ingredient)
                        <tr>
                            <td class="px-6 py-4">{{ $ingredient['name'] }}</td>
                            {{-- <td class="px-6 py-4">{{ $ingredient['descripcion'] }}</td> --}}
                            <td class="px-6 py-4">{{ $ingredient['presentation'] }}</td>
                            <td class="px-6 py-4">{{ $ingredient['categori'] }}</td>
                            <td class="px-6 py-4">
                                <img class="p-8 rounded-t-lg h-40"
                                    @if ($ingredient['image_path']) src="{{ asset('storage/' . $ingredient['image_path']) }}"
                            alt="product image"
                        @else
                            src="{{ asset('img/producto.png/') }}"
                            alt="product image" @endif />

                            </td>
                            <td class="px-6 py-4">{{ $ingredient['descripcion'] }}</td>
                            <td class="px-6 py-4">{{ $ingredient['max'] }}</td>
                            <td class="px-6 py-4">{{ $ingredient['min'] }}</td>

                            <td class="px-6 py-4">
                                <x-danger-button
                                    wire:click="deleteIntemFood({{ $ingredient['id'] }})">Borrar</x-danger-button>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalF">CERRAR</x-secondary-button>
            {{-- <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button> --}}
        @endslot
    </x-dialog-modal-xl>
</div>
