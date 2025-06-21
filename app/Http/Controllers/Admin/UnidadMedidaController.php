<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidadMedidas = UnidadMEdida::all();

        return view('admin.unidades_medidas.index', compact ('unidadMedidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unidades_medidas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'prefijo' => 'required|string|max:6',
        ]);

        UnidadMedida::create([
            'nombre' => $data['nombre'],
            'prefijo' => $data['prefijo']
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Muy bien !',
            'text' => 'Se ha registado una nueva unidad de medida con éxito'
        ]);

        return redirect()->route('admin.unidades_medidas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnidadMedida $unidadMedida)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnidadMedida $unidadMedida)
    {
        return view('admin.unidades_medidas.edit', compact('unidadMedida'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnidadMedida $unidadMedida)
    {
        $data = $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'prefijo' => 'required|string|max:6|'
        ]);

        $unidadMedida->update([
            'nombre' => $data['nombre'],
            'prefijo' => $data['prefijo']
]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Actualizado !',
            'text' => 'Se ha actualizado la unidad de medida con éxito'
        ]);

        return redirect()->route('admin.unidades_medidas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnidadMedida $unidadMedida)
    {
        $unidadMedida->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Eliminado !',
            'text' => 'Se ha eliminado la unidad de medida con éxito'
        ]);

        return redirect()->route('admin.unidades_medidas.index');
    }
}
