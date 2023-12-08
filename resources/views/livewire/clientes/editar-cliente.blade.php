<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            <a href="{{ route('clientes.gestion') }}" title="ATRAS">
                <svg class="w-5 h-5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                        d="M13 5H3M8 1L3 5l5 4" />
                </svg>
            </a>
            &nbsp;
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>


    {{-- datos generales --}}
    <div class="max-w-7xl  mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5 bg-white">

            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full  group">
                    <h1 class="text-2xl mt-5 
                            text-gray-900 md:text-lg lg:text-2xl">Datos
                        generales</h1>
                    <hr>

                </div>
                <div class="relative z-0 w-full  group"></div>
                <div class="relative z-0 w-full  group">
                    <x-label>Numero de contrato</x-label>
                    <x-input type="number" class="w-full" wire:model='form.no_contrato' />
                    <x-input-error for="form.no_contrato" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Nombre del cliente</x-label>
                    <x-input type="text" class="w-full uppercase" wire:model='form.cliente' />
                    <x-input-error for="form.cliente" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Nombre del contacto</x-label>
                    <x-input type="text" class="w-full uppercase" wire:model='form.name' />
                    <x-input-error for="form.name" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Numero de telefono</x-label>
                    <x-input type="number" class="w-full" wire:model='form.phone' />
                    <x-input-error for="form.phone" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Correo</x-label>
                    <x-input type="text" class="w-full" wire:model='form.email' />
                    <x-input-error for="form.email" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>RFC</x-label>
                    <x-input type="text" class="w-full uppercase" wire:model='form.rfc' />
                    <x-input-error for="form.rfc" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Calle y numero</x-label>
                    <x-input type="text" class="w-full uppercase" wire:model='form.address' />
                    <x-input-error for="form.address" />
                </div>




            </div>

            <div class="grid grid-cols-3 gap-6 mt-4">

                <div class="col-span-1">
                    <x-label>Código Postal</x-label>
                    <x-input type="number" wire:model='form.cp' class="w-full" />

                    @if ($form->cp_invalido != '')
                        <div class=" bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $form->cp_invalido }}</span>
                        </div>
                    @endif
                    <x-input-error for="form.cp" />
                </div>
                <div class="col-span-1 mt-5">
                    <x-button wire:click='validarCp'>Validar cp</x-button>
                </div>
                <div class="col-span-1">
                    <x-label>Alcaldia/Municipio</x-label>
                    <x-input type="text" disabled wire:model='form.municipio' class="w-full bg-gray-200" />
                    <x-input-error for="form.municipio" />
                </div>
                <div class="col-span-1">
                    <x-label>Estado</x-label>
                    <x-input type="text" disabled wire:model='form.estado' class="w-full bg-gray-200" />
                    <x-input-error for="form.estado" />
                </div>



                <div class="col-span-1">
                    <x-label>Colonia {{ $form->cat_cp_id }}</x-label>

                    <select wire:model="form.cat_cp_id" class="w-full form-control">
                        @if ($form->colonias)
                            <option value="">Selecciona una colonia</option>

                            @foreach ($form->colonias as $cp)
                                @if ($form->cat_cp_id == $cp->idcp || count($form->colonias) == 1)
                                    <option value="{{ $cp->idcp }}" selected>{{ $cp->colonia }}</option>
                                @break

                            @else
                                <option value="{{ $cp->idcp }}">{{ $cp->colonia }}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="">Esperando...</option>
                    @endif

                </select>
                <x-input-error for="form.cat_cp_id" />
            </div>
            <div class="col-span-1 mt-6">

                <x-danger-button wire:click="$dispatch('confirm',1) ">

                    Guardar cambios
                </x-danger-button>
            </div>
        </div>
    </div>

    {{-- datos productos --}}

    <div class="mt-4 p-5 bg-white" x-data="{ open: false }">

        <div class=" py-6 px-4 bg-purple-100 flex" @click="open = ! open">

            <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">

                {{ __('Productos') }}
                {{-- <i class="fa fa-chevron-down" aria-hidden="true"></i> --}}
                <i x-bind:class="{ 'fa-chevron-down': !open, 'fa-chevron-up': open }" class="fa"
                    aria-hidden="true"></i>

            </h2>
        </div>
        <div x-show="open">
            <div class=" py-6 px-4 bg-gray-100 flex">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="form-control" wire:model.live='listP'>
                        @foreach ($entradaP as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span>Entradas</span>
                </div>

                <x-input type="text" placeholder="Busca un producto" class="w-full ml-4"
                    wire:model.live='form.searchP' />

            </div>

            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="w-24 px-4 py-2 cursor-pointer" >
                            ID
                           
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" >
                            NOMBRE
                           
                        </th>
                        <th scope="col" class="w-40 px-6 py-3 cursor-pointer"
                          >PRESENTACIÓN

                           
                        </th>
                        <th scope="col" class="w-40 px-6 py-3 cursor-pointer">
                            GRAMAJE
                       

                        </th>
                        <th scope="col" class="px-6 py-3">IMAGEN</th>
                        <th scope="col" class="px-6 py-3 cursor-pointer">
                            FICHA
                            TECNICA
                          
                        </th>

                        <th scope="col" class="px-6 py-3 cursor-pointer">
                            MAX
                           
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" >
                            MIN
                          
                        </th>
                        <th scope="col" class="px-6 py-3">EDITAR</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($products as $product)
                        <tr class="table-row bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $product->id }}</td>

                            <td class="px-6 py-4">{{ $product->product->name }}</td>
                            <td class="px-6 py-4">{{ $product->product->presentation->name }}</td>
                            <td class="px-6 py-4">{{ $product->product->grammage->name }}</td>
                            <td class="px-6 py-4">

                                <img class="rounded-t-lg w-auto h-auto"
                                    @if ($product->product->image_path) src="{{ asset('storage/products/' . $product->product->image_path) }}"
                                    alt="product image"
                                @else
                                    src="{{ asset('img/producto.png/') }}"
                                    alt="product image" @endif />
                            </td>

                            <td class="px-6 py-4">
                                {{ $product->product->description ? $product->product->description : 'Sin descripción' }}
                            </td>
                            <td class="px-6 py-4">{{ $product->max }}</td>
                            <td class="px-6 py-4">{{ $product->min }}</td>

                            <td class="text-center">
                                <button class="btn btn-green mr-2 p-2"
                                    wire:click='openModalP({{ $product }})'>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
         

        </div>
    </div>


    {{-- modal productos --}}
    <x-dialog-modal wire:model.live="openP">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Editando producto</h1>

            </div>
        @endslot
        @slot('content')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <img class="rounded-t-lg w-full h-auto"
                        @if ($form->product && $form->product['product'] && $form->product['product']['image_path']) src="{{ asset('storage/products/' . $form->product['product']['image_path']) }}"
                    @else
                        src="{{ asset('img/producto.png') }}" @endif
                        alt="product image" />
                </div>
                <div class="md:col-span-2">
                    <h1 class="text-center"><strong>{{ $form->product['product']['name'] ?? 'N/A' }}</strong></h1>
                    <p><strong>Descripción:</strong> {{ $form->product['product']['description'] ?? 'N/A' }}</p>
                    <p><strong>Precio sugerido:</strong> ${{ $form->product['product']['price'] ?? 'N/A' }}</p>
                    <p><strong>Gramaje:</strong> {{ $form->product['product']['grammage']['name'] ?? 'N/A' }} g</p>
                    <p><strong>Categoría:</strong> {{ $form->product['product']['presentation']['name'] ?? 'N/A' }}</p>
                    <p><strong>Presentación:</strong> {{ $form->product['product']['presentation']['name'] ?? 'N/A' }}
                    </p>

                    <hr>
                    <br><br>
                    <!-- Inputs adicionales -->
                    <div class="form-group">
                        <label for="max">Maximo</label>

                        <x-input type="text" class="w-full" placehorder="MAXIMO" wire:model='form.max' />
                    </div>

                    <div class="form-group">
                        <label for="min">Minimo</label>
                        <x-input type="text" class="w-full" placehorder="MINIMO" wire:model='form.min' />
                    </div>
                    <div class="form-group">
                        <label for="min">Precio</label>
                        <x-input type="number" class="w-full" placehorder="PRECIO" wire:model='form.price_prod' />
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <x-input type="text" class="w-full" wire:model='form.description' />

                    </div>
                </div>
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalP">CERRAR</x-secondary-button>
            <x-danger-button wire:click="$dispatch('confirm',2)">guardar</x-danger-button>
        @endslot
    </x-dialog-modal>






    {{-- editar platillos --}}
    <div class="mt-4 p-5 bg-white" x-data="{ open: false }">

        <div class=" py-6 px-4 bg-purple-100 flex" @click="open = ! open">

            <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">

                {{ __('Platillos') }}
                {{-- <i class="fa fa-chevron-down" aria-hidden="true"></i> --}}
                <i x-bind:class="{ 'fa-chevron-down': !open, 'fa-chevron-up': open }" class="fa"
                    aria-hidden="true"></i>

            </h2>
        </div>
        <div x-show="open">
            <div class=" py-6 px-4 bg-gray-100 flex">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="form-control" wire:model.live='listPl'>
                        @foreach ($entradaPl as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span>Entradas</span>
                </div>

                <x-input type="text" placeholder="Busca un platillo" class="w-full ml-4"
                    wire:model.live='form.seach_food' />

            </div>

            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="w-24 px-4 py-2 cursor-pointer" wire:click="orderPl('id')">ID
                            @if ($sortPl == 'id')
                                @if ($orderByPl == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="orderPl('name')">
                            NOMBRE
                            @if ($sortPl == 'name')
                                @if ($orderByPl == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                            @endif
                        </th>
                        <th scope="col" class="w-40 px-6 py-3 cursor-pointer"
                            wire:click="orderPl('ctg_presentation_food_id')">PRESENTACIÓN

                            @if ($sortPl == 'ctg_presentation_food_id')
                                @if ($orderByPl == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                            @endif
                        </th>
                        <th scope="col" class="w-40 px-6 py-3 cursor-pointer"
                            wire:click="orderPl('ctg_categories_food_id')">
                            CATEGORIA
                            @if ($sortPl == 'ctg_categories_food_id')
                                @if ($orderByPl == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                            @endif

                        </th>
                        <th scope="col" class="px-6 py-3">IMAGEN</th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="orderPl('description')">
                            FICHA
                            TECNICA
                            @if ($sortPl == 'description')
                                @if ($orderByPl == 'asc')
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

                    @foreach ($foods as $food)
                        <tr class="table-row bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $food->id }}</td>

                            <td class="px-6 py-4">{{ $food->food->name }}</td>
                            <td class="px-6 py-4">{{ $food->food->presentation->name }}</td>
                            <td class="px-6 py-4">{{ $food->food->categorie->name }}</td>
                            <td class="px-6 py-4">

                                <img class="rounded-t-lg w-auto h-auto"
                                    @if ($food->food->image_path) src="{{ asset('storage/' . $food->food->image_path) }}"
                                    alt="product image"
                                @else
                                    src="{{ asset('img/producto.png/') }}"
                                    alt="product image" @endif />
                            </td>

                            <td class="px-6 py-4">
                                {{ $food->food->description ? $food->food->description : 'Sin descripción' }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-green mr-2 p-2"
                                    wire:click='openModalPl({{ $food }})'>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
          
        </div>
    </div>
    <br><br>
    {{-- modal platillos --}}
    <x-dialog-modal wire:model.live="openPl">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Editando Platillo</h1>

            </div>
        @endslot
        @slot('content')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <img class="rounded-t-lg w-full h-auto"
                        @if ($form->food && $form->food['food'] && $form->food['food']['image_path']) src="{{ asset('storage/' . $form->food['food']['image_path']) }}"
                    @else
                        src="{{ asset('img/producto.png') }}" @endif
                        alt="product image" />


                    <hr>
                    <br><br>
                    {{-- Mostrar ingredientes si existen --}}
                    @if ($form->food && $form->food['food'] && $form->food['food']['ingredients'])
                        <p><strong>Ingredientes:</strong></p>
                        <ul>
                            @foreach ($form->food['food']['ingredients'] as $ingredient)
                                <li>-{{ $ingredient['name'] }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p><strong>Ingredientes:</strong> N/A</p>
                    @endif



                </div>
                <div class="md:col-span-2">
                    <h1 class="text-center"><strong>{{ $form->food['food']['name'] ?? 'N/A' }}</strong></h1>
                    <p><strong>Descripción:</strong> {{ $form->food['food']['description'] ?? 'N/A' }}</p>
                    <p><strong>Precio sugerido:</strong> ${{ $form->food['product']['price_food'] ?? 'N/A' }}</p>
                    <p><strong>Categoría:</strong> {{ $form->food['product']['categorie']['name'] ?? 'N/A' }}</p>
                    <p><strong>Presentación:</strong> {{ $form->food['product']['presentation']['name'] ?? 'N/A' }}
                    </p>

                    <hr>
                    <br><br>
                    <!-- Inputs adicionales -->
                    <div class="form-group">
                        <label for="max">Maximo</label>

                        <x-input type="text" class="w-full" placehorder="MAXIMO" wire:model='form.max' />
                    </div>

                    <div class="form-group">
                        <label for="min">Minimo</label>
                        <x-input type="text" class="w-full" placehorder="MINIMO" wire:model='form.min' />
                    </div>
                    <div class="form-group">
                        <label for="min">Precio</label>
                        <x-input type="number" class="w-full" placehorder="PRECIO" wire:model='form.price_food' />
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <x-input type="text" class="w-full" wire:model='form.description' />

                    </div>
                </div>
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalPl">CERRAR</x-secondary-button>
            <x-danger-button wire:click="$dispatch('confirm',3)">guardar</x-danger-button>
        @endslot
    </x-dialog-modal>


    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {

                @this.on('confirm', (opcion) => {

                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: opcion == 1 ? "El cliente sera actualizado" :
                            "El producto sera actualizado",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            if (opcion == 1) {
                                @this.dispatch('update-cliente');
                            } else if (opcion == 2) {
                                @this.dispatch('update-clienteProd');

                            } else if (opcion == 3) {
                                @this.dispatch('update-clienteFood');

                            }


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
