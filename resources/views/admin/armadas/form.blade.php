@extends('index')

@section('title', $armada->exists ? 'Edit Armada' : 'Tambah Armada')

@section('content')
<div class="card mt-4">
    <div class="card-header bg-primary text-white">{{ $armada->exists ? 'Edit Armada' : 'Tambah Armada' }}</div>
    <div class="card-body">
        <form action="{{ $armada->exists ? route('admin.armadas.update', $armada->id) : route('admin.armadas.store') }}" method="POST">
            @csrf
            @if($armada->exists)
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Nama Armada</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $armada->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">{{ $armada->exists ? 'Update' : 'Tambah' }}</button>
        </form>
    </div>
</div>

@endsection