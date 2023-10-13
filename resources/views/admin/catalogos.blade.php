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
                <div
                    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                        Productos
                    </h5>
                    <p class="mb-3 font-normal text-gray-700">
                        Bienvenido al catalogo de productos de Grupo Galvez.
                    </p>
                    <div class=" text-center">
                        <a href="{{route('buscar.producto')}}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                            Ingresar
                        </a>
                    </div>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                        Alta de menús
                    </h5>
                    <p class="mb-3 font-normal text-gray-700">
                        Bienvenido al catalogo de recetas y platillos de Grupo Galvez.
                    </p>
                    <div class=" text-center">
                        <a href="{{ route('buscar.comida') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                            Ingresar

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
