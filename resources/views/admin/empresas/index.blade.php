<x-layouts.app :title="'Ver Empresa'"> 

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>

            <flux:breadcrumbs.item href="{{route('dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item >Empresa</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a href="{{ route('admin.empresas.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-xs">
            Nuevo
        </a>

    </div>
    <div class="card mt-8">
        
        
        <table id="tabla-empresas" class="display table datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nit</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Direccion</th>
                    <th>Ubicacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->id }}</td>
                        <td>{{ $empresa->nit }}</td>
                        <td>{{ $empresa->nombre }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->email }}</td>
                        <td>{{ $empresa->direccion }}</td>
                        <td>{{ $empresa->ubicacion }}</td>
                        <td width="">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.empresas.edit',$empresa) }}"
                                class="inline-block px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 text-xs ">
                                    Editar
                                </a>
                                <form class="confirmar-eliminar" action="{{ route('admin.empresas.destroy',$empresa->id)}}" method="POST">
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