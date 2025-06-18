<x-layouts.app :title="__('Dashboard')">

        {{-- Notificaciones de actividades --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mt-6">
        <div class="rounded-xl bg-white dark:bg-neutral-900 p-4 shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Ventas Hoy</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($totalVentasHoy, 2) }}</p>
            </div>
            <svg class="w-8 h-8 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3h14a1 1 0 011 1v4H2V4a1 1 0 011-1zm0 6h16v7a1 1 0 01-1 1H3a1 1 0 01-1-1V9zm3 2a1 1 0 100 2 1 1 0 000-2z"/></svg>
        </div>

        <div class="rounded-xl bg-white dark:bg-neutral-900 p-4 shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Facturas</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalFacturas }}</p>
            </div>
            <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a7 7 0 00-7 7v2a7 7 0 0014 0V9a7 7 0 00-7-7zm3.707 6.293a1 1 0 00-1.414 0L9 10.586 8.707 10.293a1 1 0 10-1.414 1.414l1 1a1 1 0 001.414 0l3-3a1 1 0 000-1.414z"/></svg>
        </div>

        <div class="rounded-xl bg-white dark:bg-neutral-900 p-4 shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Inventario</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalInventario }}</p>
            </div>
            <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h1v6a2 2 0 002 2h4a2 2 0 002-2v-6h1a2 2 0 002-2V5a2 2 0 00-2-2H5z"/></svg>
        </div>

        <div class="rounded-xl bg-white dark:bg-neutral-900 p-4 shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Productos Registrados</p>
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalProductos }}</p>
            </div>
            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a1 1 0 000 2h1v11a2 2 0 002 2h6a2 2 0 002-2V5h1a1 1 0 100-2H4z"/></svg>
        </div>
    </div>

        {{-- Alertas de productos bajos --}}
    @if($productosBajos->count())
        <div class="mt-8 p-4 bg-red-50 dark:bg-red-900/40 border border-red-300 dark:border-red-700 rounded-xl shadow-sm">
            <h2 class="text-lg font-semibold text-red-800 dark:text-red-200">⚠ Productos con bajo inventario</h2>
            <ul class="list-disc pl-5 mt-2 text-red-700 dark:text-red-300 space-y-1">
                @foreach($productosBajos as $producto)
                    <li>
                        <span class="font-medium">{{ $producto->nombre }}</span>: solo quedan <strong>{{ $producto->cantidad }}</strong> unidades.
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


        
 





    @php
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $labelsMeses = $ventasPorMes->pluck('mes')->map(fn($m) => $meses[$m - 1]);
        $totalesMeses = $ventasPorMes->pluck('total');

        $labelsProductos = $productosMasVendidos->map(fn($item) => optional($item->inventario)->nombre ?? 'Desconocido');
        $cantidadVendida = $productosMasVendidos->pluck('total_vendida');
    @endphp

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-6">
        {{-- Gráfico de ventas mensuales --}}
        <div class="rounded-xl bg-white p-4 shadow-md dark:bg-neutral-900 dark:text-white">
            <h2 class="mb-2 text-lg font-semibold">Ventas Mensuales</h2>
            <canvas id="ventasChart" height="100"></canvas>
        </div>

        {{-- Gráfico de productos más vendidos --}}
        <div class="rounded-xl bg-white p-4 shadow-md dark:bg-neutral-900 dark:text-white">
            <h2 class="mb-2 text-lg font-semibold">Productos Más Vendidos</h2>
            <canvas id="productosChart" height="100"></canvas>
        </div>
    </div>
    <div class="mt-8 bg-white dark:bg-neutral-900 rounded-xl shadow-md overflow-hidden">
    <div class="p-4 border-b border-gray-200 dark:border-neutral-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">🧾 Últimas Facturas Generadas</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-neutral-300">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Cliente</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Fecha</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-900 divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($ultimasFacturas as $factura)
                    <tr>
                        <td class="px-4 py-2">{{ $factura->id }}</td>
                        <td class="px-4 py-2">{{ $factura->cliente_nombre ?? 'Cliente N/D' }}</td>
                        <td class="px-4 py-2 font-semibold">${{ number_format($factura->total, 2) }}</td>
                        <td class="px-4 py-2">{{ $factura->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function isDarkMode() {
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        const labelColor = isDarkMode() ? '#fff' : '#000';
        const gridColor = isDarkMode() ? '#444' : '#ccc';

        // Gráfico de ventas por mes
        new Chart(document.getElementById('ventasChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelsMeses) !!},
                datasets: [{
                    label: 'Ventas ($)',
                    data: {!! json_encode($totalesMeses) !!},
                    backgroundColor: '#4f46e5',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { ticks: { color: labelColor }, grid: { color: gridColor } },
                    y: { beginAtZero: true, ticks: { color: labelColor }, grid: { color: gridColor } }
                }
            }
        });

        // Gráfico de productos más vendidos
        new Chart(document.getElementById('productosChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($labelsProductos) !!},
                datasets: [{
                    label: 'Cantidad vendida',
                    data: {!! json_encode($cantidadVendida) !!},
                    backgroundColor: ['#4f46e5','#10b981','#f59e0b','#ef4444','#6366f1']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: { color: labelColor }
                    }
                }
            }
        });
    </script>
</x-layouts.app>
