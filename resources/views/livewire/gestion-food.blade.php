<div wire:init='loadProducts'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            <a href="{{ route('buscar.comida') }}" title="ATRAS">
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

                <x-button class="ml-4" wire:click="create">Nuevo</x-button>
            </div>
            @if (count($products))
            {{$form->search}}

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
                                wire:click="order('ctg_presentation_food_id')">PRESENTACIÓN

                                @if ($sort == 'ctg_presentation_food_id')
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
                                <td class="px-6 py-4">{{ $producto->id}}</td>

                                <td class="px-6 py-4">{{ $producto->name }}</td>
                                <td class="px-6 py-4">{{ $producto->presentation->name }}</td>
                                <td class="px-6 py-4">

                                    <img class="p-8 rounded-t-lg h-40 w-40"
                                        @if ($producto->image_path) src="{{ asset('storage/' . $producto->image_path) }}"
                                            alt="product image"
                                        @else
                                            src="{{ asset('img/producto.png/') }}"
                                            alt="product image" @endif />

                                </td>
                                {{-- foods/EcKg9YVsr6QwZxTUhDf6KWaA6WMh5qwtcXD8ZT2Z.jpg --}}
                                <td class="px-6 py-4">{{ $producto->description }}</td>
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
    <x-dialog-modal wire:model.live="open">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1> {{ $foodId ? 'EDITAR PLATILLO' : 'AGREGAR PLATILLO' }}</h1>
            </div>
        @endslot
        @slot('content')
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="mb-4">
                        <label for="{{ $identificador }}" class="block text-sm font-medium text-gray-700">Subir
                            Imagen</label>
                        <div
                            class="flex items-center justify-center w-full h-20 border-dashed border-2 border-gray-300 rounded-lg">
                            <label for="{{ $identificador }}" class="cursor-pointer text-blue-500 hover:underline">
                                @if ($image)
                                    <p class="text-green-600 text-center">Imagen seleccioanda:<br>
                                        {{ $image->getClientOriginalName() }}</p>
                                @else
                                    Selecciona una imagen
                                @endif
                                <input type="file" wire:model="image" class="hidden" id="{{ $identificador }}"
                                    accept="image/*" />
                                    <x-input-error for="form.image_path" />

                            </label>

                        </div>
                    </div>

                    <div class="relative z-0 w-full  group">

                        <div wire:loading wire:target='image'
                            class="w-full bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold text-blue-600">Imagen cargando!</strong>
                            <span class="block sm:inline text-blue-600">En un momento se vizualizara su imagen.</span>

                        </div>
                        <div class="px-4 py-3">
                            @if ($image)
                                <img class="p-8 rounded-t-lg h-40" style="margin-top: -30%"
                                    src="{{ $image->temporaryUrl() }}" />
                            @elseif($form->image_path)
                                <img class="p-8 rounded-t-lg h-40" style="margin-top: -30%"
                                    src="{{ asset('storage/' . $form->image_path) }}" />
                            @endif
                        </div>
                    </div>

                    {{-- mensaje de eliminado --}}
                    <div x-data="{ show: false, message: '' }" x-init="Livewire.on('showFlashMessage', (msg) => {
                        show = true;
                        message = msg;
                        setTimeout(() => {
                            show = false;
                            message = '';
                        }, 3000); // 5000 milisegundos (5 segundos)
                    })" x-show="show" x-transition
                        class="bg-green-100 border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">¡Éxito!</strong>
                        <span class="block sm:inline" x-text="message"></span>
                    </div>

                </div>
                <div class="md:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <x-label>Nombre del platillo</x-label>
                            <x-input type="text" class="w-full" placeholder="Nombre del platillo"
                                wire:model="form.name" />
                            <x-input-error for="form.name" />
                        </div>
                        <div class="col-span-1">
                            <x-label>Presentación</x-label>
                            <select class="w-full form-control" wire:model="form.ctg_presentation_food_id">
                                <option value="" selected>Seleccione:</option>
                                @foreach ($presentations as $presentation)
                                    <option value="{{ $presentation->id }}">{{ $presentation->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="form.ctg_presentation_food_id" />
                        </div>
                        <div class="col-span-2">
                            <x-label>Descripción</x-label>
                            <textarea rows="2" class="form-control w-full" wire:model='form.description'>
                                </textarea>
                            <x-input-error for="form.description" />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-6">

                        <div class="col-span-1">
                            <x-label>Ingrediente</x-label>
                            <x-input type="text" class="w-full"
                                wire:model='ingredientName' />
                            <x-input-error for="ingredientName" />
                        </div>

                        <div class="col-span-1">
                            <x-label>Cantidad</x-label>
                            <x-input type="number" class="w-full" wire:model='cantidad' />
                            <x-input-error for="cantidad" />
                        </div>
                        <div class="col-span-1">
                            <x-label>Gramaje</x-label>
                            <x-input type="number" class="w-full" wire:model='gramaje' />
                            <x-input-error for="gramaje" />
                        </div>



                        <div class="col-span-2">
                            <x-label>Medida</x-label>
                            <select class="form-control w-full" wire:model='ctg_grammage_id'>
                                <option value="" selected>Seleccione una medida</option>
                                @foreach ($grammages as $grammage)
                                    <option value="{{ $grammage->id }}">{{ $grammage->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="ctg_grammage_id" />
                        </div>
                        <div class="col-span-1 mt-5">
                            <button class="btn btn-blue" wire:click='addIngredient'>Agregar +</button>
                        </div>
                    </div>

                </div>


            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
                <div class="px-6 py-4 flex items-center  bg-gray-100">
                    <h1 class="font-bold"> Ingredientes</h1>
                </div>
                @if (count($ingredients))
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 px-6 py-4">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="w-24 px-4 py-2">Ingrediente</th>
                                <th class="w-24 px-4 py-2">Cantidad</th>
                                <th class="w-24 px-4 py-2">Gramaje</th>
                                <th class="w-24 px-4 py-2">Medida</th>
                                <th class="w-24 px-4 py-2">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{var_dump($ingredients)}} --}}
                            @foreach ($ingredients as $index => $ingredient)
                                <tr>
                                    <td class="px-6 py-4">{{ $ingredient['name'] }}</td>
                                    <td class="px-6 py-4">{{ $ingredient['cantidad'] }}</td>
                                    <td class="px-6 py-4">{{ $ingredient['gramaje'] }}</td>
                                    <td class="px-6 py-4">{{  $ingredient['grammage_name']?
                                                                $ingredient['grammage_name']:
                                                                $ingredient->grammage->name
                                                            }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="btn btn-red"
                                            wire:click="deleteIngredient({{ $index }})"
                                        >
                                            <i class="fa fa-trash" aria-hidden="true"></i>

                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-4">
                        <h1>No hay Ingredientes</h1>
                    </div>
                @endif
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
            {{--  wire:click="{{ $foodId ? 'update' : 'save' }}"" --}}
            <x-button wire:click="$dispatch('confirm',{{ $foodId }}) "
                class=" ml-3 disabled:opacity-25">Guardar</x-button>
        @endslot
    </x-dialog-modal>


    @push('js')
        
        <script>
            document.addEventListener('livewire:initialized', () => {
       
                @this.on('confirm', (foodId) => {

                    var txt = foodId != null ? "Actualizado" : "Creado"
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "El Platillo sera " + txt,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            @this.dispatch(foodId ? 'update-food' : 'save-food');

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
