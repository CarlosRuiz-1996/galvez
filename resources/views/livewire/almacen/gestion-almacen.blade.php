<div wire:init='loadProducts'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('ALMACEN') }}
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

                    <a href="{{ route('clientes.carnes') }}" class="ml-4">
                        <x-button>CARNES</x-button>
                    </a>            </div>

            @if (count($products))

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
                                PRODUCTO
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
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('ctg_grammage_id')">
                                GRAMAGE

                                @if ($sort == 'ctg_grammages')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer"
                                wire:click="order('ctg_presentation_id')">
                                PRESENTACIÓN
                                @if ($sort == 'ctg_presentations')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('ctg_brand_id')">
                                MARCA
                                @if ($sort == 'ctg_brands')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('price')">
                                PRECIO
                                @if ($sort == 'price')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('stock')">
                                STOCK
                                @if ($sort == 'stock')
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

                        @foreach ($products as $product)
                            <tr
                                class="table-row bg-white border-b hover:bg-blue-50 {{ $product->stock < $product->stock_min ? 'bg-red-200' : '' }}">

                                <td class="px-6 py-4">{{ $product->id }}</td>
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ $product->grammage->name }}</td>

                                <td class="px-6 py-4">{{ $product->presentation->name }}</td>
                                <td class="px-6 py-4">{{ $product->brand->name }}</td>
                                <td class="px-6 py-4">${{ $product->price }}</td>
                                <td class="px-6 py-4">{{ $product->stock }}</td>
                                <td>
                                    <button class="btn btn-green mr-2 p-2" wire:click='openModal({{ $product }})'>
                                        <i class="fas fa-edit"></i>
                                    </button>
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

    </div>


    <x-dialog-modal wire:model.live="open">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1> EDITAR STOCK </h1>
            </div>
        @endslot
        @slot('content')
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full  group">
                    <x-label>PRODUCTO</x-label>
                    <x-input type="text" class="w-full bg-gray-200" disabled placehorder="Nombre del producto"
                        wire:model='form.name' />
                </div>
                <div class="relative z-0 w-full  group">

                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>STOCK</x-label>
                    <x-input type="text" class="w-full" placehorder="stock" wire:model='form.stock' />

                    <x-input-error for="form.ctg_presentation_id" />
                </div>
                <div class="relative z-0 w-full  group" x-data="{ open: false }">
                    
                    <x-label >STOCK MINIMO 
                        <button x-on:mouseenter="open = ! open" x-on:mouseleave="open = false">
                            <i class="fa fa-info-circle bg-orange-400 text-white rounded-full p-1"></i>
                        </button></x-label>
                        <div x-show="open" id="tooltip-light" role="tooltip"
                        class="absolute z-10 mt-2 bg-white border border-orange-300 rounded p-2 text-sm shadow-md">
                        El stock minimo ayuda a que una ves que se disminuya este minimo el sistema nos muestre que debemos
                        de surtir.
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <x-input type="text" class="w-full" placehorder="stock minimo" wire:model='form.stock_min' />
                    <x-input-error for="form.stock_min" />

                   
                </div>

            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
            {{--  wire:click="{{ $productId ? 'update' : 'save' }}"" wire:click="$dispatch('confirm',{{ $productId }}) " --}}
            <x-danger-button class=" ml-3 disabled:opacity-25"
                wire:click="$dispatch('confirm',{{ $productId }})">ACEPTAR</x-danger-button>
        @endslot
    </x-dialog-modal>


  

    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {

                @this.on('confirm', (productId) => {
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "El stock del producto sera Actualizado",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            @this.dispatch('update-productosStock');

                        }
                    })
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
