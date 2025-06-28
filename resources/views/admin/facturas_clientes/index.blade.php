<x-layouts.app :title="'Ver Facturas Clientes | Automatic Control'"> 

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>

            <flux:breadcrumbs.item href="{{route('dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item >Facturas Clientes</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <x-button-crear href="{{ route('admin.facturas_clientes.create') }}" >Nuevo</x-button-crear>
    </div>
    
    <div class="card mt-8 overflow-x-auto w-full">
        <table id="tabla-facturas_clientes" class="display table datatable min-w-full table-auto">
            <thead>
                <tr>
                <th>ID</th>
                <th>ID Factura</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>PDF</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>{{ $factura->numero_factura }}</td>
                        <td>{{ $factura->cliente->name ?? 'N/A'  }}</td>
                        <td>{{ $factura->empresa->nombre ?? 'N/A' }}</td>
                        <td>{{ $factura->created_at }}</td>
                        <td>${{ number_format($factura->total, 2, ',', '.') }}</td>
                        <td>
                            @if($factura->pdf_path)
                                <a href="{{ asset($factura->pdf_path) }}" target="_blank" class="inline-block px-2 py-1 bg-gray-600 text-white text-xs rounded hover:bg-gray-700">
                                    Ver PDF
                                </a>
                            @else
                                <span class="text-gray-500 text-xs">Sin archivo</span>
                            @endif
                        </td>

                        <td width="">
                            <div class="flex justify-end gap-2">
                            <x-button-link href="#" >
                                    Novedades
                                </x-button-link>
                                <form class="confirmar-eliminar" action="{{ route('admin.facturas_clientes.destroy',$factura->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" >
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