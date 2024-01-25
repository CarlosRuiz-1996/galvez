<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('Carnes') }}
        </h2>



    </x-slot>




    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3" x-data="{ activeTab: 'Pollo' }">
        {{-- muestro los tabs --}}

        <ul class="flex" role="tablist">

            @foreach ($carne_tipo as $tipo)
                <li role="presentation" class="mr-2">
                    <button @click="activeTab = '{{ $tipo['name'] }}'"
                        :class="{ 'bg-orange-500': activeTab === '{{ $tipo['name'] }}', 'text-white': activeTab === '{{ $tipo['name'] }}', 'border': activeTab !== '{{ $tipo['name'] }}', 'border-gray-300': activeTab !== '{{ $tipo['name'] }}' }"
                        :style="{
                            'background-color': activeTab === '{{ $tipo['name'] }}' ? '' : 'white',
                            'color': activeTab === '{{ $tipo['name'] }}' ?
                                '' : 'black'
                        }"
                        class="py-2 px-4 rounded-t-md" role="tab" aria-selected="true">{{ $tipo['name'] }}</button>
                </li>
            @endforeach


        </ul>

        {{-- muestro datos dentro de los tabs --}}
        @foreach ($carne_tipo as $tipo)
            <div x-show="activeTab === '{{ $tipo['name'] }}'" class="py-4 px-0 bg-gray-100">
                <div class="py-6 px-4 bg-gray-200 flex">
                    <div class="flex items-center">
                        <span>Mostrar</span>
                        <select class="form-control" wire:model.live='list'>
                            @foreach ($entrada as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <span>Entradas</span>
                    </div>

                    <x-input type="text" placeholder="Busca un {{ $tipo['name'] }}" class="w-full ml-4" />

                    <x-button class="ml-4" wire:click="openModal({{ $tipo['id'] }})">Registrar </x-button>
                </div>


                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 text-center">
                        <tr>
                            <th scope="col" class="w-24 px-4 py-2 cursor-pointer" wire:click="order('id')">ID
                                @if ($sort == 'id')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('ctg_grammage_id')">
                                GRAMAJE

                                @if ($sort == 'ctg_grammages')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('created_at')">
                                FECHA ALTA

                                @if ($sort == 'created_at')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('updated_at')">
                                FECHA ACTUALIZADO

                                @if ($sort == 'updated_at')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">ACCIONES</th>
                        </tr>
                    </thead>
                    {{-- ocupo alpine para poder desplegar y comprimir detalles --}}
                    <tbody class="text-center" x-data="{ openRow: false }">
                        @foreach ($carnes as $product)
                            @if ($tipo['id'] == $product->ctg_tipo_carnes_id)
                                <tr class="table-row border-b bg-white hover:bg-orange-50"
                                    @click="openRow === {{ $product->id }} ? openRow = false : openRow = {{ $product->id }}">
                                    <td class="px-6 py-4">{{ $product->id }}</td>
                                    <td class="px-6 py-4">
                                        {{ $product->gramaje_total . ' ' . $product->grammage->name }}</td>
                                    <td class="px-6 py-4">{{ $product->created_at }}</td>
                                    <td class="px-6 py-4">{{ $product->updated_at }}</td>
                                    <td class="px-6 py-4">
                                        <button class="btn btn-blue mr-2 p-2"
                                            @click="openRow === {{ $product->id }} ? openRow = true : openRow = {{ $product->id }}"
                                            wire:click="agregar({{ $tipo['id'] }},{{ $product->id }})">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>

                                </tr>

                                {{-- informacion que se despliega al dar click --}}
                                <tr class="text-black bg-orange-200" x-show="openRow === {{ $product->id }}">
                                    <td></td>
                                    <td>
                                        Producto
                                    </td>
                                    <td>
                                        Gramaje
                                    </td>
                                    <td></td>
                                </tr>
                                <?php $total_k = 0; ?>
                                @foreach ($product->details as $detail)
                                    <tr class="text-black bg-gray-00" x-show="openRow === {{ $product->id }}">
                                        <td>{{ $detail->id }}</td>
                                        <td>
                                            {{ $detail->tipo->name }}
                                        </td>
                                        <td>
                                            {{ $detail->gramaje_total . ' ' . $detail->grammage->name }}
                                        </td>
                                        <td>
                                            <button class="btn btn-green mr-2 p-2"
                                                wire:click="editt({{ $detail->id }})">
                                                <i class="fas fa-edit"></i>

                                            </button>
                                        </td>
                                    </tr>
                                    <?php $total_k += $detail->gramaje_total; ?>
                                @endforeach
                                <tr class="text-black bg-gray-200" x-show="openRow === {{ $product->id }}">
                                    <td></td>
                                    <td>

                                    </td>
                                    <td>
                                        Total:<?= $total_k ?>
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>

            </div>
        @endforeach
    </div>








    {{-- crear --}}
    <x-dialog-modal-xl wire:model.live="open">
        @slot('title')
            <div class="px-6 py-4 flex items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <div class="relative z-0 w-full  ">
                    <h1> CARNE DE {{ Str::upper($nombre_modal) }}</h1>
                </div>
                @if ($edit)
                    <div class="relative z-0 w-full  text-end">
                        <x-label>FECHA DE ENTRADA: {{ $fecha }}</x-label>
                    </div>
                @endif
            </div>
        @endslot
        @slot('content')


            <x-label>ENTRADA TOTAL</x-label>

            <div class="flex items-center w-full">


                <div class="relative z-0 w-full  ">
                    <x-input type="number" wire:model='form.total' class="w-full bg-white mr-4" />
                    <x-input-error for="form.total" />
                </div>
                <div class="ml-5">

                    <select class="form-control" wire:model='form.gramaje_total'>
                        <option value="" selected>Gramaje:</option>
                        @foreach ($grammages as $grammage)
                            @if ($grammage['id'] == 1 || $grammage['id'] == 4)
                                <option value="{{ $grammage['id'] }}">{{ $grammage['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error for="form.gramaje_total" />
                </div>
            </div>

            <hr class="mt-5 mb-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($ctg_carne as $car)
                    @if ($car['ctg_tipo_carnes_id'] == $tipo_modal)
                        @if (!in_array($car['id'], $check_edit))
                            <div x-data="{ inputEnabled: false }">
                                <div class="flex items-center">

                                    <input type="checkbox" x-model="inputEnabled"
                                        wire:model="selectedItems.{{ $car['id'] }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-2" />
                                    <x-label class="mr-2">{{ $car['name'] }}</x-label>
                                </div>

                                <div class="flex items-center" x-show="inputEnabled">
                                    <x-input type="number" wire:model="GramageItems.{{ $car['id'] }}"
                                        class="w-full bg-white mt-2" />

                                    &nbsp;
                                    <select class="form-control bg-white mt-2"
                                        wire:model="GramageItemsCtg.{{ $car['id'] }}">
                                        <option value="" selected>Gramaje:</option>

                                        @foreach ($grammages as $grammage)
                                            @if ($grammage['id'] == 1 || $grammage['id'] == 4)
                                                <option value="{{ $grammage['id'] }}">{{ $grammage['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center" x-show="inputEnabled">

                                    <x-input-error for="GramageItems.{{ $car['id'] }}" />

                                    &nbsp;

                                    <x-input-error for="GramageItemsCtg.{{ $car['id'] }}" />

                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>


        @endslot
        @slot('footer')
            <x-danger-button wire:click="$dispatch('confirm',{{ $edit ? 3 : 1 }})">GUARDAR</x-danger-button> &nbsp;
            <x-secondary-button wire:click="closeModal">CANCELAR</x-secondary-button>
        @endslot
    </x-dialog-modal-xl>

    {{-- editar --}}
    <x-dialog-modal-xl wire:model.live="openEdit">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>EDITAR ENTRADA DE CARNE DE {{ Str::upper($nombre_modal) }}</h1>
            </div>
        @endslot
        @slot('content')

            <div class="flex items-center">
                <x-input type="number" wire:model='form.total' class="w-full bg-white mt-2" />

                &nbsp;
                <select class="form-control bg-white mt-2" wire:model="form.gramaje_total">
                    <option value="" selected>Gramaje:</option>

                    @foreach ($grammages as $grammage)
                        @if ($grammage['id'] == 1 || $grammage['id'] == 4)
                            <option value="{{ $grammage['id'] }}" selected>{{ $grammage['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">

                <x-input-error for="GramageItems.{{ $car['id'] }}" />

                &nbsp;

                <x-input-error for="GramageItemsCtg.{{ $car['id'] }}" />

            </div>


        @endslot
        @slot('footer')
            <x-danger-button wire:click="$dispatch('confirm',2)">GUARDAR</x-danger-button> &nbsp;
            <x-secondary-button wire:click="closeModalEdit">CANCELAR</x-secondary-button>
        @endslot
    </x-dialog-modal-xl>


    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {

                @this.on('confirm', (opcion) => {
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: opcion == 1 ? "Los producto y sus gramajes seran guardado" :
                            "El gramaje sera actualizado",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {


                        if (opcion == 1) {
                            @this.dispatch('save-carnes');
                        } else if (opcion == 2) {
                            @this.dispatch('update-carnes');
                        } else if (opcion == 3) {
                            @this.dispatch('agregar-carnes');
                        }
                    })
                })
                Livewire.on('alert', function(message) {
                    Swal.fire({
                        icon: 'success',
                        title: message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
                Livewire.on('alert-error', function(message) {
                    Swal.fire({
                        icon: 'error',
                        title: "Oops...",
                        text: message,
                        showConfirmButton: false,
                        timer: 2500
                    })
                });

            });
        </script>
    @endpush
</div>
