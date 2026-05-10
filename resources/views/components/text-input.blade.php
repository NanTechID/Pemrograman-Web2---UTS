@props(['disabled' => false, 'label' => null])

<div class="group relative mb-6 z-10">
  <input 
    @disabled($disabled) 
    {{ $attributes->merge(['class' => 'input-stroke peer w-full px-4 py-4 text-lg text-slate-900 placeholder-transparent focus:ring-0 transition-all duration-300 peer-focus:text-slate-900', 'placeholder' => $label ?? '']) }}
  >
  @if($label)
    <label class="absolute left-4 top-4 text-slate-400 text-lg transition-all duration-300 peer-placeholder-shown:text-lg peer-placeholder-shown:text-slate-400 peer-focus:-top-3 peer-focus:text-sm peer-focus:text-sky-500 peer-valid:-top-3 peer-valid:text-sm peer-valid:text-sky-500 pointer-events-none">
      {{ $label }}
    </label>
  @endif
</div>
