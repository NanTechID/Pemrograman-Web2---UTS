<section>
    <header class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-black ">
                {{ __('Profile Information') }}
            </h2>
        </div>
        <p class="text-sm text-gray-700 ml-15">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="form-control">
            <label class="label">
                <span class="label-text font-semibold text-black">{{ __('Name') }}</span>
            </label>
            <input id="name" name="name" type="text" class="input input-bordered w-full focus:input-primary" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            @error('name')
                <label class="label">
                    <span class="label-text-alt text-error text-black">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">
                <span class="label-text font-semibold text-black">{{ __('Email') }}</span>
            </label>
            <input id="email" name="email" type="email" class="input input-bordered w-full focus:input-primary" :value="old('email', $user->email)" required autocomplete="username" placeholder="Masukkan email Anda" />
            @error('email')
                <label class="label">
                    <span class="label-text-alt text-error text-black">{{ $message }}</span>
                </label>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-4 text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0a9 9 0 1 1 0-18 9 9 0 0 1 0 18z" /></svg>
                    <div>
                        <h3 class="font-bold">{{ __('Email Verification Required') }}</h3>
                        <div class="text-xs">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="link link-primary font-semibold">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </div>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-4 text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" /></svg>
                        <span>{{ __('A new verification link has been sent to your email address.') }}</span>
                    </div>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="btn btn-primary px-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="alert alert-success w-fit text-black"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ __('Profile updated successfully!') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
