<div class="form-group">
    <x-form.input label="Role Name" type="text" name="name" value="{{ $role->names }}" />
</div>

<fieldset>
    <legend>{{ __('Ability') }}</legend>
    @foreach (config('abilities') as $ability_code => $ability_name)
        <div class="row mb-2">
            <div class="col-md-6">
                {{ $ability_name }}
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="allow" @checked(($role_ability[$ability_code] ?? '') == 'allow')>
                Allow
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="deny"  @checked(($role_ability[$ability_code] ?? '') == 'deny')>
                Deny
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="inherit"  @checked(($role_ability[$ability_code] ?? '') == 'inherit')>
                Inherit
            </div>
        </div>
    @endforeach
</fieldset>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $buton_lable ?? 'save' }}</button>
</div>
