    {{-- Because she competes with no one, no one can compete with her. --}}
    <div wire:init='loadUsers'>
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
    
            <div class="mt-4 p-5">
                <x-alert />
    
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
    
                    <x-input type="text" placeholder="Busca un producto" class="w-full ml-4"
                        wire:model.live='form.search' />
    
                    <x-button class="ml-4" wire:click="create">Nuevo</x-button>
                </div>
                
                @if (count($users))

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                                NOMBRE
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
                            <th scope="col" class="w-40 px-6 py-3 cursor-pointer"
                                wire:click="order('ctg_presentation_id')">EMAIL

                                @if ($sort == 'ctg_presentation_id')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="w-40 px-6 py-3 cursor-pointer" wire:click="order('ctg_grammage_id')">
                                DIRECCION
                                @if ($sort == 'ctg_grammage_id')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif

                            </th>
                            <th scope="col" class="px-6 py-3">CLIENTE</th>
                                @if ($sort == 'description')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">RFC</th>
                                @if ($sort == 'description')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">TÉLEFONO</th>
                                @if ($sort == 'description')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">CONTRATO</th>
                                @if ($sort == 'description')
                                    @if ($orderBy == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right hover:float-left mt-1"></i>

                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3">EDITAR</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr class="table-row bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $user->id }}</td>

                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ $user->address }}</td>
                                <td class="px-6 py-4">

                                    {{ $user->cliente }}
                                </td>

                                <td class="px-6 py-4">{{ $user->rfc }}</td>
                                <td class="px-6 py-4">{{ $user->phone }}</td>
                                <td class="px-6 py-4">{{ $user->no_contrato }}</td>

                                <td class="text-center">
                                    <button class="btn btn-green mr-2 p-2" wire:click='edit({{ $user }})'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($users->hasPages())
                    <div class="px-6 py-3 text-gray-500">
                        {{ $users->links() }}
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
