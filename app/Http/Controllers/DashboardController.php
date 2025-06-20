<?php
namespace App\Http\Controllers;

use App\Models\FacturaCliente;
use App\Models\FacturaClienteItem;
use App\Models\Inventario;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ventas agrupadas por mes
        $ventasPorMes = FacturaCliente::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('SUM(total) as total')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Productos con bajo inventario
        $productosBajos = Inventario::where('cantidad', '<', 5)->get();

        // Productos más vendidos
        $productosMasVendidos = FacturaClienteItem::select('producto_id', DB::raw('SUM(cantidad) as total_vendida'))
            ->groupBy('producto_id')
            ->orderByDesc('total_vendida')
            ->take(5)
            ->with('inventario')
            ->get();
        
        $totalVentasHoy = FacturaCliente::whereDate('created_at', today())->sum('total');
        $totalVentasSemana = FacturaCliente::whereBetween('created_at', [
            Carbon::now()->startOfWeek(), // lunes a las 00:00
            Carbon::now()->endOfWeek(),   // domingo a las 23:59
        ])->sum('total');
        $totalFacturas = FacturaCliente::count();
        $totalInventario = Inventario::sum('cantidad');
        $totalProductos = Inventario::count();
        $totalUsuarios = User::count();
        $ultimasFacturas = FacturaCliente::with('cliente')->latest()->take(5)->get();

        $totalUsuarios = User::count();

        $usuariosHoy = DB::table('users')
            ->whereDate('last_login_at', Carbon::today())
            ->count();

        $posts = Post::with('user')->latest()->take(5)->get(); // últimos 5
        

        return view('dashboard', compact(
            'ventasPorMes',
            'productosBajos',
            'productosMasVendidos',
            'totalVentasSemana',
            'totalVentasHoy',
            'totalFacturas',
            'totalInventario',
            'totalProductos',
            'ultimasFacturas',
            'totalUsuarios',
            'posts'

));

    }
}
