<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '8M-Chirper' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <x-header />

    <div class="max-w-4xl mx-auto px-4">
        @if (session('exito'))
            <div class="mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('exito') }}</span>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="text-center py-6">
            <h1 class="text-4xl font-bold text-gray-800">{{ $title ?? '8M-Chirper' }}</h1>
        </div>

        <main class="py-8">
            {{ $slot }}
        </main>
    </div>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="max-w-4xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} 8M-Chirper</p>
        </div>
    </footer>
</body>
</html>
