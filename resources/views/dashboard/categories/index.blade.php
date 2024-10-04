@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('title')
    categories
@endsection

@section('content')
    <div>
        @if (Auth::user()->can('categories.create'))
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary mr-2">Create</a>
        @endif
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-dark">Trash</a>
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
                {{-- <th>image</th> --}}
                <th>parent</th>
                <th>product #</th>
                <th>status</th>
                <th>created at</th>
                <th colspan="2">operitionas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    {{-- <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="100"></td> --}}
                    <td>{{ $category->parent->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        @can('categories.update')
                            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('categories.update')
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post"
                                style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="9">no categories found</th>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->withquerystring()->links() }}
@endsection
