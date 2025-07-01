<x-layouts.app :title="'Reporte de Facturas de Clientes'">
    <div class="max-w-full mx-auto bg-black-800  rounded shadow dark:bg-white-800  mb-4 ">
        <h2 class="text-xl font-bold mb-4">Generar Reporte</h2>

        <form action="{{ route('admin.reportes.facturas_clientes.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
            {{-- Empresa --}}
            <div>
                <label for="empresa_id" class="form-label">Empresa</label>
                <select name="empresa_id" id="empresa_id" class="form-input">
                    <option value="">Todas</option>
                    @foreach($empresas as $id => $nombre)
                        <option value="{{ $id }}" {{ request('empresa_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Fechas --}}
            <x-form.input name="fecha_inicio" label="Fecha de Pago" type="date" required />

            <x-form.input name="fecha_fin" label="Fecha de Pago" type="date" required />

            {{-- Botones --}}
            <div class="md:col-span-2 flex justify-between mt-4">
                <x-button type="submit">Buscar</x-button>

                @if(request('fecha_inicio') && request('fecha_fin'))
                
                    <x-button-link href="{{ route('admin.reportes.facturas_clientes.exportar', request()->all()) }}" >
                    Descarga Excel
                </x-button-link>
                @endif
            </div>
        </form>
    </div>

    {{-- Resultados --}}
    @if(isset($facturas) && $facturas->count())

        <h3 class="text-lg font-semibold mb-4">Resultados</h3>
        <div class="card mt-8 overflow-x-auto w-full min-w-full table-auto">
            
            <table id="tabla-reportes_facturas_clientes" class="display table datatable">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Cliente</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Empresa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $factura)
                        <tr>
                            <td class="px-4 py-2">{{ $factura->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">{{ $factura->cliente->name ?? '-' }}</td>
                            <td class="px-4 py-2">${{ number_format($factura->total, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $factura->empresa->nombre ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif(request()->all())
        <div class="text-center mt-8 text-gray-600 dark:text-gray-300">
            No se encontraron facturas con los criterios seleccionados.
        </div>
    @endif
    @include('components.scripts.datatable-delete')
</x-layouts.app>
