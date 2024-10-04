@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">categories</li>
    <li class="breadcrumb-item active">Edit categories</li>
@endsection

@section('title')
Edit categories
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>name</th>
            <th>store</th>
            <th>status</th>
            <th>created at</th>
        </tr>
    </thead>
    <tbody>
        @php
            $products = $category->products()->with('store')->latest()->paginate(5);
        @endphp
        @forelse ( $products as $product)
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->store->name }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
            </tr>
        @empty
            <tr>
                <th colspan="9">no products found</th>
            </tr>
        @endforelse
    </tbody>
</table>

{{$products->links()}}
@endsection
