@extends('layouts.app')

@section('title', 'Crear Cuenta')

@section('content')
<div class="max-w-xs mx-auto py-6">

    <div class="mb-6">
        <h1 class="text-xl font-medium tracking-tight text-neutral-900">Crear Cuenta</h1>
        <p class="text-xs text-neutral-500 mt-1">Registra tus datos de acceso</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-md bg-red-50/60 border border-red-200 text-xs text-red-600">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-xs font-medium text-neutral-700 mb-1">Nombre</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                required
                autofocus
                class="w-full px-3 py-1.5 text-sm bg-white border border-neutral-300 focus:border-neutral-900 focus:outline-none rounded-md transition text-neutral-900 @error('name') border-red-300 @enderror"
            >
        </div>

        <div>
            <label for="email" class="block text-xs font-medium text-neutral-700 mb-1">Correo electrónico</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
                class="w-full px-3 py-1.5 text-sm bg-white border border-neutral-300 focus:border-neutral-900 focus:outline-none rounded-md transition text-neutral-900 @error('email') border-red-300 @enderror"
            >
        </div>

        <div>
            <label for="password" class="block text-xs font-medium text-neutral-700 mb-1">Contraseña</label>
            <input
                type="password"
                name="password"
                id="password"
                required
                class="w-full px-3 py-1.5 text-sm bg-white border border-neutral-300 focus:border-neutral-900 focus:outline-none rounded-md transition text-neutral-900 @error('password') border-red-300 @enderror"
            >
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-medium text-neutral-700 mb-1">Confirmar contraseña</label>
            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                required
                class="w-full px-3 py-1.5 text-sm bg-white border border-neutral-300 focus:border-neutral-900 focus:outline-none rounded-md transition text-neutral-900"
            >
        </div>

        <div class="pt-2">
            <button
                type="submit"
                class="w-full py-2 px-4 bg-neutral-900 hover:bg-neutral-800 text-white text-xs font-medium rounded-md transition"
            >
                Crear cuenta
            </button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-neutral-100 flex items-center justify-between text-xs text-neutral-500">
        <span>¿Ya tienes una cuenta?</span>
        <a href="{{ route('login') }}" class="text-neutral-900 underline underline-offset-2 hover:text-neutral-600">
            Iniciar sesión
        </a>
    </div>

</div>
@endsection
