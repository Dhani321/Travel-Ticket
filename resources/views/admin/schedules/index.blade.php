@extends('index')

@section('title', 'Manage Jadwal')

@section('content')
<div class="card">
    <div class="card-header">Jadwal Keberangkatan</div>
    <div class="card-body">
        <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Armada</th>
                    <th>Rute</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->armada->name }}</td>
                    <td>{{ $schedule->route->start }} - {{ $schedule->route->end }}</td>
                    <td>{{ $schedule->departure_time }}</td>
                    <td>{{ $schedule->price }}</td>
                    <td>
                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.schedules.passengers', $schedule->id) }}" class="btn btn-info btn-sm">Lihat Penumpang</a>
                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
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