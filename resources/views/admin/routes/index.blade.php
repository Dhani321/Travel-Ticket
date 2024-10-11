@extends('index')

@section('title', 'Manage Rute')

@section('content')
<div class="card">
    <div class="card-header">Rute</div>
    <div class="card-body">
        <a href="{{ route('admin.routes.create') }}" class="btn btn-primary mb-3">Tambah Rute</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Start</th>
                    <th>End</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                <tr>
                    <td>{{ $route->start }}</td>
                    <td>{{ $route->end }}</td>
                    <td>
                        <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection