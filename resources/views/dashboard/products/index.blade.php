@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('title')
products
@endsection

@section('content')
    <div>
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary mr-2">Create</a>
        
    </div>

    <x-alert />

    <form action="" method="get" class="d-flex justify-content-between mb-4">
        <select name="status" class="form-control mx-2">
            <option value="">All </option>
            <option value="active" @selected(request('status') == 'active')>active</option>
            <option value="archived" @selected(request('status') == 'archived')>archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>category </th>
                <th>store</th>
                <th>status</th>
                <th>created at</th>
                <th colspan="2">operitionas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post"
                            style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="9">no products found</th>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->withquerystring()->links() }}
@endsection
