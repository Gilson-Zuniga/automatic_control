<x-layouts.app :title="'Ver Posts | Automatic Control'"> 

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{route('dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item >Posts</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <x-button-link href="{{ route('admin.posts.create') }}" color="blue">Nuevo</x-button-link>
    </div>
    <div class="card mt-8">
        
        <table id="tabla-posts" class="display table datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Asunto</th>
                    <th>Contenido</th>
                    <th>Usuario</th>
                    <th>Creacion</th>
                    <th>Modificado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->titulo }}</td>
                        <td>{{ $post->asunto }}</td>
                        <td>{{ $post->contenido }}</td>
                        <td>{{ $post->user?->name ?? 'Sin autor' }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td width="">
                            <div class="flex justify-end gap-2">
                                <x-button-link href="{{ route('admin.posts.edit', $post) }}" color="yellow">
                                    Editar
                                </x-button-link>
                                <form class="confirmar-eliminar" action="{{ route('admin.posts.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" color="red">Eliminar</x-button>               
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