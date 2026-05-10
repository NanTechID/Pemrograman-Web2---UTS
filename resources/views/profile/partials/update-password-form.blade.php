<section>
    <header class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-black ">
                {{ __('Update Password') }}
            </h2>
        </div>
        <p class="text-sm text-gray-700 ml-15">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="form-control">
            <label class="label">
                <span class="label-text font-semibold text-black">{{ __('Current Password') }}</span>
            </label>
            <input id="update_password_current_password" name="current_password" type="password" class="input input-bordered w-full focus:input-primary" autocomplete="current-password" placeholder="Masukkan password saat ini" />
            @error('updatePassword.current_password')
                <label class="label">
                    <span class="label-text-alt text-error text-black">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">
                <span class="label-text font-semibold text-black">{{ __('New Password') }}</span>
            </label>
            <input id="update_password_password" name="password" type="password" class="input input-bordered w-full focus:input-primary" autocomplete="new-password" placeholder="Masukkan password baru" />
            @error('updatePassword.password')
                <label class="label">
                    <span class="label-text-alt text-error text-black">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">
                <span class="label-text font-semibold text-black">{{ __('Confirm Password') }}</span>
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input input-bordered w-full focus:input-primary" autocomplete="new-password" placeholder="Konfirmasi password baru" />
            @error('updatePassword.password_confirmation')
                <label class="label">
                    <span class="label-text-alt text-error text-black">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="btn btn-primary px-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="alert alert-success w-fit text-black"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ __('Password updated successfully!') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
