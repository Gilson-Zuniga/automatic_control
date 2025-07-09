<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Empresa;

class DetectarEmpresaPorSubdominio
{
    public function handle($request, Closure $next)
    {
        $subdominio = explode('.', $request->getHost())[0];

        $empresa = Empresa::where('subdominio', $subdominio)->first();

        if (!$empresa) {
            abort(404, 'Empresa no encontrada');
        }

        // Guardamos la empresa para usarla más adelante
        app()->instance(Empresa::class, $empresa);

        return $next($request);
    }
}

