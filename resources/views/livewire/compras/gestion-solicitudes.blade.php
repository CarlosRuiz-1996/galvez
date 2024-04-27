<div wire:init='loadSolicitudes'>




    @if (count($solicitudes))

        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">ID PRODUCTO</th>
                    <th scope="col" class="px-6 py-3">PRODUCTO</th>
                    <th scope="col" class="px-6 py-3">CANTIDAD SOLICITADA</th>
                    <th scope="col" class="px-6 py-3">URGENCIA</th>
                    <th scope="col" class="px-6 py-3">NOTAS</th>
                    <th scope="col" class="px-6 py-3">FECHA</th>
                    <th scope="col" class="px-6 py-3">SOLICITO</th>
                    <th scope="col" class="px-6 py-3">DETALLES</th>
                </tr>
            </thead>
            <tbody class="text-center">

                @foreach ($solicitudes as $solicitud)
                    <tr
                        class="table-row  border-b 
                            {{ $solicitud->urgencia == '0' ? 'bg-red-200 hover:bg-red-50' : 'bg-white hover:bg-gray-50' }}">

                        <td class="px-6 py-4">{{ $solicitud->producto->id }}</td>
                        <td class="px-6 py-4">{{ $solicitud->producto->name }}</td>
                        <td class="px-6 py-4">{{ $solicitud->total_cantidad }}</td>
                        <td class="px-6 py-4">{{ $solicitud->urgencia == 0 ? 'ALTA' : 'MODERADA' }}</td>

                        <td class="px-6 py-4">{{ $solicitud->mensaje }}</td>
                        <td class="px-6 py-4">{{ $solicitud->created_at }}</td>
                        <td class="px-6 py-4">{{ $solicitud->user->name . ' ' . $solicitud->user->paterno }}</td>
                        <td>
                            <button class="btn btn-green mr-2 p-2" wire:click='openModal({{$solicitud->producto->id}},{{$solicitud->total_cantidad}})'>
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @if ($solicitudes->hasPages())
            <div class="px-6 py-3 text-gray-500">
                {{ $solicitudes->links() }}
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


    <x-dialog-modal-xl wire:model.live="open" wire:ignore.self>
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1> Atender solicitud</h1>
            </div>
        @endslot
        @slot('content')


            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2 ">
                    <x-label>Nombre del producto</x-label>
                    <x-input type="text" class="w-full text-gray-900 bg-gray-100" readonly wire:model='form.name' />
                </div>
                <div class="col-span-2 ">
                    <x-label>Cantidad solicitada</x-label>
                    <x-input type="number" class="w-full text-gray-900 bg-green-100" readonly wire:model='cantidad' />
                </div>
                <div class="col-span-2 ">
                    <x-label>Gramaje</x-label>
                    <x-input type="text" class="w-full text-gray-900 bg-gray-100" readonly wire:model='form.gramaje' />
                </div>
                <div class="col-span-2 ">
                    <x-label>Presentación</x-label>
                    <x-input type="text" class="w-full text-gray-900 bg-gray-100" readonly wire:model='form.ctg_presentation_id' />
                </div>
                <div class="col-span-2 ">
                    <x-label>Marca</x-label>
                    <x-input type="text" class="w-full text-gray-900 bg-gray-100" readonly wire:model='form.ctg_brand_id' />
                </div>
                <div class="col-span-2 ">
                    <x-label>Categoria</x-label>
                    <x-input type="text" class="w-full text-gray-900 bg-gray-100" readonly wire:model='form.ctg_category_id' />
                </div>
                <div>
                    <x-label>Cantidad/stock ingresada</x-label>
                    <x-input type="number" class="w-full" wire:model.live='form.stock' />
                    <x-input-error for="form.stock" />
                </div>

                <div>
                    <x-label>Costo/Precio</x-label>
                    <x-input type="number" class="w-full" wire:model.live='form.price' />
                    <x-input-error for="form.price" />
                </div>
                <div class="col-span-2 ">


                    <x-label>Total de la compra</x-label>
                    <x-input type="number" class="w-full text-gray-900 bg-green-100" wire:model.live='form.total' readonly />
                </div>
                


            </div>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModal">Cancelar</x-secondary-button>
            <x-danger-button wire:click="$dispatch('confirm-resolver') "
                class=" ml-3 disabled:opacity-25">ACEPTAR</x-danger-button>
        @endslot
    </x-dialog-modal-xl>

    @push('js')
        <script>
            document.addEventListener('livewire:initialized', () => {

                @this.on('confirm-resolver', () => {

                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "El stock del producto sera actualizado",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, adelante!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            @this.dispatch('resolver-solicitud');

                        }
                    })
                })
                Livewire.on('alert', function([message]) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: message[1],
                        title: message[0],
                        showConfirmButton: false,
                        timer: 1500
                    })
                });

            });
        </script>
    @endpush

</div>
