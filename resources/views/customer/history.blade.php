@extends('indexCustomer')

@section('title', 'Riwayat Pembelian Tiket')

@section('content')
<div class="card">
    <div class="card-header">Riwayat Pembelian Tiket</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Armada</th>
                    <th>Rute</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->schedule->armada->name }}</td>
                    <td>{{ $payment->schedule->route->start }} - {{ $payment->schedule->route->end }}</td>
                    <td>{{ $payment->schedule->departure_time }}</td>
                    <td>{{ ucfirst($payment->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection