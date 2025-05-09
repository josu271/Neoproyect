@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-white-600 to-indigo-700 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-gray-900">Bienvenido de nuevo</h2>
            <p class="mt-2 text-sm text-gray-600">Inicia sesión con tu cuenta</p>
        </div>
        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="dni" name="dni" type="text" value="{{ old('dni') }}" required autofocus
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                @error('dni')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="password" name="password" type="password" required
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        Recuérdame
                    </label>
                </div>
                @if(Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
                @endif
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Iniciar Sesión
                </button>
            </div>
        </form>

        @if(Route::has('register'))
        <p class="mt-6 text-center text-sm text-gray-600">
            ¿No tienes cuenta? 
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Regístrate</a>
        </p>
        @endif
    </div>
</div>