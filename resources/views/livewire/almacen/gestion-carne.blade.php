<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('CARNES') }}
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

                <x-input type="text" placeholder="Busca un CARNE" class="w-full ml-4" />

                <x-button class="ml-4" wire:click="openModalCarnes">AGREGAR CARNES</x-button>
            </div>



        </div>

    </div>





    <x-dialog-modal wire:model.live="openCarnes">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1> CARNES </h1>
            </div>
        @endslot
        @slot('content')
            <div class="">

                <div class="mt-4 p-5 bg-white" x-data="{ open: false }">

                    <div class=" py-6 px-4 bg-purple-100 flex" @click="open = ! open">

                        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">

                            {{ __('ESPALDILLA') }}
                            {{-- <i class="fa fa-chevron-down" aria-hidden="true"></i> --}}
                            <i x-bind:class="{ 'fa-chevron-down': !open, 'fa-chevron-up': open }" class="fa"
                                aria-hidden="true"></i>
                                <input type="text" hidden wire:model='tipoE' value="1">

                        </h2>
                    </div>
                    <div x-show="open">


                        <div x-data="{ totalKilos: '' }">
                            <div class="mb-4">
                                <label class="block text-gray-700">Cantidad de Kilos:</label>
                                <input type="text" x-model="totalKilos"  wire:model.live='catidadE' class="w-full border border-gray-300 p-2">
                            </div>
                            {{-- <span x-text="totalKilos"></span> --}}

                            <div x-data="{
                                checks: {
                                    ham: { selected: false, quantity: 0 },
                                    trotters: { selected: false, quantity: 0 },
                                    hock: { selected: false, quantity: 0 }
                                }, 
                            }">
                                <!-- Check para el jamón -->
                                <div class="mb-2">
                                    <input type="checkbox" id="ham" x-model="checks.ham.selected" class="mr-2">
                                    <label for="ham">Bisteck</label>
                                    <x-input type="number" x-show="checks.ham.selected" x-model="checks.ham.quantity"
                                        placeholder="Cantidad en kilos" wire:model.live='form.bisteckE' />

                                </div>

                                <!-- Check para los trotters -->
                                <div class="mb-2">
                                    <input type="checkbox" id="trotters" x-model="checks.trotters.selected" class="mr-2">
                                    <label for="trotters">Hueso</label>
                                    <x-input type="number" x-show="checks.trotters.selected"
                                        x-model="checks.trotters.quantity" wire:model.live='form.huesoE' placeholder="Cantidad en kilos" />
                                </div>

                                <!-- Check para el hock -->
                                <div class="mb-2">
                                    <input type="checkbox" id="hock" x-model="checks.hock.selected" class="mr-2">
                                    <label for="hock">Grasa</label>
                                    <x-input type="number" x-show="checks.hock.selected" x-model="checks.hock.quantity"
                                        placeholder="Cantidad en kilos" wire:model.live='form.grasaE'/>
                                </div>
                            </div>
                          
                            <x-danger-button wire:click='saveE'>Aceptar</x-danger-button>
                        </div>


                    </div>
                </div>



                <div class="mt-4 p-5 bg-white" x-data="{ open: false }">

                    <div class=" py-6 px-4 bg-purple-100 flex" @click="open = ! open">

                        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">

                            {{ __('PIERNA') }}
                            {{-- <i class="fa fa-chevron-down" aria-hidden="true"></i> --}}
                            <i x-bind:class="{ 'fa-chevron-down': !open, 'fa-chevron-up': open }" class="fa"
                                aria-hidden="true"></i>
                                <input type="text" hidden wire:model='tipoP' value="2">

                        </h2>
                    </div>
                    <div x-show="open">


                        <div x-data="{ totalKilos: '' }">
                            <div class="mb-4">
                                <label class="block text-gray-700">Cantidad de Kilos:</label>
                                <input type="text" x-model="totalKilos" wire:model='catidadP' class="w-full border border-gray-300 p-2">
                            </div>
                            {{-- <span x-text="totalKilos"></span> --}}
                            
                            <div x-data="{
                                checks: {
                                    ham: { selected: false, quantity: 0 },
                                    trotters: { selected: false, quantity: 0 },
                                    hock: { selected: false, quantity: 0 }
                                }, 
                            }">
                                <!-- Check para el jamón -->
                                <div class="mb-2">
                                    <input type="checkbox" id="ham" x-model="checks.ham.selected" class="mr-2">
                                    <label for="ham">Bisteck</label>
                                    <x-input type="text" x-show="checks.ham.selected" x-model="checks.ham.quantity"
                                        placeholder="Cantidad en kilos" wire:model='form.bisteckP' />

                                </div>

                                <!-- Check para los trotters -->
                                <div class="mb-2">
                                    <input type="checkbox" id="trotters" x-model="checks.trotters.selected" class="mr-2">
                                    <label for="trotters">Hueso</label>
                                    <x-input type="text" x-show="checks.trotters.selected"
                                        x-model="checks.trotters.quantity" wire:model='form.huesoP' placeholder="Cantidad en kilos" />
                                </div>

                                <!-- Check para el hock -->
                                <div class="mb-2">
                                    <input type="checkbox" id="hock" x-model="checks.hock.selected" class="mr-2">
                                    <label for="hock">Grasa</label>
                                    <x-input type="text" x-show="checks.hock.selected" x-model="checks.hock.quantity"
                                        placeholder="Cantidad en kilos" wire:model='form.grasaP'/>
                                </div>
                            </div>
                            <x-danger-button wire:click='saveP'>Aceptar</x-danger-button>

                        </div>



                    </div>
                </div>
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalCarnes">Cerrar</x-secondary-button>
            {{--  wire:click="{{ $productId ? 'update' : 'save' }}"" wire:click="$dispatch('confirm',{{ $productId }}) " --}}
            {{-- <x-danger-button class=" ml-3 disabled:opacity-25" wire:click="$dispatch('confirm')">ACEPTAR</x-danger-button> --}}
        @endslot
    </x-dialog-modal>

    @push('js')
     
    @endpush
</div>
