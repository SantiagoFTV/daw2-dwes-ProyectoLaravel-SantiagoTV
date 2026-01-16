@props(['bulo'])

<div class="w-full max-w-xl perspective">
    <div x-data="{ flipped: false }" class="relative w-full min-h-[34rem] h-auto"
         :class="flipped ? 'rotate-y-180' : ''"
         @click.away="flipped = false"
         style="transform-style: preserve-3d; transition: transform 0.6s;">

        {{-- FRONT --}}
        <div class="absolute w-full h-full backface-hidden flex flex-col bg-white shadow-lg rounded-lg p-4">

            {{-- Avatar y nombre --}}
            <div class="flex items-center space-x-3 mb-4">
                @if($bulo->user)
                    <img src="https://avatars.laravel.cloud/{{ urlencode($bulo->user->email) }}"
                         alt="{{ $bulo->user->name }}'s avatar" class="w-12 h-12 rounded-full" />
                    <div class="flex flex-col">
                        <span class="font-semibold">{{ $bulo->user->name }}</span>
                        <span class="text-sm text-gray-500">{{ $bulo->created_at->diffForHumans() }}</span>
                    </div>
                @else
                    <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                         alt="Anonymous User" class="w-12 h-12 rounded-full" />
                    <div class="flex flex-col">
                        <span class="font-semibold">Anonymous</span>
                        <span class="text-sm text-gray-500">{{ $bulo->created_at->diffForHumans() }}</span>
                    </div>
                @endif
            </div>

            {{-- Bulo --}}
            <div class="flex-1 flex flex-col items-center justify-center overflow-hidden p-6">
                <p class="text-gray-800 text-xl font-semibold text-center">{{ $bulo->texto }}</p>
            </div>

            {{-- Botón Chirp --}}
            <button @click.stop="flipped = true"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow mx-auto block">
                Chirp
            </button>

        </div>

        {{-- BACK --}}
        <div class="absolute w-full h-full backface-hidden rotate-y-180 flex flex-col bg-white shadow-lg rounded-lg p-4 justify-between">
            {{-- Explicación centrada --}}
            <div class="flex-1 flex items-center justify-center text-center">
                <p class="text-gray-700 text-lg">{{ $bulo->texto_desmentido }}</p>
            </div>

            {{-- Botones de acción --}}
            <div class="flex flex-col gap-2">
                @can('update', $bulo)
                    <div class="flex gap-2">
                        <a href="/bulos/{{ $bulo->id }}/edit"
                           class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded text-center">
                            Editar
                        </a>
                        
                        <form method="POST" action="/bulos/{{ $bulo->id }}" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este bulo?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                @endcan

                <button @click.stop="flipped = false"
                        class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded shadow">
                    Volver
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Tailwind necesario para 3D --}}
<style>
.perspective {
    perspective: 1000px;
}
.rotate-y-180 {
    transform: rotateY(180deg);
}
.backface-hidden {
    backface-visibility: hidden;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
