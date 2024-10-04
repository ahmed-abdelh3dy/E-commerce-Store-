@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('title')
    roles
@endsection

@section('content')
    <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.roles._form')
    </form>
@endsection
