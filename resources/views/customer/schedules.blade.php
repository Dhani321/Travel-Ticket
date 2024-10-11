@extends('indexCustomer')

@section('title', 'Jadwal Keberangkatan')

@section('content')
<div class="card">
    <div class="card-header">Jadwal Keberangkatan</div>
    <div class="card-body">
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
                        <form action="{{ route('customer.payments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                            <button type="submit" class="btn btn-primary btn-sm">Beli Tiket</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection