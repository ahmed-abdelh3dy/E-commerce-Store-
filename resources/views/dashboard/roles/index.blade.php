@extends('layouts.dashboard')


@section('breadcrumb')
    @parent

    <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('title')
    roles
@endsection

@section('content')
    <div>
            <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary mr-2">Create</a>
        
    </div>

    <x-alert />



    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>created at</th>
                <th colspan="2">operitionas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td><a href="{{ route('dashboard.roles.edit', $role->id) }}">{{ $role->names }}</a></td>
                    <td>{{ $role->created_at }}</td>
                    <td>
                        @can('roles.update')
                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('roles.update')
                            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post"
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
                    <th colspan="4">no roles found</th>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $roles->withquerystring()->links() }}
@endsection
