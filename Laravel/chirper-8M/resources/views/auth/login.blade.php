<x-layout>
    <x-slot:title>
        Iniciar Sesión
    </x-slot:title>

    <div class="min-h-[calc(100vh-16rem)] flex items-center justify-center bg-gray-100">
        <div class="w-96 bg-white rounded-lg shadow-lg">
            <div class="p-8">
                <h1 class="text-3xl font-bold text-center mb-6">Iniciar Sesión</h1>

                <form method="POST" action="/login">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700">
                        Entrar
                    </button>
                </form>

                <p class="text-center mt-4 text-sm text-gray-600">
                    ¿No tienes cuenta? <a href="/register" class="text-blue-600 hover:underline">Regístrate aquí</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
