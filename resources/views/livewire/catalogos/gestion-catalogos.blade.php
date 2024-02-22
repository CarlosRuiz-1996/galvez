<div wire:init='loadCatalogos'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            <a href="{{ route('catalogos') }}" title="ATRAS">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            &nbsp;
            {{ __('Catalogos de ') . $form->ctg->name }}
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

                <x-input type="text" placeholder="Buscar" class="w-full ml-4" wire:model.live='form.search' />

                <x-button class="ml-4" wire:click="openModalC">Nuevo</x-button>
            </div>

            @if (count($catalogos))



                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">

                        <tr>

                            @foreach ($catalogos[0]->getAttributes() as $key => $value)
                                @if (
                                    !in_array($key, [
                                        'created_at',
                                        'updated_at',
                                        'incrementing',
                                        'preventsLazyLoading',
                                        'exists',
                                        'wasRecentlyCreated',
                                        'timestamps',
                                        'usesUniqueIds',
                                    ]))
                                    <?php $columna; ?>
                                    @if ($key == 'name')
                                        <?php $columna = 'nombre'; ?>
                                    @elseif($key == 'image_path')
                                        <?php $columna = 'imagen';
                                        $imagen_existe = true; ?>
                                    @elseif($key == 'status')
                                        <?php $columna = 'status'; ?>
                                    @else
                                        <?php $columna = $key; ?>
                                    @endif
                                    <th scope="col" class="px-6 py-3 cursor-pointer"
                                        wire:click="order('{{ $key }}')">{{ $columna }}
                                        @if ($sort == '{{ $key }}')
                                            @if ($orderBy == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                        @endif
                                    </th>
                                @endif
                            @endforeach

                            <th scope="col" class="px-6 py-3">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @foreach ($catalogos as $catalogo)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $catalogo->id }}</td>

                                <td class="px-6 py-4">{{ $catalogo->name }}</td>
                                @if ($imagen_existe)
                                    <td class="px-6 py-4 text-center">
                                        <img class="rounded-t-lg  w-20 h-20"
                                            @if ($catalogo->image_path) src="{{ asset('storage/' . $catalogo->image_path) }}"
                                                alt="product image"
                                            @else
                                                src="{{ asset('img/producto.png/') }}"
                                                alt="product image" 
                                            @endif 
                                        />
                                    </td>
                                @endif
                                <td class="px-6 py-4">

                                    <i class="fa-solid fa-circle"
                                        style="{{ $catalogo->status == 1 ? 'color:green' : 'color:red' }}"></i>
                                </td>

                                <td>
                                    <button title="editar" class="btn btn-green mr-2 p-2"
                                        wire:click='edit({{ $catalogo }})'>
                                        <i class="fa-solid fa-file-pen"></i>
                                    </button>

                                    @if ($catalogo->status == 1)
                                        <button class="btn btn-red mr-2 p-2"
                                            wire:click="$dispatch('confirmD',{{ $catalogo }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @else
                                        <button title="reactivar" class="btn btn-blue mr-2 p-2"
                                            wire:click="$dispatch('confirmR',{{ $catalogo }})">
                                            <i class="fa-solid fa-circle-up"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($catalogos->hasPages())
                    <div class="px-6 py-3 text-gray-500">
                        {{ $catalogos->links() }}
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


    {{-- MODAL PARA CREAR --}}
    <x-dialog-modal wire:model.live="openC">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                {{-- <h1>Agregar un nuevo registro al catalogo de {{$ctg->name}}</h1> --}}
                <h1> {{ $ctgId ? 'EDITAR REGISTRO' : 'AGREGAR REGISTRO' }}</h1>

            </div>
        @endslot
        @slot('content')
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class=" w-full">
                    <x-label>Nombre</x-label>
                    <x-input type="text" wire:model='form.name' />
                    <x-input-error for="form.name" />
                </div>

                @if ($imagen_existe)
                    <div class="relative z-0 w-full  group">
                        <x-label>Imagen</x-label>

                        <input type="file" class="form-control" wire:model='image' id="{{ $identificador }}" />
                        <x-input-error for="form.image_path" />

                    </div>
                    <div class="relative z-0 w-full  group">

                        <div wire:loading wire:target='image'
                            class="w-full bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold text-blue-600">Imagen cargando!</strong>
                            <span class="block sm:inline text-blue-600">En un momento se vizualizara su imagen.</span>

                        </div>
                        @if ($image)
                            <img class="p-8 rounded-t-lg h-40" style="margin-top: -10%"
                                src="{{ $image->temporaryUrl() }}" />
                        @elseif($form->image_path)
                            <?php $nombreDeLaImagen = basename($form->image_path); ?>
                            <img class="p-8 rounded-t-lg h-40" style="margin-top: -10%"
                                src="{{ asset('storage/products/' . $nombreDeLaImagen) }}" />
                        @endif
                    </div>
                @endif
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalC">Cerrar</x-secondary-button>
            <x-danger-button wire:click="$dispatch('confirm',{{ $ctgId }}) "
                class=" ml-3 disabled:opacity-25">ACEPTAR</x-danger-button>
        @endslot
    </x-dialog-modal>


    <script>
        document.addEventListener('livewire:initialized', () => {

            @this.on('confirm', (ctgId) => {

                var txt = ctgId != null ? "Actualizado" : "Creado"
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "El registro sera " + txt,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, adelante!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        @this.dispatch(ctgId ? 'update-ctg' : 'save-ctg');

                    }
                })
            })

            @this.on('confirmD', (ctg) => {

                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "El registro sera dado de baja",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, adelante!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        @this.dispatch('delete-ctg', {
                            ctg: ctg
                        });

                    }
                })
            })
            @this.on('confirmR', (ctg) => {

                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "El estatus volvera a ser activo",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, adelante!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        @this.dispatch('reactive-ctg', {
                            ctg: ctg
                        });

                    }
                })
            })
            Livewire.on('alert', function(message) {
                Swal.fire({
                    icon: 'success',
                    title: message,
                    showConfirmButton: false,
                    timer: 1500
                })
            });

        });
    </script>
</div>
