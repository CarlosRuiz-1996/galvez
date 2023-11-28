<div wire:init='loadProducts'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            <a href="{{ route('buscar.producto') }}" title="ATRAS">
                <svg class="w-5 h-5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                        d="M13 5H3M8 1L3 5l5 4" />
                </svg>
            </a>
            &nbsp;
            {{ __('Categoria de ') }}
            {{ $category->name }}
        </h2>



    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5">
            <x-alert />

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

                <x-input type="text" placeholder="Busca un producto" class="w-full ml-4"
                    wire:model.live='form.search' />

                <x-button class="ml-4" wire:click="create">Nuevo</x-button>
            </div>

            @if (count($products))

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
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('name')">
                                NOMBRE
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
                            <th scope="col" class="w-40 px-6 py-3 cursor-pointer"
                                wire:click="order('ctg_presentation_id')">PRESENTACIÓN

                                @if ($sort == 'ctg_presentation_id')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="w-40 px-6 py-3 cursor-pointer" wire:click="order('ctg_grammage_id')">
                                GRAMAJE
                                @if ($sort == 'ctg_grammage_id')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif

                            </th>
                            <th scope="col" class="px-6 py-3">IMAGEN</th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('description')">FICHA
                                TECNICA
                                @if ($sort == 'description')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">EDITAR</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $producto)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $producto->id }}</td>

                                <td class="px-6 py-4">{{ $producto->name }}</td>
                                <td class="px-6 py-4">{{ $producto->presentation->name }}</td>
                                <td class="px-6 py-4">{{ $producto->gramaje.' ' .$producto->grammage->name }}</td>
                                <td class="px-6 py-4">

                                    <?php $nombreDeLaImagen = basename($producto->image_path); ?>
                                    <img class="rounded-t-lg w-auto h-auto"
                                        @if ($producto->image_path) src="{{ asset('storage/products/' . $nombreDeLaImagen) }}"
                                    alt="product image"
                                @else
                                    src="{{ asset('img/producto.png/') }}"
                                    alt="product image" @endif />
                                </td>

                                <td class="px-6 py-4">{{ $producto->description ?$producto->description:'Sin descripción'}}</td>
                                <td class="text-center">
                                    <button class="btn btn-green mr-2 p-2" wire:click='edit({{ $producto }})'>
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


    {{-- MODAL --}}
    @if ($open)
        <x-dialog-modal wire:model.live="open">
            @slot('title')
                <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                    <h1> {{ $productId ? 'EDITAR PLATILLO' : 'AGREGAR PLATILLO' }}</h1>
                 </div>
            @endslot
            @slot('content')
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full  group">
                        <x-label>Nombre del producto</x-label>
                        <x-input type="text" class="w-full" placehorder="Nombre del producto" wire:model='form.name' />
                        <x-input-error for="form.name" />
                    </div>
                    <div class="relative z-0 w-full  group">
                        <x-label>Presentación</x-label>
                        <select class="form-control w-full" wire:model='form.ctg_presentation_id'>
                            <option value="" selected>Seleccione una presentación</option>
                            @foreach ($presentations as $presentation)
                                <option value="{{ $presentation->id }}">{{ $presentation->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="form.ctg_presentation_id" />
                    </div>
                    <div class="relative z-0 w-full group">
                        <x-label>Gramaje</x-label>
                        <x-input type="number" class="w-full" placehorder="descripcion del producto"
                            wire:model='form.gramaje' />
                        <x-input-error for="form.gramaje" />
                    </div>
                    <div class="relative z-0 w-full  group">
                        <x-label>Medida</x-label>
                        <select class="form-control w-full" wire:model='form.ctg_grammage_id'>
                            <option value="" selected>Seleccione una medida</option>
                            @foreach ($grammages as $grammage)
                                <option value="{{ $grammage->id }}">{{ $grammage->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="form.ctg_grammage_id" />
                    </div>

                    <div class="relative z-0 w-full  group">
                        <x-label>Descripción</x-label>
                        <textarea rows="3" class="form-control w-full" wire:model='form.description'>
                        </textarea>
                        <x-input-error for="form.description" />

                    </div>

                    <div class="relative z-0 w-full  group">
                        <x-label>Marca</x-label>
                        <select class="form-control w-full" wire:model='form.ctg_brand_id'>
                            <option value="" selected>Seleccione una marca</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="form.ctg_brand_id" />
                    </div>

                    <div class="relative z-0 w-full  group">
                        <x-label>Imagen</x-label>

                        <input type="file" class="form-control" wire:model='image' id="{{ $identificador }}" />
                        <x-input-error for="image" />

                    </div>
                    <div class="relative z-0 w-full  group">

                        <div wire:loading wire:target='image'
                            class="w-full bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold text-blue-600">Imagen cargando!</strong>
                            <span class="block sm:inline text-blue-600">En un momento se vizualizara su imagen.</span>

                        </div>
                        @if ($image)
                            <img class="p-8 rounded-t-lg h-40" style="margin-top: -30%"
                                src="{{ $image->temporaryUrl() }}" />
                        @elseif($form->image_path)
                            <?php $nombreDeLaImagen = basename($form->image_path); ?>
                            <img class="p-8 rounded-t-lg h-40" style="margin-top: -30%"
                                src="{{ asset('storage/products/' . $nombreDeLaImagen) }}" />
                        @endif
                    </div>
                </div>
            @endslot
            @slot('footer')
                <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
                {{--  wire:click="{{ $productId ? 'update' : 'save' }}"" --}}
                <x-danger-button wire:click="$dispatch('confirm',{{ $productId }}) "
                    class=" ml-3 disabled:opacity-25">ACEPTAR</x-danger-button>
            @endslot
        </x-dialog-modal>
    @endif


    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {
                // @this.on('deleteProd', (prodId) => {
                //     Swal.fire({
                //         title: 'Are you sure?',
                //         text: "You won't be able to revert this! " + prodId,
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonColor: '#3085d6',
                //         cancelButtonColor: '#d33',
                //         confirmButtonText: 'Yes, delete it!'
                //     }).then((result) => {
                //         if (result.isConfirmed) {

                //             @this.dispatch('delete-prod', {
                //                 product: prodId
                //             });

                //             Swal.fire(
                //                 'Deleted!',
                //                 'Your file has been deleted.',
                //                 'success'
                //             )
                //         }
                //     })
                // })
                @this.on('confirm', (productId) => {

                    var txt = productId != null ? "Actualizado" : "Creado"
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "El producto sera " + txt,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            @this.dispatch(productId ? 'update-productos' : 'save-productos'); 

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
