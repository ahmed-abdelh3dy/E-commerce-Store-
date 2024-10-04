@props(['options', 'name', 'selected' => null, 'label' => false])



{{-- @if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<select name={{ $name }}>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected($value == $selected)> {{ $text }}</option>
    @endforeach
</select> --}}


@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<select name="{{ $name }}" class="form-control">
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected($value == $selected)> {{ $text }}</option>
    @endforeach
</select>

