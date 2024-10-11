@extends('index')

@section('title', $route->exists ? 'Edit Rute' : 'Tambah Rute')

@section('content')
<div class="card">
    <div class="card-header">{{ $route->exists ? 'Edit Rute' : 'Tambah Rute' }}</div>
    <div class="card-body">
        <form action="{{ $route->exists ? route('admin.routes.update', $route->id) : route('admin.routes.store') }}" method="POST">
            @csrf
            @if($route->exists)
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="start">Start</label>
                <input type="text" class="form-control" id="start" name="start" value="{{ old('start', $route->start) }}" required>
            </div>
            <div class="form-group">
                <label for="end">End</label>
                <input type="text" class="form-control" id="end" name="end" value="{{ old('end', $route->end) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ $route->exists ? 'Update' : 'Tambah' }}</button>
        </form>
    </div>
</div>
@endsection