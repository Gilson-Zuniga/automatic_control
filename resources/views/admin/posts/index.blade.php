<x-layouts.app :title="'Ver Posts | Automatic Control'">

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{route('dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Posts</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <x-button-link href="{{ route('admin.posts.create') }}" color="blue">Nuevo</x-button-link>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($posts as $post)
            <div class="rounded-xl bg-white dark:bg-neutral-900 shadow-md p-4 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-lg font-bold text-indigo-600 dark:text-indigo-400">{{ $post->titulo }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 font-medium">{{ $post->asunto }}</p>
                    <p class="mt-2 text-gray-800 dark:text-gray-100 text-sm line-clamp-3">{{ $post->contenido }}</p>
                </div>

                <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    <p>Publicado por <strong>{{ $post->user?->name ?? 'Sin autor' }}</strong></p>
                    <p>Creado: {{ $post->created_at->format('d M Y') }}</p>
                    <p>Actualizado: {{ $post->updated_at->format('d M Y') }}</p>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <x-button-link href="{{ route('admin.posts.edit', $post) }}" color="yellow" size="sm">
                        Editar
                    </x-button-link>

                    @php
                        $user = auth()->user();
                        $puedeEliminar = $post->user_id === $user->id || $user->hasRole('admin');
                    @endphp

                    @if($puedeEliminar)
                        <form class="confirmar-eliminar" action="{{ route('admin.posts.destroy',$post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" color="red">Eliminar</x-button>               
                        </form>
                    @endif

                </div>

            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                No hay posts registrados aún.
            </div>
        @endforelse
    </div>

</x-layouts.app>
