<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-40">
            <x-alert />
            <div class="grid grid-cols-2 gap-4 place-items-center">
                <div class="max-w-sm p-3  bg-white border border-gray-200 rounded-lg shadow">

                    <img class=" pr-8 rounded-t-lg ml-12" src="{{ asset('img/cliente-nuevo.png') }}" alt="product image" />
                    <h5 class="mb-5 mt-0 text-2xl text-center font-bold tracking-tight text-gray-900">
                        Alta de cliente
                    </h5>

                    <div class=" text-center">
                        {{-- <livewire:clientes.create-cliente /> --}}
                        <a href="{{route('clientes.crear')}}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                            Ingresar
                        </a>
                    </div>
                </div>


                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <img class="p-8 rounded-t-lg h-70" src="{{ asset('images/ctg/platillos.png') }}"
                        alt="product image" />
                    <h5 class="mb-2 text-2xl text-center font-bold tracking-tight text-gray-900">
                        Modificar pedidos de clienets
                    </h5>

                    <div class=" text-center">
                        <a href="{{ route('clientes.gestion') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
                            Ingresar

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</x-app-layout>
