<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>8M Chirper - Bulos</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .flip-card {
                perspective: 1000px;
                height: 350px;
            }
            .flip-card-inner {
                position: relative;
                width: 100%;
                height: 100%;
                transition: transform 0.6s;
                transform-style: preserve-3d;
            }
            .flip-card.flipped .flip-card-inner {
                transform: rotateY(180deg);
            }
            .flip-card-front, .flip-card-back {
                position: absolute;
                width: 100%;
                height: 100%;
                backface-visibility: hidden;
                border-radius: 0.5rem;
                padding: 1.5rem;
                display: flex;
                flex-direction: column;
            }
            .flip-card-front {
                background-color: white;
            }
            .flip-card-back {
                background-color: white;
                transform: rotateY(180deg);
            }
        </style>
    </head>
    <body class="bg-gray-100 min-h-screen py-8">
        <x-header />
        <div class="max-w-4xl mx-auto px-4">
            <!-- Mensaje de éxito -->
            @if (session('exito'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('exito') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Título -->
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">8M Chirper - Bulos</h1>

            <!-- Formulario para crear un bulo (solo para autenticados) -->
            @auth
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Publicar un Bulo</h2>
                <form method="POST" action="/bulos">
                    @csrf
                    <div class="mb-4">
                        <label for="texto" class="block text-gray-700 font-medium mb-2">Texto del Bulo</label>
                        <textarea
                            id="texto"
                            name="texto"
                            placeholder="Escribe el texto del bulo..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none @error('texto') border-red-500 @enderror"
                            rows="3"
                            maxlength="255"
                            required
                        >{{ old('texto') }}</textarea>
                        @error('texto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="texto_desmentido" class="block text-gray-700 font-medium mb-2">Explicación/Desmentido</label>
                        <textarea
                            id="texto_desmentido"
                            name="texto_desmentido"
                            placeholder="Escribe la explicación/desmentido..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none @error('texto_desmentido') border-red-500 @enderror"
                            rows="3"
                            maxlength="255"
                            required
                        >{{ old('texto_desmentido') }}</textarea>
                        @error('texto_desmentido')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            Publicar Bulo
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-8" role="alert">
                <span class="block sm:inline">
                    Para publicar un bulo, debes <a href="/login" class="underline font-semibold">iniciar sesión</a> o <a href="/register" class="underline font-semibold">registrarte</a>.
                </span>
            </div>
            @endauth

            <!-- Listado de Bulos -->
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Listado de Bulos</h2>
                
                @forelse ($bulos as $bulo)
                    <div class="flip-card" id="card-{{ $bulo->id }}">
                        <div class="flip-card-inner shadow-lg">
                            <!-- Frente: Bulo -->
                            <div class="flip-card-front">
                                <div class="flex-1">
                                    <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">BULO</span>
                                    <p class="text-gray-800 text-xl font-medium mb-4">{{ $bulo->texto }}</p>
                                </div>
                                <div class="mt-auto">
                                    <div class="text-sm text-gray-500 mb-3">
                                        <span>Publicado: {{ $bulo->created_at->format('d/m/Y H:i') }}</span>
                                        @if($bulo->user)
                                            <span class="ml-2">por {{ $bulo->user->name }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Botones de acción (solo para el propietario) -->
                                    @can('update', $bulo)
                                    <div class="flex gap-2 mb-2">
                                        <a href="/bulos/{{ $bulo->id }}/edit" 
                                           class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-lg transition duration-200 text-center">
                                            ✏️ Editar
                                        </a>
                                        <form action="/bulos/{{ $bulo->id }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro de eliminar este bulo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </div>
                                    @endcan
                                    
                                    <button 
                                        onclick="flipCard('card-{{ $bulo->id }}')"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
                                        🔍 Desmentir
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Reverso: Desmentido -->
                            <div class="flip-card-back">
                                <div class="flex-1">
                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">DESMENTIDO</span>
                                    <p class="text-gray-800 text-lg mb-4">{{ $bulo->texto_desmentido }}</p>
                                </div>
                                <div class="mt-auto">
                                    <button 
                                        onclick="flipCard('card-{{ $bulo->id }}')"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
                                        ↩️ Ver Bulo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white shadow-md rounded-lg p-6 text-center text-gray-500">
                        No hay bulos publicados todavía. ¡Sé el primero en publicar uno!
                    </div>
                @endforelse
            </div>
        </div>
        
        <script>
            function flipCard(cardId) {
                const card = document.getElementById(cardId);
                card.classList.toggle('flipped');
            }
        </script>
    </body>
</html>
