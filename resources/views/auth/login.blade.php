@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-3 shadow-sm border border-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Iniciar Sesión</h1>
            <p class="text-sm text-gray-500 mt-1">Introduce tus credenciales para acceder</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200">
                <div class="flex items-center gap-2 text-sm font-medium text-red-800 mb-1">
                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Error al iniciar sesión
                </div>
                <ul class="list-disc list-inside text-xs text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', 'test@example.com') }}"
                    required
                    autocomplete="email"
                    autofocus
                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl text-sm transition text-gray-900 @error('email') border-red-300 bg-red-50 @enderror"
                    placeholder="usuario@ejemplo.com"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl text-sm transition text-gray-900 @error('password') border-red-300 bg-red-50 @enderror"
                    placeholder="••••••••"
                >
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-medium rounded-xl text-sm shadow-sm transition"
                >
                    Iniciar sesión
                </button>
            </div>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-500">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline">
                    Crear cuenta
                </a>
            </p>
        </div>

    </div>

    <!-- Pista para la corrección/profesor -->
    <div class="mt-4 text-center">
        <p class="text-xs text-gray-400">
            Usuario de prueba: <code class="text-gray-600">test@example.com</code> / Contraseña: <code class="text-gray-600">password</code>
        </p>
    </div>
</div>
@endsection
