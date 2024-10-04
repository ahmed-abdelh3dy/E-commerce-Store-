@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">categories</li>
    <li class="breadcrumb-item active">{{$categories->name}}</li>
@endsection

@section('title')
Edit categories
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.update',$categories->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.categories._form',[
            'buton_lable' => 'update'
        ])
    </form>
@endsection
