@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">roles</li>
    <li class="breadcrumb-item active">{{$role->names}}</li>
@endsection

@section('title')
Edit roles
@endsection

@section('content')
    <form action="{{ route('dashboard.roles.update',$role->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.roles._form',[
            'buton_lable' => 'update'
        ])
    </form>
@endsection
