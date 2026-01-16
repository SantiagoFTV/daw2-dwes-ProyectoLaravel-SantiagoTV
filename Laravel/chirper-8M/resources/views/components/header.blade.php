<header class="bg-blue-600 text-white p-4 shadow-md">
    <div class="max-w-4xl mx-auto flex justify-between items-center">
        <a href="/" class="text-2xl font-bold hover:text-blue-100">8M-Chirper</a>
        
        <div class="flex items-center gap-4">
            @auth
                <!-- Usuario autenticado -->
                <span class="text-sm">Bienvenido, <strong>{{ auth()->user()->name }}</strong></span>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition duration-200">
                        Cerrar Sesión
                    </button>
                </form>
            @else
                <!-- Usuario invitado -->
                <a href="/login" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded hover:bg-blue-50 transition duration-200">
                    Iniciar Sesión
                </a>
                <a href="/register" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-4 py-2 rounded transition duration-200">
                    Registrarse
                </a>
            @endauth
        </div>
    </div>
</header>
