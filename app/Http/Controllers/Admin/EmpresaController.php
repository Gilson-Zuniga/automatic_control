<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('admin.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'nombre' => 'required|string',
            'nit' => 'required|string|min:10|max:12|unique:empresas,nit',
            'telefono' => 'required|string|min:10|max:10',
            'direccion' => 'required|string',
            'email' => 'required|email|unique:empresas,email',
            'ubicacion' => 'required|string',
        ]);

        Empresa::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Bien crack !',
            'text' => 'Se ha registado su empresa con éxito'
        ]);
        
        return redirect()->route('admin.empresas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        $data = $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'nit' => 'required|string|min:10|max:12|',
            'telefono' => 'required|string|min:10|max:10',
            'email' => 'required|string|max:255|',
            'direccion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255'
            
        ]);

        $empresa->update([
            'nombre' => $data['nombre'],
            'nit' => $data['nit'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'direccion' => $data['direccion'],
            'ubicacion' => $data['ubicacion'],        
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Bien crack !',
            'text' => 'Se ha actualizado los datos del empresa con éxito'
        ]);

        return redirect()->route('admin.empresas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡ Bien crack !',
            'text' => 'Se ha eliminado la empresa con éxito'
        ]);

        return redirect()->route('admin.empresas.index');
    }
}
