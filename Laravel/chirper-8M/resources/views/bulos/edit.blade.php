<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar Bulo - 8M Chirper</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 min-h-screen py-8">
        <x-header />
        <div class="max-w-4xl mx-auto px-4">
            <!-- Título -->
            <div class="mb-6">
                <a href="/" class="text-blue-600 hover:text-blue-800 font-medium">← Volver al inicio</a>
            </div>

            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Editar Bulo</h1>

            <!-- Formulario de edición -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <form method="POST" action="/bulos/{{ $bulo->id }}">
                    @csrf
                    @method('PUT')
                    
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
                        >{{ old('texto', $bulo->texto) }}</textarea>
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
                        >{{ old('texto_desmentido', $bulo->texto_desmentido) }}</textarea>
                        @error('texto_desmentido')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4 justify-end">
                        <a href="/" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            Actualizar Bulo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
