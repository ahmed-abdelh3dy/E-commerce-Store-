@props([
    'name',
    'value' => '',
    'label' => false,
])
@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif


<textarea  name="{{ $name }}" class="form-control">{{ old($name, $value) }}</textarea>
@error($name)
    <div class="invalid_feedback">

        {{ message }}
    </div>
@enderror



