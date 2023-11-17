<div>
    <button wire:click="openModal"
        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300">
        Ingresar
    </button>



    <x-dialog-modal-xl wire:model.live="open">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Alta de cliente nuevo</h1>
            </div>
        @endslot
        @slot('content')
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full  group">
                    <h1 class="text-2xl mt-5 
                    text-gray-900 md:text-lg lg:text-2xl">Datos generales</h1>
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
                    <x-input type="text" class="w-full uppercase"  wire:model='form.cliente' />
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
                <div class="col-span-1 mt-5" style="margin-left: -80px">
                    <x-button wire:click='validarCp'>Validar cp</x-button>
                </div>
                <div class="col-span-1"></div>
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
                            @foreach ($form->colonias as $cp)
                                <option value="{{ $cp->id }}">{{ $cp->colonia }}</option>
                            @endforeach
                        @else
                            <option value="">Esperando...</option>
                        @endif

                    </select>
                    <x-input-error for="form.cat_cp_id" />

                </div>

            </div>
            <div class="mt-3">
                <div class="grid grid-cols-3 gap-6 mt-4">

                    

                    <div class="col-span-1">

                        <livewire:clientes.modal-productos />
                    </div>
                    <div class="col-span-1">

                        <livewire:clientes.modal-foods />
                    </div>
                    <div class="col-span-1">
                        <livewire:clientes.listar-productos />

                    </div>
                </div>
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
            <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button>
        @endslot
    </x-dialog-modal-xl>





</div>
