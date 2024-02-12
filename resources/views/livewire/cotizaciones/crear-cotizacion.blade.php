<div >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            <a href="{{ route('clientes.cotizacion') }}" title="ATRAS">
                <svg class="w-5 h-5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                        d="M13 5H3M8 1L3 5l5 4" />
                </svg>
            </a>
            &nbsp;
            {{ __('Cotizaciones') }}
        </h2>



    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-4 p-5 bg-white">
            <x-alert />
            
            <div class="px-6 py-4 flex items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <div class="relative z-0 w-full  ">
                    <h1>Crear Cotización {{$form_cliente->activo ? 'para cliente activo':''}}</h1>
                </div>

                <div class="relative z-0 w-full  text-end">
                    <x-button title="COTIZACIÓN PARA CLIENTE ACTIVO" wire:click="openModalCli">Cliente Activo</x-button>
                </div>

            </div>
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full  group">
                    <h1 class="text-2xl mt-5 
                    text-gray-900 md:text-lg lg:text-xl">Datos generales</h1>
                    <hr>

                </div>
                <div class="relative z-0 w-full  group"></div>
                <div class="relative z-0 w-full  group">
                    <?php $disabled = '';?>
                    @if ($form_cliente->activo)
                    <?php $disabled = 'disabled'?>
                    <x-label>Numero de contrato</x-label>
                    <x-input type="number" value="0" disabled  class="w-full bg-gray-200"
                            wire:model='form_cliente.no_contrato' />
                    <x-input-error for="form_cliente.no_contrato" />
                    @endif
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Nombre del cliente </x-label>
                    <input type="text" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        wire:model='form_cliente.cliente' {{$disabled}} />
                    <x-input-error for="form_cliente.cliente" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Nombre del contacto</x-label>
                    <input type="text" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                     wire:model='form_cliente.name' {{$disabled}}/>
                    <x-input-error for="form_cliente.name" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Numero de telefono</x-label>
                    <input type="number" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                     wire:model='form_cliente.phone' {{$disabled}}/>
                    <x-input-error for="form_cliente.phone" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Correo</x-label>
                    <input type="text" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                     wire:model='form_cliente.email' {{$disabled}}/>
                    <x-input-error for="form_cliente.email" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>RFC</x-label>
                    <input type="text" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    wire:model='form_cliente.rfc' />
                    <x-input-error for="form_cliente.rfc" {{$disabled}}/>
                </div>
                @if (!$form_cliente->activo)
                    <div class="relative z-0 w-full  group">
                        <x-label>Calle y numero</x-label>
                        <x-input type="text" class="w-full uppercase" wire:model='form_cliente.address' />
                        <x-input-error for="form_cliente.address" />
                    </div>
                @else
                <div class="col-span-1 mt-6">

                    <x-danger-button class="ml-2" wire:click="$dispatch('confirm')">GUARDAR COTIZACION</x-danger-button>
                </div>
                @endif


            </div>

            @if (!$form_cliente->activo)

                <div class="grid grid-cols-3 gap-6 mt-4">

                    <div class="col-span-1">
                        <x-label>Código Postal</x-label>
                        <x-input type="number" wire:model='form_cliente.cp' class="w-full" />

                        @if ($form_cliente->cp_invalido != '')
                            <div class=" bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <span class="block sm:inline">{{ $form->cp_invalido }}</span>
                            </div>
                        @endif
                        <x-input-error for="form_cliente.cp" />
                    </div>
                    <div class="col-span-1 mt-5" style="">
                        <x-button wire:click='validarCp'>Validar cp</x-button>
                    </div>
                    <div class="col-span-1">
                        <x-label>Alcaldia/Municipio</x-label>
                        <x-input type="text" disabled wire:model='form_cliente.municipio'
                            class="w-full bg-gray-200" />
                        <x-input-error for="form_cliente.municipio" />
                    </div>
                    <div class="col-span-1">
                        <x-label>Estado</x-label>
                        <x-input type="text" disabled wire:model='form_cliente.estado' class="w-full bg-gray-200" />
                        <x-input-error for="form_cliente.estado" />
                    </div>



                    <div class="col-span-1">
                        <x-label>Colonia</x-label>

                        <select wire:model="form_cliente.cat_cp_id" class="w-full form-control">
                            @if ($form_cliente->colonias)
                                <option value="">Selecciona una colonia</option>

                                @foreach ($form_cliente->colonias as $cp)
                                    <option value="{{ $cp->idcp }}">{{ $cp->colonia }}</option>
                                @endforeach
                            @else
                                <option value="">Esperando...</option>
                            @endif

                        </select>
                        <x-input-error for="form_cliente.cat_cp_id" />

                    </div>
                    <div class="col-span-1 mt-6">

                        <x-danger-button class="ml-2" wire:click="$dispatch('confirm')">GUARDAR COTIZACION</x-danger-button>
                    </div>
                </div>
            @endif
            
            
            <div class="mt-3">
                <div class="grid grid-cols-3 gap-6 mt-4">



                    <div class="col-span-1">

                        <livewire:clientes.modal-productos :type="2" />
                    </div>
                    <div class="col-span-1">

                        {{-- <livewire:clientes.modal-foods /> --}}
                    </div>
                    <div class="col-span-1">
                        <livewire:clientes.listar-productos />

                    </div>
                </div>
            </div>
            {{-- <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button> --}}
          
        </div>
        <br><br>

    </div>


    <x-dialog-modal wire:model.live="openCli">
        @slot('title')
            <div class="px-6 py-4 flex items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <div class="relative z-0 w-full  ">
                    <h1>Busca un cliente</h1>
                </div>

            </div>
        @endslot
        @slot('content')
            <div class="px-6 py-4 flex items-center">

                <div class="relative z-0 w-full  ">

                    <x-input type="text" wire:model.live='search' wire:input='searchCliente' class="w-full" />
                    <ul>
                        @foreach ($clientes as $cli)
                            <li class="hover:bg-gray-100 p-2 cursor-pointer border-gray-300 rounded-md shadow-sm"
                                wire:click='clienteSelect({{ $cli['id'] }})'>
                                {{ $cli['cliente'] }}
                                {{ $cli['rfc'] }}
                                {{ $cli['no_contrato'] }}
                                {{ $cli['name'] }}
                            
                            </li>
                        @endforeach
                    </ul>
                </div>

              
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalCli">Cancelar</x-secondary-button>
        @endslot
    </x-dialog-modal>



    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {

                @this.on('confirm', () => {

                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "La cotizacion se guardara",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.dispatch('save-cotizacion');
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
