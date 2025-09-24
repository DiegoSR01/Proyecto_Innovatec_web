@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-[#181c2f] to-[#23243a] py-8">
    <div class="w-full max-w-xl bg-[#23243a] rounded-3xl shadow-2xl p-8 border border-[#2e2f4a]">
        <button onclick="window.location.href='/'" class="mb-4 text-pink-400 hover:text-fuchsia-400 text-xl">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        
        <div class="flex flex-col items-center mb-8">
            <div class="bg-gradient-to-br from-pink-500 to-fuchsia-500 rounded-2xl p-4 mb-4 shadow-lg">
                <i class="fa-solid fa-user-group text-white text-3xl"></i>
            </div>
            <h1 class="font-black text-2xl text-white mb-2">¡Únete a FestiSpot!</h1>
            <p class="text-textMuted text-base text-center">Descubre y organiza eventos increíbles</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-900/60 border border-red-500 text-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register" class="space-y-6">
            @csrf
            
            <!-- Nombre y Apellido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nombre" class="block text-textMuted font-semibold mb-2">Nombre</label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                        <i class="fa-solid fa-user text-pink-500 mr-3 flex-shrink-0"></i>
                        <input id="nombre" type="text" name="nombre" required 
                               class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" 
                               placeholder="Nombre" value="{{ old('nombre') }}">
                    </div>
                </div>
                
                <div>
                    <label for="apellido" class="block text-textMuted font-semibold mb-2">Apellido(s)</label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                        <i class="fa-solid fa-user text-pink-500 mr-3 flex-shrink-0"></i>
                        <input id="apellido" type="text" name="apellido" required 
                               class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" 
                               placeholder="Apellido(s)" value="{{ old('apellido') }}">
                    </div>
                </div>
            </div>
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-textMuted font-semibold mb-2">Correo electrónico</label>
                <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                    <i class="fa-regular fa-envelope text-pink-500 mr-3 flex-shrink-0"></i>
                    <input id="email" type="email" name="email" required 
                           class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" 
                           placeholder="correo@dominio.com" value="{{ old('email') }}">
                </div>
            </div>
            
            <!-- Teléfono y Fecha de nacimiento -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="telefono" class="block text-textMuted font-semibold mb-2">
                        Teléfono <span class="text-xs text-textMuted/70">(opcional)</span>
                    </label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                        <i class="fa-solid fa-phone text-pink-500 mr-3 flex-shrink-0"></i>
                        <input id="telefono" type="tel" name="telefono" 
                               class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" 
                               placeholder="+52 55 1234 5678" value="{{ old('telefono') }}">
                    </div>
                </div>
                
                <div>
                    <label for="fecha_nacimiento" class="block text-textMuted font-semibold mb-2">
                        Fecha de nacimiento <span class="text-xs text-textMuted/70">(opcional)</span>
                    </label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                        <i class="fa-solid fa-calendar text-pink-500 mr-3 flex-shrink-0"></i>
                        <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" 
                               class="bg-transparent outline-none border-none flex-1 text-white [color-scheme:dark]" 
                               value="{{ old('fecha_nacimiento') }}">
                    </div>
                </div>
            </div>
            
            <!-- Género -->
            <div>
                <label for="genero" class="block text-textMuted font-semibold mb-2">
                    Género <span class="text-xs text-textMuted/70">(opcional)</span>
                </label>
                <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                    <i class="fa-solid fa-user-group text-pink-500 mr-3 flex-shrink-0"></i>
                    <select id="genero" name="genero" 
                            class="bg-transparent outline-none border-none flex-1 text-white appearance-none cursor-pointer">
                        <option value="" class="bg-[#1a1b2d] text-white">Seleccionar género</option>
                        <option value="masculino" class="bg-[#1a1b2d] text-white" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" class="bg-[#1a1b2d] text-white" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="otro" class="bg-[#1a1b2d] text-white" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
                        <option value="prefiero_no_decir" class="bg-[#1a1b2d] text-white" {{ old('genero') == 'prefiero_no_decir' ? 'selected' : '' }}>Prefiero no decir</option>
                    </select>
                    <i class="fa-solid fa-chevron-down text-textMuted ml-2 pointer-events-none flex-shrink-0"></i>
                </div>
            </div>
            
            <!-- Contraseñas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-textMuted font-semibold mb-2">Contraseña</label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                        <i class="fa-solid fa-lock text-pink-500 mr-3 flex-shrink-0"></i>
                        <input id="password" type="password" name="password" required 
                               class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" 
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password')" class="ml-2 flex-shrink-0">
                            <i class="fa-regular fa-eye-slash text-textMuted hover:text-pink-400 transition-colors cursor-pointer" id="password-toggle"></i>
                        </button>
                    </div>
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-textMuted font-semibold mb-2">Confirmar contraseña</label>
                    <div class="flex items-center bg-[#1a1b2d] rounded-xl px-4 py-3 border border-[#2e2f4a] focus-within:border-pink-500 transition-colors">
                        <i class="fa-solid fa-lock text-pink-500 mr-3 flex-shrink-0"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                               class="bg-transparent outline-none border-none flex-1 text-white placeholder:text-textMuted" 
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password_confirmation')" class="ml-2 flex-shrink-0">
                            <i class="fa-regular fa-eye-slash text-textMuted hover:text-pink-400 transition-colors cursor-pointer" id="password_confirmation-toggle"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Términos y condiciones -->
            <div class="space-y-3 pt-2">
                <label class="flex items-start gap-3 text-textMuted text-sm cursor-pointer">
                    <input type="checkbox" required class="accent-pink-500 rounded mt-1 flex-shrink-0">
                    <span>Acepto los <a href="#" class="text-pink-400 hover:text-fuchsia-400 underline">términos y condiciones</a></span>
                </label>
                <label class="flex items-start gap-3 text-textMuted text-sm cursor-pointer">
                    <input type="checkbox" required class="accent-pink-500 rounded mt-1 flex-shrink-0">
                    <span>Acepto la <a href="#" class="text-pink-400 hover:text-fuchsia-400 underline">política de privacidad</a></span>
                </label>
            </div>
            
            <!-- Botón de envío -->
            <button type="submit" class="w-full py-3 mt-6 bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white rounded-xl font-bold text-lg shadow-lg hover:from-fuchsia-500 hover:to-pink-500 hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300">
                Crear Cuenta
            </button>
        </form>
        
        <div class="mt-8 text-center text-textMuted text-sm">
            ¿Ya tienes una cuenta? 
            <a href="/" class="text-pink-400 font-semibold hover:text-fuchsia-400 hover:underline transition-colors">
                Inicia sesión
            </a>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const toggle = document.getElementById(fieldId + '-toggle');
    
    if (field.type === 'password') {
        field.type = 'text';
        toggle.classList.remove('fa-eye-slash');
        toggle.classList.add('fa-eye');
    } else {
        field.type = 'password';
        toggle.classList.remove('fa-eye');
        toggle.classList.add('fa-eye-slash');
    }
}
</script>
@endsection