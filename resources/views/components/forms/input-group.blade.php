@props(['label', 'name', 'class' => '', 'type' => 'text', 'value' => null, 'disabled' => false, 'attributes' => [], 'errors' => null])

@php
    $hasErrors = $errors ? $errors->get($name) : [];
    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'class' => 'input input-filled input-lg peer bg-white ' . ($hasErrors ? 'is-invalid' : ''),
        'value' => old($name) ?? $value,
    ];
    if($disabled) {
        $defaults['disabled'] = true;
    }
    $divClasses = \Illuminate\Support\Arr::toCssClasses([$class]);
@endphp

<div class="relative {{ $divClasses }}">
    <input placeholder="" {{ $attributes->merge($defaults) }} />
    <label class="input-filled-label" for="{{ $name }}">{{ $label }}</label>

    @if ($hasErrors)
        <div class="text-red-500 text-xs mt-1">
            @foreach ($hasErrors as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    @endif
</div>
