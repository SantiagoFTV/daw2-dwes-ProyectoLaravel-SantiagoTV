<x-layout>
    <x-slot:title>
        Sign In
    </x-slot:title>

    <div class="min-h-[calc(100vh-16rem)] bg-base-200 flex items-center justify-center px-4">
        <div class="card w-full max-w-md bg-base-100 shadow-xl border border-base-300">
            <div class="card-body space-y-6">
                <div class="text-center space-y-1">
                    <h1 class="text-2xl font-semibold text-base-content">Inicia sesión</h1>
                    <p class="text-sm text-base-content/70">Accede con tu cuenta para continuar</p>
                </div>

                <form method="POST" action="/login" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <label class="floating-label">
                        <input type="email"
                               name="email"
                               placeholder="mail@example.com"
                               value="{{ old('email') }}"
                               class="input input-bordered w-full @error('email') input-error @enderror"
                               required
                               autofocus>
                        <span>Email</span>
                    </label>
                    @error('email')
                        <div class="label -mt-2 mb-1">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror

                    <!-- Password -->
                    <label class="floating-label">
                        <input type="password"
                               name="password"
                               placeholder="••••••••"
                               class="input input-bordered w-full @error('password') input-error @enderror"
                               required>
                        <span>Password</span>
                    </label>
                    @error('password')
                        <div class="label -mt-2 mb-1">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror

                    <!-- Remember Me -->
                    <label class="flex items-center gap-2 text-sm cursor-pointer">
                        <input type="checkbox" name="remember" class="checkbox checkbox-sm">
                        <span class="text-base-content/80">Recordarme</span>
                    </label>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-full">Entrar</button>
                </form>

                <div class="divider">o</div>
                <p class="text-center text-sm text-base-content/80">
                    ¿No tienes cuenta?
                    <a href="/register" class="link link-primary">Regístrate</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
