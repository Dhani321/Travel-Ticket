@extends('index')

@section('title', 'Penumpang Jadwal')

@section('content')
<div class="card">
    <div class="card-header">
        Penumpang untuk Jadwal: {{ $schedule->route->start }} - {{ $schedule->route->end }} pada {{ $schedule->departure_time }}
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Penumpang</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->user->name }}</td>
                    <td>{{ $payment->user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection