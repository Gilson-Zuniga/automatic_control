<x-layouts.app :title="'Reporte de Facturas de Clientes'">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow dark:bg-zinc-800">
        <h2 class="text-xl font-bold mb-4">Generar Reporte</h2>

        <form action="{{ route('admin.reportes.facturas-clientes.exportar') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Empresa --}}
            <div>
                <label for="empresa_id" class="form-label">Empresa</label>
                <select name="empresa_id" id="empresa_id" class="form-select">
                    <option value="">Todas</option>
                    @foreach($empresas as $id => $nombre)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Fechas --}}
            <div>
                <label for="fecha_inicio" class="form-label">Desde</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" required class="form-input">
            </div>

            <div>
                <label for="fecha_fin" class="form-label">Hasta</label>
                <input type="date" name="fecha_fin" id="fecha_fin" required class="form-input">
            </div>

            {{-- Botón --}}
            <div class="md:col-span-2 flex justify-end mt-4">
                <button type="submit" class="btn btn-primary">Descargar Excel</button>
            </div>
        </form>
    </div>
</x-layouts.app>
