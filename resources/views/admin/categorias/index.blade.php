<x-layouts.app :title="'Ver Categorías'"> 

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>

            <flux:breadcrumbs.item href="{{route('dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item >Categorias</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a href="{{ route('admin.categorias.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-xs">
            Nuevo
        </a>

    </div>
    <div class="card mt-8">
        
        
        <table id="tabla-categorias" class="display table datatable ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td width="">
                            <div class="flex justify-end gap-2">
                                <x-button-link href="{{ route('admin.categorias.edit', $categoria) }}" color="yellow">
                                    Editar
                                </x-button-link>

                                <form class="confirmar-eliminar" action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST">
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