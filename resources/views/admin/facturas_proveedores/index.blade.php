<x-layouts.app :title="'Ver Facturas Proveedores'"> 

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>

            <flux:breadcrumbs.item href="{{route('dashboard')}}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item >Facturas Proveedores</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <a href="{{ route('admin.facturas_proveedores.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-xs">
            Nuevo
        </a>

    </div>
    <div class="card mt-8">
        
        
        <table id="tabla-facturas_proveedores" class="display table datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ID Factura</th>
                    <th>Proveedor</th>
                    <th>Tienda</th>
                    <th>Fecha Pago</th>
                    <th>Total</th>
                    <th>Factura PDF</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>{{ $factura->numero_factura }}</td>
                        <td>{{ $factura->$proveedor->nombre }}</td>
                        <td>{{ $factura->$empresa->nombre }}</td>
                        <td>{{ $factura->fecha_pago }}</td>
                        <td>{{ $factura->total }}</td>
                        <td>{{ $factura->pdf_path }}</td>
                        <td width="">
                            <div class="flex justify-end gap-2">
                            <x-button-link href="#" color="green">
                                    Pagar
                                </x-button-link>
                                <form class="confirmar-eliminar" action="{{ route('admin.proveedores.destroy',$proveedor->id)}}" method="POST">
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