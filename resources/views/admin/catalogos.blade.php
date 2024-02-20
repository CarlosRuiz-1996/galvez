<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight">
            {{ __('Catalogos') }}
        </h2>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-40">
            <x-alert />
            <div class="grid grid-cols-2 gap-4 place-items-center">
                @foreach ($catalogos as $catalogo)
                    <div class="max-w-sm p-3  bg-white border border-gray-200 rounded-lg shadow">

                        {{-- <img class="p-8 rounded-t-lg ml-12" src="{{ asset($catalogo->image_path) }}" alt="product image" /> --}}
                        <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900">
                            {{ $catalogo->name }}
                        </h5>
                        <p class="mb-3 font-normal text-gray-700">
                            {{ $catalogo->description }}
                        </p>
                        <div class=" text-center">
                            <?php
                                $parametros = $catalogo->id > 2 ? ['ctg' => $catalogo] : [];
                            ?>
                            <a href="{{route($catalogo->route,$parametros)}}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                                Ingresar
                            </a>
                        </div>
                    </div>
                @endforeach

                
            </div>



        </div>
    </div>
</x-app-layout>
