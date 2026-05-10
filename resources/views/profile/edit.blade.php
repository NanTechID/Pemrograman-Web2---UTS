@extends(auth()->user()?->role === 'kasir' ? 'layouts.kasir' : 'layouts.admin')

@section('content')
    <div class="space-y-8">
        <div class="content-panel">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-black ">{{ __('Profile') }}</h2>
                        <p class="text-sm text-gray-600 ">Kelola informasi profil dan keamanan akun Anda</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="surface-card p-8 rounded-2xl transition-all duration-300 hover:shadow-lg">
            <div class="max-w-3xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>

        <div class="surface-card p-8 rounded-2xl transition-all duration-300 hover:shadow-lg">
            <div class="max-w-3xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>

        <div class="surface-card p-8 rounded-2xl border border-red-100 transition-all duration-300 hover:shadow-lg">
            <div class="max-w-3xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
