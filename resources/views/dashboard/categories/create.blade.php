@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('title')
    categories
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form')
    </form>
@endsection
