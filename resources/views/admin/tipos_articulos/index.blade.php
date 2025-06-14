<x-layouts.app :title="'Ver Tipos de Artículo'">

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Tipos de Artículo</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a href="{{ route('admin.tipos_articulos.create') }}"
           class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-xs">
            Nuevo
        </a>
    </div>

    <div class="card mt-8 ">
        <table id="tabla-tipo-articulos " class="display table datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo de Artículo</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoArticulos as $tipo)
                    <tr>
                        <td>{{ $tipo->id }}</td>
                        <td>{{ $tipo->nombre }}</td>
                        <td>{{ $tipo->categoria->nombre ?? 'Sin categoría' }}</td>
                        <td>
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.tipos_articulos.edit', $tipo) }}"
                                   class="inline-block px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 text-xs">
                                    Editar
                                </a>
                                <form class="confirmar-eliminar" action="{{ route('admin.tipos_articulos.destroy', $tipo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" color="red">
                                        Eliminar
                                    </x-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('components.scripts.datatable-delete')

</x-layouts.app>
