<x-layouts.app :title="'Registrar Producto | Automatic Control'">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.productos.index')">Productos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="max-w-5xl mx-auto p-6 bg-white rounded shadow dark:bg-zinc-800 ">
        <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nombre --}}
                <x-input-text
                    name="nombre"
                    label="Nombre"
                    required
                />

                {{-- Precio --}}
                <x-input-text
                    name="precio"
                    label="Precio ($)"
                    type="number"
                    step="0.01"
                    required
                />

                {{-- Descuento --}}
                <x-input-text
                    name="descuento"
                    label="Descuento (%)"
                    type="number"
                    step="0.01"
                />

                {{-- Proveedor --}}
                <x-input-select
                    name="proveedor_id"
                    label="Proveedor"
                    :options="$proveedores->pluck('nombre', 'id')"
                    required
                />

                {{-- Categoría --}}
                <x-input-select
                    name="categoria_id"
                    label="Categoría"
                    :options="$categorias->pluck('nombre', 'id')"
                    required
                />

                {{-- Tipo de Artículo --}}
                <x-input-select
                    name="tipo_articulos_id"
                    label="Tipo de Artículo"
                    :options="$tipoArticulos->pluck('nombre', 'id')"
                    required
                />

                {{-- Unidad de Medida --}}
                <x-input-select
                    name="unidad_medida_id"
                    label="Unidad de Medida"
                    :options="$unidadMedidas->pluck('nombre', 'id')"
                    required
                />

                {{-- Foto (archivo) --}}
                <div>
                    <label for="foto" class="form-label">Foto</label>
                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-input"
                        accept="image/*"
                    >
                    @error('foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Foto URL --}}
                <x-input-text
                    name="foto_url"
                    label="Foto URL"
                    type="url"
                />

                {{-- Descripción --}}
                <div class="md:col-span-2">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea
                        name="descripcion"
                        id="descripcion"
                        rows="4"
                        class="form-input"
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-2 mt-4">
                <x-button-link href="{{ route('admin.productos.index') }}" color="red">Cancelar</x-button-link>
                <x-button type="submit" color="blue">Crear</x-button>             
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
        <script>
            $('#proveedor_id, #categoria_id, #tipo_articulos_id, #unidad_medida_id').select2({
                width: '100%',
                placeholder: 'Seleccione una opción',
                allowClear: true
            });
        </script>
    @endpush

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
</x-layouts.app>
