<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sesiones')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', 'sans-serif'],
                        mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-full flex flex-col bg-white text-neutral-900 antialiased selection:bg-neutral-900 selection:text-white">

    <!-- Header minimalista -->
    <header class="border-b border-neutral-150 py-4 px-6 sm:px-10">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-medium tracking-tight text-sm text-neutral-900 hover:text-neutral-600 transition">
                sesiones<span class="text-neutral-400">.app</span>
            </a>

            <nav class="flex items-center gap-4 text-sm">
                @if (session()->has('token'))
                    {{-- Con token en la sesión: "Hola, [nombre]" y botón "Cerrar sesión" --}}
                    <span class="text-neutral-700 font-medium">
                        Hola, {{ session('name') }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                        @csrf
                        <button
                            type="submit"
                            class="text-xs text-neutral-500 hover:text-neutral-900 border border-neutral-200 hover:border-neutral-400 rounded-md px-2.5 py-1 transition"
                        >
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    {{-- Sin token en la sesión: "Iniciar sesión" y "Crear cuenta" --}}
                    <a
                        href="{{ route('login') }}"
                        class="text-neutral-600 hover:text-neutral-900 transition"
                    >
                        Iniciar sesión
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="bg-neutral-900 hover:bg-neutral-800 text-white text-xs font-medium px-3.5 py-1.5 rounded-md transition"
                    >
                        Crear cuenta
                    </a>
                @endif
            </nav>
        </div>
    </header>

    <!-- Avisos flash -->
    <div class="max-w-4xl mx-auto px-6 sm:px-10 w-full mt-6">
        @if (session('success'))
            <div class="text-xs text-neutral-700 bg-neutral-50 border border-neutral-200 rounded-md p-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="text-xs text-red-600 bg-red-50/50 border border-red-200 rounded-md p-3">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-4xl mx-auto px-6 sm:px-10 py-10 w-full">
        @yield('content')
    </main>

    <!-- Footer minimalista -->
    <footer class="border-t border-neutral-100 py-6 px-6 sm:px-10 mt-auto">
        <div class="max-w-4xl mx-auto flex items-center justify-between text-xs text-neutral-400">
            <span>Práctica Sesiones</span>
            <span>Laravel {{ app()->version() }}</span>
        </div>
    </footer>

</body>
</html>
