<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            <a href="{{ route('clientes') }}" title="ATRAS">
                <svg class="w-5 h-5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                        d="M13 5H3M8 1L3 5l5 4" />
                </svg>
            </a>
            &nbsp;
            {{ __('Clientes') }}
        </h2>



    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5 bg-white">
            <x-alert />
            <div class="px-6 py-4 items-center  bg-gray-50 mb-3 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Alta de cliente nuevo</h1>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full  group">
                    <h1 class="text-2xl mt-5 
                    text-gray-900 md:text-lg lg:text-2xl">Datos generales
                    </h1>
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
                    <x-label>Colonia</x-label>

                    <select wire:model="form.cat_cp_id" class="w-full form-control">
                        @if ($form->colonias)
                            <option value="">Selecciona una colonia</option>

                            @foreach ($form->colonias as $cp)
                                <option value="{{ $cp->idcp }}">{{ $cp->colonia }}</option>
                            @endforeach
                        @else
                            <option value="">Esperando...</option>
                        @endif

                    </select>
                    <x-input-error for="form.cat_cp_id" />

                </div>
                <div class="col-span-1 mt-6">

                    <x-danger-button class="ml-2" wire:click="$dispatch('confirm')">GUARDAR CLIENTE</x-danger-button>
                </div>

            </div>
            <div class="mt-3">
                <div class="grid grid-cols-2 gap-6 mt-4">



                    <div class="col-span-2">

                        <livewire:clientes.modal-productos />
                    </div>
                    <div class="col-span-2">

                        <livewire:clientes.modal-foods />
                    </div>
                    <div class="col-span-1">
                        <livewire:clientes.listar-productos />

                    </div>
                </div>
            </div>

        </div>
        <br><br>
    </div>


    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {

                @this.on('confirm', () => {

                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "El cliente sera guardado",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.dispatch('save-cliente');
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


