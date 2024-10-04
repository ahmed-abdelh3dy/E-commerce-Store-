@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">Edit Profile</li>

@endsection

@section('title')
Edit categories
@endsection

<x-alert />

@section('content')
    <form action="{{ route('dashboard.profile.update',) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input label="First Name" type="text" name="first_name" value="{{$user->profile->first_name}}" />
            </div>
            <div class="col-md-6">
                <x-form.input label="Last Name" type="text" name="last_name" value="{{$user->profile->last_name}}"  />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <x-form.input label=" Birthday" type="texdatet" name="birthday" value="{{$user->profile->birthday}}" />
            </div>
            <div class="col-md-6">
                <x-form.radio label=" Gender" type="text" name="gender" :options="['male'=>'male', 'female' => 'female']"  chacked="{{$user->profile->gender}}" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <x-form.input label="street address " type="text" name="street_address" value="{{$user->profile->street_address}}" />
            </div>
            <div class="col-md-4">
                <x-form.input label="City" type="text" name="city" value="{{$user->profile->city}}" />
            </div>

            <div class="col-md-4">
                <x-form.input label="state" type="text" name="state" value="{{$user->profile->state}}" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <x-form.input label="postal code" type="text" name="postal_code" value="{{$user->profile->postal_code}}" />
            </div>
            <div class="col-md-4">
                <x-form.select label="country" type="text" :options="$countries" name="country" selected="{{$user->profile->country}}" />
            </div>
            <div class="col-md-4">
                <x-form.select label=" locale" type="text"  :options="$locales" name="locale" selected="{{$user->profile->locale}}" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary">save</button>
        
    </form>
@endsection
