<div >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            {{ __('Compras') }}
        </h2>



    </x-slot>




    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3" x-data="{ activeTab: 'Solicitudes' }">
        {{-- muestro los tabs --}}

        <ul class="flex" role="tablist">

            <li role="presentation" class="mr-2">
                <button @click="activeTab = 'Solicitudes'" 
                    :class="{ 'bg-orange-500': activeTab === 'Solicitudes', 'text-white': activeTab === 'Solicitudes', 'border': activeTab !== 'Solicitudes', 'border-gray-300': activeTab !== 'Solicitudes' }"
                    :style="{
                        'background-color': activeTab === 'Solicitudes' ? '' : 'white',
                        'color': activeTab === 'Solicitudes' ?
                            '' : 'black'
                    }"
                    class="py-2 px-4 rounded-t-md" role="tab" aria-selected="true">Solicitudes</button>
            </li>
            <li role="presentation" class="mr-2">
                <button @click="activeTab = 'Productos'" 
                    :class="{ 'bg-orange-500': activeTab === 'Productos', 'text-white': activeTab === 'Productos', 'border': activeTab !== 'Productos', 'border-gray-300': activeTab !== 'Productos' }"
                    :style="{
                        'background-color': activeTab === 'Productos' ? '' : 'white',
                        'color': activeTab === 'Productos' ?
                            '' : 'black'
                    }"
                    class="py-2 px-4 rounded-t-md" role="tab" aria-selected="true">Productos</button>
            </li>

        </ul>

        {{-- muestro datos dentro de los tabs --}}
        <div x-show="activeTab === 'Solicitudes'" class="py-4 px-0 bg-gray-100">
                <livewire:compras.gestion-solicitudes />

        </div>

        <div x-show="activeTab === 'Productos'" class="py-4 px-0 bg-gray-100">
                <livewire:compras.gestion-productos />
        </div>
    </div>


</div>
