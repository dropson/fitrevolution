@props(['label', 'name', 'type' => 'radio', 'class' => '', 'value' => null, 'attributes' => [], 'checked' => false, 'errors' => null])

@php
    $hasErrors = $errors ? $errors->get($name) : [];
    $defaults = [
        'type' => $type,
        'name' => $name,
        'class' => 'radio radio-primary radio-sm hidden',
        'value' => $value,
    ];
    $divClasses = \Illuminate\Support\Arr::toCssClasses([$class]);
@endphp


<label class="custom-label-option bg-white p-2 flex sm:w-1/2 flex-row justify-center items-center">
    <input {{ $attributes->merge($defaults) }} {{ $checked ? 'checked' : '' }}  />
    <span class="{{ $divClasses }} size-10 text-indigo-700"></span>
    <span>
        <span class="font-semibold">
            <span class="label-text text-base">{{ $label }}</span>
        </span>
    </span>
</label>

