<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitudPlan;

class ContactoController extends Controller
{
   public function enviar(Request $request)
{
    $data = $request->validate([
        'plan' => 'nullable|string',
        'price' => 'nullable|string',
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'company' => 'nullable|string',
        'comments' => 'nullable|string',
    ]);

    try {
        Mail::to('quinterolevii87@gmail.com')->send(new SolicitudPlan($data));
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}

}
