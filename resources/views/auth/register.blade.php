@extends('layouts.app')

@section('title', 'Crear Cuenta')

@section('content')
<div class="max-w-md mx-auto px-4 sm:px-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-3 shadow-sm border border-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Crear Cuenta</h1>
            <p class="text-sm text-gray-500 mt-1">Regístrate para obtener acceso al sistema</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200">
                <div class="flex items-center gap-2 text-sm font-medium text-red-800 mb-1">
                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Error al registrar la cuenta
                </div>
                <ul class="list-disc list-inside text-xs text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl text-sm transition text-gray-900 @error('name') border-red-300 bg-red-50 @enderror"
                    placeholder="Tu nombre o alias"
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
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
                    placeholder="Mínimo 6 caracteres"
                >
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl text-sm transition text-gray-900"
                    placeholder="Repite tu contraseña"
                >
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-medium rounded-xl text-sm shadow-sm transition"
                >
                    Crear cuenta
                </button>
            </div>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-500">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline">
                    Iniciar sesión
                </a>
            </p>
        </div>

    </div>
</div>
@endsection
