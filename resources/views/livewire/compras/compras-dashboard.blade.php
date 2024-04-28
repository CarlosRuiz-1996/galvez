<div>
   
    
        <!-- Barra de navegación -->
      
    
        <!-- Contenido principal -->
        <div class="container mx-auto mt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card 1 -->
                <div class="bg-white p-4 shadow-md rounded-md">
                    <h2 class="text-lg font-semibold mb-2">Gasto del dia</h2>
                    <p class="text-gray-700">Total: ${{$gasto}} </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-4 shadow-md rounded-md">
                    <h2 class="text-lg font-semibold mb-2">Productos ingresados hoy</h2>
                    <p class="text-gray-700">Total: {{$productos_hoy}}</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-4 shadow-md rounded-md">
                    <h2 class="text-lg font-semibold mb-2">Pedidos del dia</h2>
                    <p class="text-gray-700">Total: {{$solicitudes_hoy}}</p>
                </div>
                <!-- Card 4 -->
                {{-- <div class="bg-white p-4 shadow-md rounded-md">
                    <h2 class="text-lg font-semibold mb-2">Ventas</h2>
                    <p class="text-gray-700">Total: $5000</p>
                </div> --}}
            </div>
        </div>
    
  
       
</div>
