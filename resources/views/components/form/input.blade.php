@props([
    'type' => 'text',
    'name',
    'value' => '',
    'label' => false,
])
@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif


<input type="{{ $type }}" name="{{ $name }}" class="form-control" value = "{{ old($name, $value) }}">
@error($name)
    <div class="invalid_feedback">

        {{ $message }}
    </div>
@enderror


