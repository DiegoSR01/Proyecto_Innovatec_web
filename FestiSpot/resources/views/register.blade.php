@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-[#181c2f] to-[#23243a] py-8">
    <div class="w-full max-w-xl bg-[#23243a] rounded-3xl shadow-2xl p-8 border border-[#2e2f4a]">
        <button onclick="window.location.href='/'" class="mb-4 text-pink-400 hover:text-fuchsia-400 text-xl"><i class="fa-solid fa-arrow-left"></i></button>
        <div class="flex flex-col items-center mb-8">
            <div class="bg-gradient-to-br from-pink-500 to-fuchsia-500 rounded-2xl p-4 mb-2 shadow-lg">
                <i class="fa-solid fa-user-group text-white text-3xl"></i>
            </div>
            <h1 class="font-black text-2xl text-white mb-1">¡Únete a FestiSpot!</h1>
            <p class="text-textMuted text-base text-center">Descubre y organiza eventos increíbles</p>
        </div>
    <form method="GET" action="/dashboard" class="space-y-5">
            <div class="flex gap-4">
                <div class="flex-1">
                    <label for="nombre" class="block text-textMuted font-semibold mb-1">Nombre</label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a]">
                        <i class="fa-solid fa-user text-pink-500 mr-3"></i>
                        <input id="nombre" type="text" name="nombre" required class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" placeholder="Nombre">
                    </div>
                </div>
                <div class="flex-1">
                    <label for="apellido" class="block text-textMuted font-semibold mb-1">Apellido(s)</label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a]">
                        <i class="fa-solid fa-user text-pink-500 mr-3"></i>
                        <input id="apellido" type="text" name="apellido" required class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" placeholder="Apellido(s)">
                    </div>
                </div>
            </div>
            <div>
                <label for="email" class="block text-textMuted font-semibold mb-1">Correo electrónico</label>
                <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a]">
                    <i class="fa-regular fa-envelope text-pink-500 mr-3"></i>
                    <input id="email" type="email" name="email" required class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" placeholder="tucorreo@ejemplo.com">
                </div>
            </div>
            <div>
                <label for="password" class="block text-textMuted font-semibold mb-1">Contraseña</label>
                <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a]">
                    <i class="fa-solid fa-lock text-pink-500 mr-3"></i>
                    <input id="password" type="password" name="password" required class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" placeholder="••••••••">
                    <i class="fa-regular fa-eye-slash text-textMuted ml-2"></i>
                </div>
            </div>
            <div>
                <label for="password_confirmation" class="block text-textMuted font-semibold mb-1">Confirmar contraseña</label>
                <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a]">
                    <i class="fa-solid fa-lock text-pink-500 mr-3"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" placeholder="••••••••">
                    <i class="fa-regular fa-eye-slash text-textMuted ml-2"></i>
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-2">
                <label class="inline-flex items-center gap-2 text-textMuted text-sm">
                    <input type="checkbox" required class="accent-pink-500 rounded">
                    Acepto los términos y condiciones
                </label>
                <label class="inline-flex items-center gap-2 text-textMuted text-sm">
                    <input type="checkbox" required class="accent-pink-500 rounded">
                    Acepto la política de privacidad
                </label>
            </div>
            <button type="submit" class="w-full py-3 mt-2 bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white rounded-xl font-bold text-lg shadow-lg hover:from-fuchsia-500 hover:to-pink-500 transition-all duration-300">Crear Cuenta</button>
        </form>
        <div class="mt-8 text-center text-textMuted text-sm">
            ¿Ya tienes una cuenta? <a href="/" class="text-pink-400 font-semibold hover:underline">Inicia sesión</a>
        </div>
    </div>
</div>
@endsection
