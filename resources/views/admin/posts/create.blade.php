<x-layouts.app :title="'Nuevo Post'">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4">
        @csrf

        <x-input label="Título" name="titulo" required minlength="10" maxlength="30" />

        <x-input label="Asunto" name="asunto" required minlength="3" maxlength="100" />

        <x-textarea label="Contenido" name="contenido" required minlength="3" maxlength="200" />

        <x-button type="submit" icon="paper-airplane">
            Publicar Post
        </x-button>
    </form>
</x-layouts.app>
