<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Illuminate\Http\Request;

class ControladorController extends Controller
{
    public function index(){

        $memes = Meme::with('user')->latest('fecha_subida')->limit(2)->get();

        return view('feed', ['memes' => $memes]);

    }
}
