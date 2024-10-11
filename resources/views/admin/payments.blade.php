@extends('index')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="card">
    <div class="card-header">Verifikasi Pembayaran</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->user->name }}</td>
                    <td>{{ $payment->schedule->route->start }} - {{ $payment->schedule->route->end }} ({{ $payment->schedule->departure_time }})</td>
                    <td>{{ $payment->status }}</td>
                    <td>
                        @if($payment->status == 'pending')
                        <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection