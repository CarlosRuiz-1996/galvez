<div>

    <button wire:click="openModalPL" 
    class="btn btn-blue">
    <i class="fa fa-plus-square" aria-hidden="true"></i>

    PLATILLOS</button>




    <x-dialog-modal-xl wire:model.live="openPL">
        @slot('title')
            <div class="px-6 py-4 items-center  bg-gray-100 overflow-x-auto shadow-md sm:rounded-lg">
                <h1>Platillos</h1>
            </div>
        @endslot
        @slot('content')
            <div class=" py-6 px-4 bg-gray-100 flex">
                <x-input placeholder="Busca por producto" type="text" class="w-full ml-4"
                    wire:model.live='form.seach_prod' />
                {{-- <x-input placeholder="Busca por categoria" type="text" class="w-full ml-4"
                    wire:model.live='form.seach_cat' /> --}}

                <select name="" id="" class="form-control ml-4" wire:model.live='form.filtra_cat'>
                    @if ($form->filtra_cat)
                        <option value="0">Limpia filtro</option>
                    @elseif($form->filtra_cat == 0)
                        <option value="" selected>Selecciona una categoria</option>
                    @endif
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $form->filtra_cat ? 'selected' : '' }}>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                
            </div>
            <div wire:init='loadFoods'>
                @if (count($foods))
                    <table class="w-full text-sm text-center text-gray-500 mb-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class=""></th>

                                <th scope="col" class="col-1">NOMBRE</th>
                                <th scope="col" class="col-1">PRESENTACIÓN</th>
                                <th scope="col" class="col-1">CATEGORIA</th>
                                <th scope="col" class="col-1">IMAGEN</th>
                                <th scope="col" class="">DESCRIPCIÓN</th>
                                <th scope="col" class="">MAXIMO</th>
                                <th scope="col" class="">MINIMO</th>

                            </tr>
                        </thead>
                        <tbody >

                            @foreach ($foods as $product)
                                <tr class="table-row bg-white border-b text-center hover:bg-gray-50">
                                    <td class="w-1/18">
                                        <div class="flex items-center justify-center">
                                            <input type="checkbox" wire:model="foodsSeleccionados.{{ $product->id }}" value="{{ $product->id }}" id="check-{{ $product->id }}"
                                                onclick="checkear({{ $product->id }})"
                                                class="w-5 h-5 text-blue-600  border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        </div>
                                    </td>


                                    <td class="w-1/12">{{ $product->name }}</td>
                                    <td class="w-1/12">{{ $product->presentation->name }}</td>
                                    <td class="w-1/18">{{ $product->categorie->name }}</td>
                                    <td class="w-1/6">
                                        <img class="p-8 rounded-t-lg h-40" 
                                            @if ($product->image_path) src="{{ asset('storage/' . $product->image_path) }}"
                                            alt="product image"
                                        @else
                                            src="{{ asset('img/producto.png/') }}"
                                            alt="product image" @endif />
                                    </td>
                                    <td class="w-1/4">
                                        <textarea rows="4" id="description-{{ $product->id }}" disabled
                                            wire:model="description.{{ $product->id }}" 
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </td>
                                    <td class="w-1/18">
                                        <div class="col-span-2 sm:col-span-1 ml-2 mr-2">
                                            <input type="number" id="max-{{ $product->id }}" disabled 
                                            wire:model="max.{{ $product->id }}"
                                               
                                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </td>
                                    <td class="w-1/18">
                                        <div class="col-span-2 sm:col-span-1">
                                            <input type="number" id="min-{{ $product->id }}" disabled
                                            wire:model="min.{{ $product->id }}"
                                              
                                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @if ($foods->hasPages())
                        <div class="px-6 py-3 text-gray-500">
                            {{ $foods->links() }}
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
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="closeModalPL">Cancelar</x-secondary-button>
            <x-danger-button wire:click="aceptarSeleccion" class="ml-3">Aceptar</x-danger-button>
        @endslot
    </x-dialog-modal-xl>


    @push('js')
        <script>
            //muevo el dom de los productos checkeados
            // @this.dispatch(productId ? 'update-productos' : 'save-productos'); 

            function checkear(id) {

                var checkbox = document.getElementById('check-' + id);
                var descInput = document.getElementById('description-' + id);
                var maxInput = document.getElementById('max-' + id);
                var minInput = document.getElementById('min-' + id);
                // console.log(checkbox)
                if (checkbox.checked) {
                    // console.log('checkeado')

                    // Habilita el campo min y quita el atributo disabled
                    descInput.removeAttribute('disabled');
                    maxInput.removeAttribute('disabled');
                    minInput.removeAttribute('disabled');
                    // Cambia la clase de fondo del campo 
                    descInput.classList.remove('bg-gray-100');
                    descInput.classList.add('bg-white');
                    maxInput.classList.remove('bg-gray-100');
                    maxInput.classList.add('bg-white');
                    minInput.classList.remove('bg-gray-100');
                    minInput.classList.add('bg-white');

                    // Limpia el valor del campo min
                    // descInput.value = '';
                    // maxInput.value = '';
                    // minInput.value = '';
                } else {
                    console.log('des checkeado')

                    // Deshabilita el campo min y agrega el atributo disabled
                    descInput.setAttribute('disabled', 'disabled');
                    maxInput.setAttribute('disabled', 'disabled');
                    minInput.setAttribute('disabled', 'disabled');

                    // Cambia la clase de fondo del campo min
                    descInput.classList.remove('bg-white');
                    descInput.classList.add('bg-gray-100');
                    maxInput.classList.remove('bg-white');
                    maxInput.classList.add('bg-gray-100');
                    minInput.classList.remove('bg-white');
                    minInput.classList.add('bg-gray-100');
                    // Limpia el valor del campo min
                    descInput.value = '';
                    maxInput.value = '';
                    minInput.value = '';
                }
            }

          
        </script>
    @endpush


</div>
