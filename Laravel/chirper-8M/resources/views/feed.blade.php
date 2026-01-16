<x-layout>
    <x-slot:title>
        Home Feed
    </x-slot:title>

{{-- Formulario para crear bulos --}}
<!-- Formulario para crear un bulo -->
<div class="max-w-xl mx-auto mt-8">
    <form method="POST" action="/bulos" class="bg-white shadow-lg rounded-lg p-6 border border-blue-200">
        @csrf
        <h2 class="text-xl font-bold text-blue-700 mb-4 text-center">Publicar un nuevo bulo</h2>
        <div class="mb-4">
            <label for="texto" class="block text-sm font-semibold text-gray-700 mb-1">Texto del bulo</label>
            <textarea
                id="texto"
                name="texto"
                class="w-full border border-blue-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                placeholder="Escribe el texto del bulo..."
                rows="3"
                maxlength="255"
                required
            >{{ old('texto') }}</textarea>
            @error('texto')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="texto_desmentido" class="block text-sm font-semibold text-gray-700 mb-1">Explicación / Desmentido</label>
            <textarea
                id="texto_desmentido"
                name="texto_desmentido"
                class="w-full border border-blue-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                placeholder="Escribe la explicación/desmentido..."
                rows="3"
                maxlength="255"
                required
            >{{ old('texto_desmentido') }}</textarea>
            @error('texto_desmentido')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow">
                Publicar Bulo
            </button>
        </div>
    </form>
</div>

    {{-- Lista de bulos --}}

    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold mt-8">Últimos Bulos</h1>

        <div class="space-y-8 mt-8 flex flex-col items-center">
            @forelse ($bulos as $bulo)
                <x-bulo-component :bulo="$bulo" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="mt-4 text-base-content/60">¡No hay bulos todavía! Sé el primero en publicar uno.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
