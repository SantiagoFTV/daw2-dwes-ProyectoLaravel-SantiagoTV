<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulo;

class BuloController extends Controller
{
    public function index()
    {
        $bulos = Bulo::with('user')->latest()->get();
        
        return view('bulo8M', ['bulos' => $bulos]);
    }
}