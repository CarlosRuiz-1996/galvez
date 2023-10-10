<x-slot name="header">
    <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
       <a href="{{route('catalogos')}}"> {{ __('Catalogos > ') }}</a>
        {{ __('productos') }}
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

            </div>
            <div class="p-8">
                @if (isset($products))
                    <table class="w-full text-sm text-left text-gray-500 mb-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">NOMBRE</th>
                                <th scope="col" class="px-6 py-3">PRESENTACIÓN</th>
                                <th scope="col" class="px-6 py-3">GRAMAGE</th>
                                <th scope="col" class="px-6 py-3">IMAGEN</th>
                                <th scope="col" class="px-6 py-3">FICHA TECNICA</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product)
                                <tr class="table-row bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $product->name }}</td>
                                    <td class="px-4 py-4">{{ $product->presentation->name }}</td>
                                    <td class="px-6 py-4">{{ $product->grammage->name }}</td>
                                    <td class="px-6 py-4">

                                        <img class="p-8 rounded-t-lg h-40"
                                        <?php $nombreDeLaImagen = basename($product->image_path);?>
                                            @if ($product->image_path) src="{{ asset('storage/products/' . $nombreDeLaImagen) }}"
                                                alt="product image"
                                            @else
                                                src="{{ asset('img/producto.png/') }}"
                                                alt="product image"
                                            @endif
                                         />
                                    </td>
                                    <td>
                                        <?php
                                        if (strlen($product->description) > 100) {
                                            $texto_corto = substr($product->description, 0, 100);
                                            $texto_restante = substr($product->description, 100);
                                            echo $texto_corto;
                                        } else {
                                            echo $product->description;
                                        }
                                        ?>

                                        <button type="button"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            wire:click='showMore({{ $product }})'>...Ver más</button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @endif
                @if (isset($categories))
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($categories as $category)
                            <div class="max-w-sm p-6 text-center bg-white border border-gray-200 rounded-lg shadow">
                                <h5 class="mb-2 text-2xl  font-bold tracking-tight text-gray-900">
                                    {{ $category->name }}
                                </h5>

                                <a href="{{ route('gestion.ctg.producto', ['category' => $category]) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                                    Ingresar

                                </a>
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
                        <p>{{ $detalle }}</p>
                    </div>
                    <div class="w-1/2">
                        <img class="p-8 rounded-t-lg h-40"
                            @if ($imagenPath) src="{{ asset('img/products/' . $imagenPath) }}"
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
