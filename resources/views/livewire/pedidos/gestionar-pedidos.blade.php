<div wire:init='loadOrders'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('Gestión de pedidos') }}
        </h2>



    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5">

            <div class=" py-6 px-4 bg-gray-50 flex">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="form-control" wire:model.live='list'>
                        @foreach ($entrada as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span>Entradas</span>
                </div>

                <x-input type="text" placeholder="Busca un pedido" class="w-full ml-4"
                    wire:model.live='form.search' />

                <x-button class="ml-4" wire:click="openModal">Nuevo</x-button>
            </div>

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
                            <th scope="col" class="px-6 py-3">DETALLES</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $order->id }}</td>

                                <td class="px-6 py-4">{{ $order->created_at }}</td>
                                <td class="px-6 py-4">{{ $order->deadline }}</td>


                                <td class="px-6 py-4">{{ $order->observations }}</td>
                                <td class="text-center">
                                    <button class="btn btn-green mr-2 p-2" wire:click='edit({{ $order }})'>
                                        <i class="fas fa-edit"></i>
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

    {{-- MODAL --}}
    <x-dialog-modal wire:model.live="open">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1> {{ 'AGREGAR PEDIDO' }}</h1>
            </div>
        @endslot
        @slot('content')
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="relative z-0 w-full group">
                        <x-label>FECHA DE ENTREGA</x-label>
                        <x-input type="date" class="w-full" placeholder="Fecha" wire:model='form.deadline' />
                        <x-input-error for="form.deadline" />
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="relative z-0 w-full group">
                        <x-label>Total</x-label>
                        <x-input type="number" class="w-full" placeholder="Total del pedido" wire:model='form.total' />
                        <x-input-error for="form.total" />
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="relative z-0 w-full group">
                        <x-label>Observaciones</x-label>
                        <textarea rows="2" class="form-control w-full" wire:model='form.observations'></textarea>
                        <x-input-error for="form.observations" />
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="grid grid-cols-3 gap-6 mt-4">



                    <div class="col-span-1">

                        <button wire:click="openModalP" class="btn btn-orange">INCLUIR PRODUCTOS</button>
                    </div>
                    <div class="col-span-1">
                        @if ($productosArrayCliente)
                            <x-button wire:click="openModalPL">
                                VER PRODUCTOS
                            </x-button>
                        @endif
                        {{-- <livewire:clientes.modal-foods /> --}}
                    </div>
                    <div class="col-span-1">
                        {{-- <livewire:clientes.listar-productos /> --}}

                    </div>
                </div>

            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
            <x-button wire:click="save" class=" ml-3 disabled:opacity-25">Guardar</x-button>
        @endslot
    </x-dialog-modal>



    {{-- modal productos --}}
    <x-dialog-modal-xl wire:model.live="openP">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Productos</h1>
            </div>
        @endslot
        @slot('content')
            <div class=" py-6 px-4 bg-gray-100 flex">
                <x-input placeholder="Busca por producto" type="text" class="w-full ml-4"
                    wire:model.live='form.search_prod' />

                <select name="" id="" class="form-control ml-4" wire:model.live='form.filtra_cat'>
                    @if ($form->filtra_cat)
                        <option value="0">Limpia filtro</option>
                    @elseif($form->filtra_cat == 0)
                        <option value="" selected>Selecciona una categoria</option>
                    @endif
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $form->filtra_cat ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div>

                @if (count($products))
                    <table class="w-full text-sm text-center text-gray-500 mb-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class=""></th>

                                <th scope="col" class="col-1">NOMBRE</th>
                                <th scope="col" class="col-1">PRESENTACIÓN</th>
                                <th scope="col" class="col-1">GRAMAGE</th>
                                <th scope="col" class="col-1">IMAGEN</th>
                                <th scope="col" class="">DESCRIPCIÓN</th>
                                <th scope="col" class="">MAXIMO</th>
                                <th scope="col" class="">MINIMO</th>

                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($products as $product)
                                <tr class="table-row bg-white border-b text-center hover:bg-gray-50">

                                    <td class="w-1/18">
                                        <div class="flex items-center justify-center">
                                            <input type="checkbox" wire:model="selectedProductIds"
                                                value="{{ $product->id }}" {{-- wire:click="toggleProductSelection({{ $product->id }})" --}}
                                                {{ in_array($product->id, $selectedProductIds) ? 'checked' : '' }}
                                                class="w-5 h-5 text-blue-600  border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        </div>
                                    </td>


                                    <td class="w-1/12">{{ $product->product_name }}</td>
                                    <td class="w-1/12">{{ $product->product->presentation->name }}</td>
                                    <td class="w-1/18">{{ $product->product->grammage->name }}</td>
                                    <td class="w-1/6">

                                        <img class="p-8 rounded-t-lg h-40" <?php $nombreDeLaImagen = basename($product->product->image_path); ?>
                                            @if ($product->product->image_path) src="{{ asset('storage/products/' . $nombreDeLaImagen) }}"
                                            alt="product image"
                                        @else
                                            src="{{ asset('img/producto.png/') }}"
                                            alt="product image" @endif />
                                    </td>
                                    <td class="w-1/4">
                                        {{ $product->description }}
                                    </td>
                                    <td class="w-1/18">
                                        {{ $product->max }}
                                    </td>
                                    <td class="w-1/18">
                                        {{ $product->min }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @if ($products->hasPages())
                        <div class="px-6 py-3 text-gray-500">
                            {{ $products->links() }}
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
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalP">Cancelar</x-secondary-button>
            <x-danger-button wire:click="agregarProductos" class="ml-3">Aceptar</x-danger-button>
        @endslot
    </x-dialog-modal-xl>



    <x-dialog-modal-xl wire:model.live="openPL">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Productos para el pedido</h1>
            </div>
        @endslot
        @slot('content')
            <table class="table">
                <thead>
                    <th>NOMBRE</th>
                    <th>PRESENTACION</th>
                    <th>GRAMAGE</th>
                    <th>IMAGEN</th>
                    <th>DESCRIPCION</th>

                    <th>ELIMINAR</th>

                </thead>
                <tbody>
                    {{-- {{ }} --}}
                    @foreach ($productosArrayCliente as $index => $ingredient)
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
                            <td class="px-6 py-4">{{ $ingredient['descripcion'] }}</td>

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
            <x-secondary-button wire:click="closeModalPL">CERRAR</x-secondary-button>
            {{-- <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button> --}}
        @endslot
    </x-dialog-modal-xl>

    <x-dialog-modal-xl wire:model.live="openPL">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Detalles del pedido</h1>
            </div>
        @endslot
        @slot('content')
            <table class="table">
                <thead>
                    <th>NOMBRE</th>
                    <th>PRESENTACION</th>
                    <th>GRAMAGE</th>
                    <th>IMAGEN</th>
                    <th>DESCRIPCION</th>

                    <th>ELIMINAR</th>

                </thead>
                <tbody>
                    {{-- {{ }} --}}
                    @foreach ($productosArrayCliente as $index => $ingredient)
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
                            <td class="px-6 py-4">{{ $ingredient['descripcion'] }}</td>

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
            <x-secondary-button wire:click="closeModalPL">CERRAR</x-secondary-button>
            {{-- <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button> --}}
        @endslot
    </x-dialog-modal-xl>

    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {


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
