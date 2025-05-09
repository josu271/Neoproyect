@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br white to-green-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-gray-200 rounded-2xl shadow-xl p-8 transform transition-transform hover:scale-105">
        <div class="text-center mb-6">
           
            <h2 class="text-3xl font-extrabold text-gray-900">¡Bienvenido de nuevo!</h2>
            <p class="mt-2 text-sm text-gray-600">Inicia sesión en tu cuenta para continuar</p>
        </div>

        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                <div class="mt-1">
                    <input id="dni" name="dni" type="text" value="{{ old('dni') }}" required autofocus
                        class="appearance-none block w-full px-4 py-3 border border-gray-500 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" placeholder="Ej: 12345678">
                </div>
                @error('dni')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <div class="mt-1">
                    <input id="password" name="password" type="password" required
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" placeholder="••••••••">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="inline-flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded transition duration-150">
                    <span class="ml-2 text-sm text-gray-900">Recuérdame</span>
                </label>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-green-600 hover:text-green-500">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</div>
@endsection