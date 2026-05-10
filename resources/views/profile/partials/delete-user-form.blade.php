<section class="space-y-6">
    <header class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-black ">
                {{ __('Delete Account') }}
            </h2>
        </div>
        <p class="text-sm text-gray-700 ml-15">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <div class="alert alert-error mt-4 bg-red-50 border border-red-200 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0a9 9 0 1 1 0-18 9 9 0 0 1 0 18z" /></svg>
        <span class="text-black">{{ __('Tindakan ini tidak dapat dibatalkan. Pastikan Anda sudah mengunduh semua data penting sebelum menghapus akun.') }}</span>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn btn-error px-8 mt-6"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0a9 9 0 1 1 0-18 9 9 0 0 1 0 18z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-black ">
                    {{ __('Delete Your Account?') }}
                </h3>
            </div>

            <p class="text-black mb-6">
                {{ __('Tindakan ini akan menghapus akun Anda secara permanen beserta semua data yang terkait. Masukkan password Anda untuk mengkonfirmasi penghapusan.') }}
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold text-black">{{ __('Password Confirmation') }}</span>
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="input input-bordered w-full focus:input-error"
                        placeholder="{{ __('Masukkan password Anda untuk mengkonfirmasi') }}"
                        autofocus
                    />
                    @error('userDeletion.password')
                        <label class="label">
                            <span class="label-text-alt text-error text-black">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="btn btn-ghost"
                    >
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />
                        </svg>
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
