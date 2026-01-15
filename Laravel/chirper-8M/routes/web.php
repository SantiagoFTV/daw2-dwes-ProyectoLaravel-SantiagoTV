<?php

use App\Http\Controllers\ControladorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ControladorController::class, 'index']);
