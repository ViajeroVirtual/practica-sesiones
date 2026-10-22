@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="py-6">

    @if (session()->has('token'))
        {{-- Usuario con sesión activa --}}
        <div class="space-y-6">
            <div class="border-b border-neutral-100 pb-4">
                <span class="inline-block text-[11px] font-mono uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded mb-2">
                    Sesión activa
                </span>
                <h1 class="text-xl font-medium tracking-tight text-neutral-900">
                    Bienvenido, {{ session('name') }}
                </h1>
                <p class="text-xs text-neutral-500 mt-1">
                    Los datos permanentes de tu sesión se encuentran registrados.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="border border-neutral-200 rounded-lg p-4 bg-neutral-50/30">
                    <span class="block text-[11px] uppercase tracking-wider text-neutral-400 font-mono mb-1">Usuario</span>
                    <span class="text-sm font-medium text-neutral-900">{{ session('name') }}</span>
                </div>

                <div class="border border-neutral-200 rounded-lg p-4 bg-neutral-50/30">
                    <span class="block text-[11px] uppercase tracking-wider text-neutral-400 font-mono mb-1">Token</span>
                    <span class="text-xs font-mono text-neutral-700 break-all select-all">{{ session('token') }}</span>
                </div>
            </div>

            <div class="pt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="text-xs bg-neutral-900 hover:bg-neutral-800 text-white font-medium px-4 py-2 rounded-md transition"
                    >
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>

    @else
        {{-- Visitante sin sesión --}}
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-normal tracking-tight text-neutral-900">
                    Práctica de Sesiones
                </h1>
                <p class="text-sm text-neutral-500 mt-1.5 max-w-lg leading-relaxed">
                    Control de estado mediante sesiones permanentes y generación de tokens de acceso en Laravel.
                </p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <a
                    href="{{ route('login') }}"
                    class="bg-neutral-900 hover:bg-neutral-800 text-white text-xs font-medium px-4 py-2 rounded-md transition"
                >
                    Iniciar sesión
                </a>
                <a
                    href="{{ route('register') }}"
                    class="border border-neutral-200 hover:border-neutral-400 text-neutral-700 text-xs font-medium px-4 py-2 rounded-md transition"
                >
                    Crear cuenta
                </a>
            </div>

            <div class="pt-6 border-t border-neutral-100">
                <p class="text-xs text-neutral-400">
                    Usuario de prueba: <code class="font-mono text-neutral-600 bg-neutral-100 px-1.5 py-0.5 rounded">test@example.com</code> / Contraseña: <code class="font-mono text-neutral-600 bg-neutral-100 px-1.5 py-0.5 rounded">password</code>
                </p>
            </div>
        </div>
    @endif

</div>
@endsection
