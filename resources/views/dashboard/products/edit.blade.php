@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    {{-- <li class="breadcrumb-item active">categories</li>
    <li class="breadcrumb-item active">{{$categories->name}}</li> --}}
@endsection

@section('title')
Edit categories
@endsection

@section('content')
<form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('patch')
        @include('dashboard.products._form',[
            'buton_lable' => 'save'
        ])
    </form>
@endsection
