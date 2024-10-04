@props([
    'options',
    'name',
    'chacked' => 'false',
    'label' => false,
])



@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

@foreach ($options as $value => $text)
<div class="form-check">
    <input class="form-check-input" type="radio" name="{{$name}}" value="{{$value}}"
        @checked(old($name , $chacked) == '$value')>
    <label class="form-check-label" >
      {{$text}}
    </label>
</div>

@endforeach