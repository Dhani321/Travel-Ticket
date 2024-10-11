<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function schedules()
    {
        $schedules = Schedule::with(['armada', 'route'])->get();
        return view('customer.schedules', compact('schedules'));
    }

    public function storePayment(Request $request)
    {
        // Validasi input
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        // Buat pembayaran
        Payment::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'status' => 'pending',
        ]);

        // Flash message untuk memberitahu bahwa pembayaran berhasil
        session()->flash('success', 'Payment successful');

        // Redirect kembali ke dashboard
        return redirect()->route('customer.dashboard');
    }

    public function history()
    {
        // Ambil data pembayaran jika tersedia
        $payments = Payment::where('user_id', Auth::id())->with('schedule.route', 'schedule.armada')->get();

        // Kirim data pembayaran ke view
        return view('customer.history', compact('payments'));
    }
}
