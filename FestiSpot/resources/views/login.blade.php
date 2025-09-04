@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-[#181c2f] to-[#23243a] py-8">
    <div class="w-full max-w-md bg-[#23243a] rounded-3xl shadow-2xl p-8 border border-[#2e2f4a]">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-gradient-to-br from-pink-500 to-fuchsia-500 rounded-2xl p-4 mb-2 shadow-lg">
                <i class="fa-solid fa-microphone-lines text-white text-3xl"></i>
            </div>
            <h1 class="font-black text-3xl text-white mb-1">FestiSpot</h1>
            <p class="text-textMuted text-base">Descubre los mejores festivales</p>
        </div>
        <h2 class="text-white text-2xl font-bold mb-2 text-center">¡Bienvenido de vuelta!</h2>
        <p class="text-textMuted text-center mb-6">Inicia sesión para continuar</p>
        <form method="POST" action="/login" class="space-y-5">
            @csrf
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-4">
                    <div class="flex items-center">
                        <i class="fa-solid fa-triangle-exclamation text-red-500 mr-2"></i>
                        <span class="text-red-400 text-sm">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif
            <div>
                <label for="email" class="block text-textMuted font-semibold mb-1">Correo electrónico</label>
                <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a]">
                    <i class="fa-regular fa-envelope text-pink-500 mr-3"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" placeholder="test@festispot.com">
                </div>
            </div>
            <div>
                <label for="password" class="block text-textMuted font-semibold mb-1">Contraseña</label>
                <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a]">
                    <i class="fa-solid fa-lock text-pink-500 mr-3"></i>
                    <input id="password" type="password" name="password" required class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" placeholder="password123">
                    <i class="fa-regular fa-eye-slash text-textMuted ml-2"></i>
                </div>
            </div>
            <button type="submit" class="w-full py-3 mt-2 bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white rounded-xl font-bold text-lg shadow-lg hover:from-fuchsia-500 hover:to-pink-500 transition-all duration-300">Iniciar Sesión</button>
        </form>
        <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-pink-400 text-sm hover:underline">¿Olvidaste tu contraseña?</a>
        </div>
        <div class="mt-8 text-center text-textMuted text-sm">
            ¿No tienes una cuenta? <a href="/register" class="text-pink-400 font-semibold hover:underline">Regístrate</a>
        </div>
        <div class="mt-8 bg-[#1a1b2d] rounded-xl p-4 border border-[#2e2f4a]">
            <div class="flex items-center gap-2 text-info mb-1">
                <i class="fa-solid fa-circle-info"></i>
                <span class="font-bold">Credenciales de prueba:</span>
            </div>
            <div class="text-textMuted text-xs">Puedes ingresar cualquier correo y contraseña para acceder al dashboard.</div>
        </div>
    </div>
</div>
@endsection
