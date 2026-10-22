@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    @if (session()->has('token'))
        {{-- Panel cuando el usuario ha iniciado sesión --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 p-8 text-white">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-3xl font-extrabold shadow-inner">
                        {{ strtoupper(substr(session('name'), 0, 1)) }}
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-400/20 text-emerald-200 mb-1 border border-emerald-400/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-ping"></span>
                            Sesión Activa
                        </div>
                        <h1 class="text-2xl font-bold">¡Hola, {{ session('name') }}!</h1>
                        <p class="text-indigo-100 text-sm">Has iniciado sesión correctamente en el sistema.</p>
                    </div>
                </div>
            </div>

            <div class="p-8 space-y-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Datos de la sesión permanente</h2>
                    <p class="text-sm text-gray-600 mb-4">
                        Estos valores se han registrado en la sesión mediante <code class="bg-gray-100 text-indigo-600 px-2 py-0.5 rounded font-mono text-xs">session(['token' => $token, 'name' => $user->name])</code>:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <span class="text-xs uppercase tracking-wider text-gray-400 font-semibold block mb-1">Usuario (name)</span>
                            <div class="text-base font-semibold text-gray-800 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                {{ session('name') }}
                            </div>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <span class="text-xs uppercase tracking-wider text-gray-400 font-semibold block mb-1">Token de Sesión</span>
                            <div class="text-xs font-mono font-medium text-indigo-700 bg-indigo-50 px-2 py-1 rounded border border-indigo-100 break-all">
                                {{ session('token') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs text-gray-500">
                        Al pulsar en <strong>Cerrar sesión</strong>, se invalidará la sesión y se regenerará el token CSRF.
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-xl shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                            </svg>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>

    @else
        {{-- Panel cuando NO hay sesión iniciada --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 md:p-12 mb-8 text-center">
            <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-6 shadow-sm border border-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <h1 class="text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">Práctica de Sesiones</h1>
            <p class="text-base text-gray-600 max-w-xl mx-auto mb-8">
                Inicia sesión con tu cuenta para generar un token permanente en sesión y acceder al panel privado. Puedes utilizar las credenciales de prueba o registrar un nuevo usuario.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 text-base font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl border border-indigo-200 transition">
                    Crear cuenta nueva
                </a>
            </div>

            <!-- Tarjeta con usuario de prueba -->
            <div class="max-w-md mx-auto bg-gray-50 border border-gray-200 rounded-xl p-5 text-left text-sm">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-800 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Usuario de prueba disponible:
                    </span>
                    <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full font-medium">Listo para usar</span>
                </div>
                <div class="space-y-1 text-gray-600">
                    <p><strong>Email:</strong> <code class="bg-white px-2 py-0.5 rounded border border-gray-200 text-gray-800">test@example.com</code></p>
                    <p><strong>Contraseña:</strong> <code class="bg-white px-2 py-0.5 rounded border border-gray-200 text-gray-800">password</code></p>
                </div>
            </div>
        </div>
    @endif

    <!-- Características del ejercicio implementadas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold mb-4">
                1
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Login con Token</h3>
            <p class="text-xs text-gray-600">
                Verifica contraseña con <code class="font-mono text-indigo-600">Hash::check</code> y almacena <code class="font-mono text-indigo-600">token</code> y <code class="font-mono text-indigo-600">name</code> en la sesión permanente.
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold mb-4">
                2
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Logout Seguro</h3>
            <p class="text-xs text-gray-600">
                Elimina los datos de sesión mediante <code class="font-mono text-indigo-600">session()->invalidate()</code> y regenera el token con <code class="font-mono text-indigo-600">regenerateToken()</code>.
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold mb-4">
                3
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Header Reactivo</h3>
            <p class="text-xs text-gray-600">
                Muestra botones de acceso si no hay sesión. Si hay token en la sesión, muestra el saludo personalizado al usuario y el botón para cerrar la sesión.
            </p>
        </div>
    </div>

</div>
@endsection
