<x-slot name="header">
    <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
        <a href="{{ route('catalogos') }}"> {{ __('Catalogos > ') }}</a>
        {{ __('Platillos') }}
    </h2>
</x-slot>




<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <x-alert />
            <div class=" py-6 px-4 bg-gray-100 flex">
                <x-input placeholder="Busca por producto" type="text" class="w-full ml-4"
                    wire:model.live='form.seach_prod' />
                <x-input placeholder="Busca por categoria" type="text" class="w-full ml-4"
                    wire:model.live='form.seach_cat' />
                    <select name="" id="" class="form-control ml-4" wire:model.live='form.filtra_cat'>
                        @if ($form->filtra_cat)
                            <option value="0">Limpia filtro</option>
                        @elseif($form->filtra_cat == 0)
                            <option value="" selected>Selecciona una categoria</option>
                        @endif
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $form->filtra_cat ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
            </div>
            <div class="p-8">
                @if (isset($products))
                    <table class="w-full text-sm text-left text-gray-500 mb-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">NOMBRE</th>
                                <th scope="col" class="px-6 py-3">PRESENTACIÓN</th>
                                <th scope="col" class="px-6 py-3">IMAGEN</th>
                                <th scope="col" class="px-6 py-3">FICHA TECNICA</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($products as $product)
                                <tr class="table-row bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $product->name }}</td>
                                    <td class="px-4 py-4">{{ $product->presentation->name }}</td>
                                    <td class="px-6 py-4">

                                        <img class="p-8 rounded-t-lg h-40"
                                            @if ($product->image_path) src="{{ asset('storage/' . $product->image_path) }}"
                                                alt="product image"
                                            @else
                                                src="{{ asset('img/producto.png/') }}"
                                                alt="product image" @endif />
                                                
                                    </td>
                                    <td>
                                        <?php
                                        if (strlen($product->description) > 50) {
                                            $texto_corto = substr($product->description, 0, 50);
                                            $texto_restante = substr($product->description, 50);
                                            echo $texto_corto;
                                        } else {
                                            echo $product->description;
                                        }
                                        ?>

                                        <button type="button"
                                            class="font-medium text-orange-600 dark:text-blue-500 hover:underline"
                                            wire:click='showMore({{ $product }})'>...Ver más</button>

                                    </td>
                                </tr>
                            @empty
                                <div class="px-6 py-4">
                                    <h1>No hay registros</h1>
                                </div>
                            @endforelse

                        </tbody>
                    </table>
                @endif
                @if (isset($categories))
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($categories as $category)
                            <div class="max-w-sm p-3 text-center bg-white border border-gray-200 rounded-lg shadow">
                                <div class="card-image">
                                        <img class="p-8 rounded-t-lg h-70"
                                            src="{{ asset('images/ctg/' . $category->image_path) }}"
                                            alt="product image" />
                                    <!-- Contenido de la tarjeta -->
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                        {{ $category->name }}
                                    </h5>
                                    <a href="{{ route('gestion.ctg.comida', ['category' => $category]) }}"
                                        class="inline-flex items-center px-3 py-2 text-xl font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                                        Ingresar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h2>sin categorias registradas</h2>
                @endif

            </div>
        </div>
    </div>


    @if ($open)
        <x-dialog-modal wire:model.live="open">
            @slot('title')
                <h1>{{ $nameProduct }}</h1>
            @endslot
            @slot('content')
                <div class="flex">
                    <div class="w-1/2">
                        <p class="text-xl font-bold text-gray-900 mb-3">Ingredientes</p>
                        @foreach ($ingredients as $ingredient)
                            <li>{{ $ingredient->name }}</li>
                        @endforeach
                    </div>
                    <div class="w-1/2">
                        <p class="text-xl font-bold text-gray-900 mb-3">Descripción</p>

                        <p>{{ $detalle ? $detalle : 'Sin Detalles' }}</p>
                    </div>
                    <div class="w-1/2">
                        <img class="p-8 rounded-t-lg h-40"
                            @if ($imagenPath) src="{{ asset('storage/' . $imagenPath) }}"

                            alt="product image"
                        @else
                            src="{{ asset('img/producto.png/') }}"
                            alt="product image" @endif />
                    </div>
                </div>
            @endslot
            @slot('footer')
                <x-button class="ml-3" wire:click="closeModal">CERRAR</x-button>
            @endslot
        </x-dialog-modal>
    @endif
</div>
