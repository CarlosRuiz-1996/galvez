<div wire:init='loadCatalogos'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 leading-tight inline-flex items-center">
            <a href="{{ route('catalogos') }}" title="ATRAS">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            &nbsp;
            {{ __('Catalogos de ') . $ctg->name }}
        </h2>


    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-4 p-5">

            <div class=" py-6 px-4 bg-gray-50 flex">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="form-control" wire:model.live='list'>
                        @foreach ($entrada as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span>Entradas</span>
                </div>

                <x-input type="text" placeholder="Buscar" class="w-full ml-4" wire:model.live='form.search' />

                <x-button class="ml-4" wire:click="">Nuevo</x-button>
            </div>

            @if (count($catalogos))



                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">

                        <tr>
                            
                            @foreach ($catalogos[0]->getAttributes() as $key => $value)
                                @if (
                                    !in_array($key, [
                                        'status',
                                        'created_at',
                                        'updated_at',
                                        'incrementing',
                                        'preventsLazyLoading',
                                        'exists',
                                        'wasRecentlyCreated',
                                        'timestamps',
                                        'usesUniqueIds',
                                    ]))
                                    <?php $columna; ?>
                                    @if ($key == 'name')
                                        <?php $columna = 'nombre'; ?>
                                    @elseif($key == 'image_path')
                                        <?php $columna = 'imagen'; $imagen_existe = true; ?>
                                    @else
                                        <?php $columna = $key; ?>
                                    @endif
                                    <th scope="col" class="px-6 py-3 cursor-pointer"
                                        wire:click="order('{{ $key }}')">{{ $columna }}
                                        @if ($sort == '{{ $key }}')
                                            @if ($orderBy == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right hover:float-left mt-1"></i>
                                        @endif
                                    </th>
                                @endif
                            @endforeach

                            <th scope="col" class="px-6 py-3">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @foreach ($catalogos as $catalogo)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $catalogo->id }}</td>

                                <td class="px-6 py-4">{{ $catalogo->name }}</td>
                                @if ($imagen_existe)
                                    <td class="px-6 py-4">{{ $catalogo->image_path }}</td>
                                @endif
                               
                                <td>
                                    <button class="btn btn-green mr-2 p-2" wire:click=''>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($catalogos->hasPages())
                    <div class="px-6 py-3 text-gray-500">
                        {{ $catalogos->links() }}
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


</div>
