<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BuloController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $bulos = Bulo::all();
        return view('welcome', compact('bulos'));
    }

    public function store(Request $request)
    {
        $validados = $request->validate([
            'texto' => 'required|string|max:255',
            'texto_desmentido' => 'required|string|max:255',
        ], [
            'texto.required' => 'El texto del bulo es obligatorio.',
            'texto.max' => 'El texto del bulo debe tener 255 caracteres o menos.',
            'texto_desmentido.required' => 'La explicación/desmentido es obligatoria.',
            'texto_desmentido.max' => 'La explicación debe tener 255 caracteres o menos.',
        ]);

        auth()->user()->bulos()->create([
            'texto' => $validados['texto'],
            'texto_desmentido' => $validados['texto_desmentido'],
        ]);

        return redirect('/')->with('exito', '¡Bulo publicado correctamente!');
    }

    public function edit(Bulo $bulo)
    {
        // Verifica si el usuario puede actualizar
        $this->authorize('update', $bulo);

        return view('bulos.edit', compact('bulo'));
    }

    public function update(Request $request, Bulo $bulo)
    {
        $this->authorize('update', $bulo);

        $validados = $request->validate([
            'texto' => 'required|string|max:255',
            'texto_desmentido' => 'required|string|max:255',
        ], [
            'texto.required' => 'El texto del bulo es obligatorio.',
            'texto.max' => 'El texto del bulo debe tener 255 caracteres o menos.',
            'texto_desmentido.required' => 'La explicación/desmentido es obligatoria.',
            'texto_desmentido.max' => 'La explicación debe tener 255 caracteres o menos.',
        ]);

        $bulo->update([
            'texto' => $validados['texto'],
            'texto_desmentido' => $validados['texto_desmentido'],
        ]);

        return redirect('/')->with('exito', '¡Bulo actualizado correctamente!');
    }

    public function destroy(Bulo $bulo)
    {
        $this->authorize('delete', $bulo);

        $bulo->delete();
        return redirect('/')->with('exito', '¡Bulo eliminado correctamente!');
    }
}

