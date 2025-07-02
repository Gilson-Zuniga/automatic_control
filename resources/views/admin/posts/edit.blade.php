<x-layouts.app :title="'Editar Post | Automatic Control'">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.posts.index')">posts</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="max-w-5xl mx-auto p-6 bg-white rounded shadow dark:bg-zinc-800">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Titulo --}}
                <x-input-text
                    name="titulo"
                    label="Titulo"
                    :value="$post->titulo"
                    required
                />

                {{-- asunto --}}
                <x-input-text
                    name="asunto"
                    label="Asunto"
                    :value="$post->asunto"
                    required
                />





                {{-- Descripción --}}
                <div class="md:col-span-2">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea
                        name="descripcion"
                        id="descripcion"
                        rows="4"
                        class="form-input w-full"
                    >{{ old('descripcion', $post->descripcion) }}</textarea>
                    @error('descripcion') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-2 mt-4">
                <x-button-link href="{{ route('admin.posts.index') }}">Cancelar</x-button-link>
                <x-button type="submit" >Actualizar</x-button>
            </div>
        </form>
    </div>

</x-layouts.app>
