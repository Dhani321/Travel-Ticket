@extends('index')

@section('title', $schedule->exists ? 'Edit Jadwal' : 'Tambah Jadwal')

@section('content')
<div class="card">
    <div class="card-header">{{ $schedule->exists ? 'Edit Jadwal' : 'Tambah Jadwal' }}</div>
    <div class="card-body">
        <form action="{{ $schedule->exists ? route('admin.schedules.update', $schedule->id) : route('admin.schedules.store') }}" method="POST">
            @csrf
            @if($schedule->exists)
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="armada_id">Armada</label>
                <select class="form-control" id="armada_id" name="armada_id" required>
                    @foreach($armadas as $armada)
                    <option value="{{ $armada->id }}" {{ $armada->id == old('armada_id', $schedule->armada_id) ? 'selected' : '' }}>
                        {{ $armada->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="route_id">Rute</label>
                <select class="form-control" id="route_id" name="route_id" required>
                    @foreach($routes as $route)
                    <option value="{{ $route->id }}" {{ $route->id == old('route_id', $schedule->route_id) ? 'selected' : '' }}>
                        {{ $route->start }} - {{ $route->end }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="departure_time">Waktu Keberangkatan</label>
                <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" value="{{ old('departure_time', $schedule->departure_time ? $schedule->departure_time->format('Y-m-d\TH:i') : '') }}" required>
            </div>
            <div class="form-group">
                <label for="departure_time">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $schedule->price ) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ $schedule->exists ? 'Update' : 'Tambah' }}</button>
        </form>
    </div>
</div>
@endsection