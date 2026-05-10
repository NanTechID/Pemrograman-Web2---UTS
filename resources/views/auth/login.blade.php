@extends('layouts.guest')

@section('background-effects')
@php
    $particleCount = 56;
@endphp
<div class="login-particle-layer" aria-hidden="true">
    @for ($i = 0; $i < $particleCount; $i++)
        <span
            class="login-particle"
            style="--x: {{ rand(0, 100) }}%; --size: {{ rand(4, 12) }}px; --duration: {{ rand(8, 15) }}s; --delay: -{{ rand(0, 16) }}s; --drift: {{ rand(-140, 140) }}px;"
        ></span>
    @endfor
</div>

<style>
    .login-particle-layer {
        position: absolute;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
        z-index: 0;
    }

    .login-particle {
        position: absolute;
        left: var(--x);
        bottom: -10vh;
        width: var(--size);
        height: var(--size);
        border-radius: 999px;
        background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 1), rgba(94, 234, 212, 0.95) 40%, rgba(14, 165, 233, 0.7) 75%, rgba(14, 165, 233, 0));
        opacity: 0;
        box-shadow: 0 0 0.5rem rgba(255, 255, 255, 0.85), 0 0 1.2rem rgba(45, 212, 191, 0.9), 0 0 2.4rem rgba(6, 182, 212, 0.7);
        filter: drop-shadow(0 0 18px rgba(45, 212, 191, 0.85));
        mix-blend-mode: screen;
        animation: login-particle-rise var(--duration) linear infinite;
        animation-delay: var(--delay);
        will-change: transform, opacity;
    }

    @keyframes login-particle-rise {
        0% {
            transform: translate3d(0, 0, 0) scale(0.85);
            opacity: 0;
        }
        10% {
            opacity: 0.9;
        }
        65% {
            opacity: 1;
        }
        100% {
            transform: translate3d(var(--drift), -120vh, 0) scale(1.85);
            opacity: 0;
        }
    }
    
    @media (prefers-reduced-motion: reduce) {
        .login-particle {
            animation: none;
            opacity: 0.25;
        }
    }
</style>
@endsection

@section('content')
<div class="space-y-6">
    <div class="text-center space-y-2 animate-fade-in">
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.61 0 5.053.737 7.121 2.016M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-500 bg-clip-text text-transparent">
Selamat Datang Kembali
        </h2>
        <p class="text-slate-600 text-sm md:text-base max-w-sm mx-auto leading-relaxed">
Masuk ke akun Anda dan lanjutkan mengelola dashboard (Admin / Kasir) dengan aman.
        </p>
    </div>

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-6" x-data="{ loading: false }" x-on:submit="loading = true">
        @csrf
        
        <!-- Username or Email -->
        <div class="group relative mb-6 z-10">
            <input
                type="text"
                name="login"
                id="login"
                value="{{ old('login') }}"
                required
                placeholder="Username atau Email"
                class="input-stroke peer w-full px-4 py-4 text-base sm:text-lg text-slate-900 placeholder-transparent focus:ring-0 transition-all duration-300"
            >
            <label for="login" class="absolute left-4 top-4 text-slate-400 text-base sm:text-lg transition-all duration-200 pointer-events-none bg-transparent px-1 origin-[0] peer-placeholder-shown:top-4 peer-placeholder-shown:scale-100 peer-focus:-top-2 peer-focus:scale-75 peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:scale-75 peer-focus:text-teal-600 peer-[&:not(:placeholder-shown)]:text-teal-600">
                Username atau Email
            </label>
        </div>
        
        <!-- Password --> 
        <div class="group relative mb-6 z-10">
            <input
                type="password"
                name="password"
                id="password"
                required
                placeholder="Kata Sandi"
                class="input-stroke peer w-full px-4 py-4 pr-12 text-base sm:text-lg text-slate-900 placeholder-transparent focus:ring-0 transition-all duration-300"
            >
            <label for="password" class="absolute left-4 top-4 text-slate-400 text-base sm:text-lg transition-all duration-200 pointer-events-none bg-transparent px-1 origin-[0] peer-placeholder-shown:top-4 peer-placeholder-shown:scale-100 peer-focus:-top-2 peer-focus:scale-75 peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:scale-75 peer-focus:text-teal-600 peer-[&:not(:placeholder-shown)]:text-teal-600">
                Kata Sandi
            </label>
            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center password-eye" onclick="togglePassword()" aria-label="Toggle password visibility">
                <svg class="h-5 w-5 text-slate-400 hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eyeIcon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>

        @if ($errors->any())
            <div class="animate-shake bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl text-sm flex items-start gap-3">
                <svg class="h-5 w-5 flex-shrink-0 mt-0.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded accent-sky-500">
                <span class="text-slate-600">Ingat saya</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-teal-600 hover:text-teal-700 font-semibold transition-colors duration-200">
                Lupa Password?
            </a>
        </div>

        <button 
            type="submit" 
            class="w-full py-4 px-6 rounded-2xl text-lg font-semibold text-white bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 hover:from-emerald-600 hover:via-teal-600 hover:to-cyan-600 shadow-xl hover:shadow-2xl hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 transform btn-glow" 
            :disabled="loading"
        >
            <span x-text="loading ? 'Memproses...' : 'Masuk'"></span>
            <svg x-show="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>

    </form>

    <div class="text-center pt-6 border-t border-slate-200/50">
        <p class="text-sm text-slate-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-teal-600 font-semibold hover:text-teal-700 transition-colors">Buat sekarang</a>
        </p>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.8s ease-out; }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    .animate-shake { animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both; }
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m-3.305 .662a3 3 0 104.243 4.243M6.34 6.34a3 3 0 11-4.243 -4.243 3 3 0 014.243 4.243z" />
        `;
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
    }
}
</script>
@endsection

