<?php

use Illuminate\Http\Request;
use App\Models\Bulo;

class BuloController extends Controller
{
    public function index()
    {
        $bulos = Bulo::with('user')[
            'texto_bulo' => 'required|string|max:255',
            'texto_desmentido' => 'required|string|max:255',
        ];
    }
}