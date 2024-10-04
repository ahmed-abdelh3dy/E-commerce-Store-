@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item ">Starter Page</li>
    <li class="breadcrumb-item active">Trashe</li>
@endsection

@section('title')
    Trashed categories
@endsection

@section('content')
    <div>
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary">Back</a>
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
                <th>image</th>
                <th>status</th>
                <th>deleted at</th>
                <th colspan="2">operitionas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="100"></td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post"
                            style="display:inline;">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-info">restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.forceDelete', $category->id) }}" method="post"
                            style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">ForceDelete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="7">no categories found</th>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->withquerystring()->links() }}
@endsection
