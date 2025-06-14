<x-layouts.app :title="'Crear Factura Proveedor'">
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.facturas_proveedores.index')">Facturas Proveedor</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Crear</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form method="POST" action="{{ route('admin.facturas_proveedores.store') }}" id="form-factura">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <x-form.input name="numero_factura" label="Número de Factura" required />
            <x-form.input name="fecha_pago" label="Fecha de Pago" type="date" required />
            <x-form.select name="proveedor_id" label="Proveedor" :options="$proveedores->pluck('nombre', 'id')" required />
            <x-form.select name="empresa_id" label="Empresa" :options="$empresas->pluck('nombre', 'id')" required />
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <h3 class="text-lg font-bold mb-2">Ítems de Factura</h3>
            <x-button type="submit" color="blue">Agregar</x-button>
            <div id="items-container" class="space-y-4"></div>
        </div>

        <input type="hidden" name="items_json" id="items-json">

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">Guardar Factura</button>
        </div>
    </form>
@include('components.scripts.factura-crear')
</x-layouts.app>
