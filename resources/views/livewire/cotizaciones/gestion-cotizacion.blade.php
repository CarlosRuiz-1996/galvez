<div wire:init='loadOrders'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('Cotizaciones') }}
        </h2>



    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5">
            
            <div class=" py-6 px-4 bg-gray-50 flex">
    
                <div class="flex items-center">
                    <span>Mostrar</span>
                    {{-- <select class="form-control" wire:model.live='list'>
                        @foreach ($entrada as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach --}}
                    </select>
                    <span>Entradas</span>
                </div>

                <x-input type="text" placeholder="Busca un cotización" class="w-full ml-4"
                    wire:model.live='form.search' />

                <x-button class="ml-4" wire:click="openModal">Nuevo</x-button>
            </div>

            @if (count($orders))

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
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
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('name')">
                                    CONTACTO
                                @if ($sort == 'name')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('email')">
                                CORREO

                                @if ($sort == 'email')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>

                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('cliente')">
                                CLIENTE
                                @if ($sort == 'cliente')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('rfc')">
                                RFC
                                @if ($sort == 'rfc')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('phone')">
                                TELÉFONO
                                @if ($sort == 'phone')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">DETALLES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @foreach ($orders as $order)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $order->id }}</td>

                                <td class="px-6 py-4">{{ $order->name }}</td>
                                <td class="px-6 py-4">{{ $order->email }}</td>


                                <td class="px-6 py-4">{{ $order->cliente }}</td>
                                <td class="px-6 py-4">{{ $order->rfc }}</td>
                                <td class="px-6 py-4">{{ $order->phone }}</td>    
                                <td>
                                    <button class="btn btn-green mr-2 p-2" wire:click=''>
                                        <i class="fas fa-edit"></i>
                                    </button>                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($orders->hasPages())
                    <div class="px-6 py-3 text-gray-500">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                @if ($readyToLoad)
                    <h1 class="px-6 py-3 text-gray-500 ">No hay datos disponibles</h1>
                @else
                    <!-- Muestra un spinner mientras los datos se cargan -->
                    <div class="flex justify-center items-center h-40">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500">
                        </div>
                    </div>
                @endif
            @endif


        </div>

    </div>


    <x-dialog-modal-xl wire:model.live="open">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Crear Cotización</h1>
            </div>
        @endslot
        @slot('content')
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full  group">
                    <h1 class="text-2xl mt-5 
                    text-gray-900 md:text-lg lg:text-xl">Datos generales</h1>
                    <hr>

                </div>
                <div class="relative z-0 w-full  group"></div>
                <div class="relative z-0 w-full  group">
                    {{-- <x-label>Numero de contrato</x-label> --}}
                    
                    <x-input type="number" value="0" hidden disabled class="w-full bg-gray-200" wire:model='form_cliente.no_contrato' />
                    <x-input-error for="form_cliente.no_contrato" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Nombre del cliente</x-label>
                    <x-input type="text" class="w-full uppercase"  wire:model='form_cliente.cliente' />
                    <x-input-error for="form_cliente.cliente" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Nombre del contacto</x-label>
                    <x-input type="text" class="w-full uppercase" wire:model='form_cliente.name' />
                    <x-input-error for="form_cliente.name" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Numero de telefono</x-label>
                    <x-input type="number" class="w-full" wire:model='form_cliente.phone' />
                    <x-input-error for="form_cliente.phone" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Correo</x-label>
                    <x-input type="text" class="w-full" wire:model='form_cliente.email' />
                    <x-input-error for="form_cliente.email" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>RFC</x-label>
                    <x-input type="text" class="w-full uppercase" wire:model='form_cliente.rfc' />
                    <x-input-error for="form_cliente.rfc" />
                </div>
                <div class="relative z-0 w-full  group">
                    <x-label>Calle y numero</x-label>
                    <x-input type="text" class="w-full uppercase" wire:model='form_cliente.address' />
                    <x-input-error for="form_cliente.address" />
                </div>




            </div>

            <div class="grid grid-cols-3 gap-6 mt-4">

                <div class="col-span-1">
                    <x-label>Código Postal</x-label>
                    <x-input type="number" wire:model='form_cliente.cp' class="w-full" />

                    @if ($form_cliente->cp_invalido != '')
                        <div class=" bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $form->cp_invalido }}</span>
                        </div>
                    @endif
                    <x-input-error for="form_cliente.cp" />
                </div>
                <div class="col-span-1 mt-5" style="">
                    <x-button wire:click='validarCp'>Validar cp</x-button>
                </div>
                <div class="col-span-1"></div>
                <div class="col-span-1">
                    <x-label>Alcaldia/Municipio</x-label>
                    <x-input type="text" disabled wire:model='form_cliente.municipio' class="w-full bg-gray-200" />
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
                            @foreach ($form_cliente->colonias as $cp)
                                <option value="{{ $cp->idcp }}">{{ $cp->colonia }}</option>
                            @endforeach
                        @else
                            <option value="">Esperando...</option>
                        @endif

                    </select>
                    <x-input-error for="form_cliente.cat_cp_id" />

                </div>

            </div>
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
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
            <x-danger-button class="ml-2" wire:click="save">Aceptar</x-danger-button>
        @endslot
    </x-dialog-modal-xl>

</div>
