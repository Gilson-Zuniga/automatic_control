<x-layouts.app :title="'Registrar Usuario | StockPro'">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.registro_usuario.index')">Usuarios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow dark:bg-zinc-800">
        <form method="POST" action="{{ route('admin.proveedores.store') }}">
            @csrf




            {{-- ID --}}
            <x-input-text
                name="id"
                label="ID"
                required
                placeholder="Ingrese el ID del usuario"
            />
            
            {{-- Nombre --}}
            <x-input-text
                name="nombre"
                label="Nombre"
                required
            />


            {{-- Email --}}
            <x-input-text
                name="email"
                label="Email"
                type="email"
                required
            />

            {{-- Teléfono --}}
            <x-input-text
                name="telefono"
                label="Teléfono"
                required
            />

            <!-- Botones -->
            <div class="flex justify-end space-x-2 mt-4">
                <x-button-link href="{{ route('admin.registro_usuario.index') }}" >Cancelar</x-button-link>
                <x-button type="submit">Crear</x-button>             
            </div>
        </form>
    </div>
    
    @include('components.scripts.datatable-delete')
</x-layouts.app>
