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


                        <div>
                            <label for="cantidad">Cantidad:</label>
                            <input id="cantidad" type="number">
                        
                            <div id="checkbox-container">
                                {{-- @for($i = 1; $i <= 5; $i++) --}}
                                    <input type="checkbox" id="checkbox_1" data-index="1">
                                    <label for="checkbox_1">Opción 1</label>
                                    <input type="number" id="cantidadOpcion_1" disabled>
                                {{-- @endfor --}}
                            </div>
                        </div>
                            <x-danger-button wire:click='saveE'>Aceptar</x-danger-button>


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



                        <x-danger-button wire:click='saveP'>Aceptar</x-danger-button>




                    </div>
                </div>
            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalCarnes">Cancelar</x-secondary-button>
            {{--  wire:click="{{ $productId ? 'update' : 'save' }}"" wire:click="$dispatch('confirm',{{ $productId }}) " --}}
            <x-danger-button class=" ml-3 disabled:opacity-25" wire:click="$dispatch('confirm')">ACEPTAR</x-danger-button>
        @endslot
    </x-dialog-modal>

    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
        const cantidadInput = document.getElementById('cantidad');
        const checkboxContainer = document.getElementById('checkbox-container');

        cantidadInput.addEventListener('input', function () {
            const cantidadTotal = parseInt(cantidadInput.value) || 0;
            const checkboxes = checkboxContainer.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function (checkbox) {
                const cantidadOpcionInput = document.getElementById('cantidadOpcion_' + checkbox.dataset.index);
                cantidadOpcionInput.disabled = !checkbox.checked;

                if (!checkbox.checked) {
                    cantidadOpcionInput.value = '';
                } else if (parseInt(cantidadOpcionInput.value) > cantidadTotal) {
                    cantidadOpcionInput.value = cantidadTotal;
                }
            });
        });

        checkboxContainer.addEventListener('change', function (event) {
            const checkbox = event.target;
            const cantidadOpcionInput = document.getElementById('cantidadOpcion_' + checkbox.dataset.index);
            cantidadOpcionInput.disabled = !checkbox.checked;

            if (!checkbox.checked) {
                cantidadOpcionInput.value = '';
            } else {
                const cantidadTotal = parseInt(cantidadInput.value) || 0;
                if (parseInt(cantidadOpcionInput.value) > cantidadTotal) {
                    cantidadOpcionInput.value = cantidadTotal;
                }
            }
        });
    });
        </script>
    @endpush
</div>
