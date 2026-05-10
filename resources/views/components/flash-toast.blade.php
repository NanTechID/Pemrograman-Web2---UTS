@php
    $toastType = null;
    $toastMessage = null;

    if (session('success')) {
        $toastType = 'success';
        $toastMessage = session('success');
    } elseif (session('error')) {
        $toastType = 'error';
        $toastMessage = session('error');
    } elseif (session('warning')) {
        $toastType = 'warning';
        $toastMessage = session('warning');
    } elseif (session('status')) {
        $toastType = 'info';
        $toastMessage = session('status');
    } elseif ($errors->any()) {
        $toastType = 'error';
        $toastMessage = $errors->first();
    }

    $toastClass = match ($toastType) {
        'success' => 'alert-success',
        'error' => 'alert-error',
        'warning' => 'alert-warning',
        default => 'alert-info',
    };
@endphp

@if ($toastMessage)
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3500)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="pointer-events-none fixed right-4 top-4 z-[999] w-[calc(100%-2rem)] max-w-sm"
        style="display: none;"
    >
        <div class="alert {{ $toastClass }} pointer-events-auto shadow-xl text-black">
            <span>{{ $toastMessage }}</span>
            <button type="button" class="btn btn-xs btn-ghost text-black" x-on:click="show = false" aria-label="Close notification">x</button>
        </div>
    </div>
@endif