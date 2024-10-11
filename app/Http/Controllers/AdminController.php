<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armada;
use App\Models\Route;
use App\Models\Schedule;
use App\Models\Payment;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Armada management
    public function indexArmadas()
    {
        $armadas = Armada::all();
        return view('admin.armadas.index', compact('armadas'));
    }

    public function createArmada()
    {
        return view('admin.armadas.form', ['armada' => new Armada]);
    }

    public function storeArmada(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Armada::create($request->only('name'));
        session()->flash('success', 'Armada created successfully');

        return redirect()->route('admin.armadas.index');
    }

    public function editArmada(Armada $armada)
    {
        return view('admin.armadas.form', compact('armada'));
    }

    public function updateArmada(Request $request, Armada $armada)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $armada->update($request->only('name'));
        session()->flash('success', 'Armada updated successfully');

        return redirect()->route('admin.armadas.index');
    }

    public function destroyArmada(Armada $armada)
    {
        $armada->delete();
        session()->flash('success', 'Armada deleted successfully');
        return redirect()->route('admin.armadas.index');
    }

    // Route management
    public function indexRoutes()
    {
        $routes = Route::all();
        return view('admin.routes.index', compact('routes'));
    }

    public function createRoute()
    {
        return view('admin.routes.form', ['route' => new Route]);
    }

    public function storeRoute(Request $request)
    {
        $request->validate([
            'start' => 'required|string|max:255',
            'end' => 'required|string|max:255',
        ]);

        Route::create($request->only(['start', 'end']));
        session()->flash('success', 'Route created successfully');

        return redirect()->route('admin.routes.index');
    }

    public function editRoute(Route $route)
    {
        return view('admin.routes.form', compact('route'));
    }

    public function updateRoute(Request $request, Route $route)
    {
        $request->validate([
            'start' => 'required|string|max:255',
            'end' => 'required|string|max:255',
        ]);

        $route->update($request->only(['start', 'end']));
        session()->flash('success', 'Route updated successfully');
        return redirect()->route('admin.routes.index');
    }

    public function destroyRoute(Route $route)
    {
        $route->delete();
        session()->flash('success', 'Route deleted successfully');
        return redirect()->route('admin.routes.index');
    }

    // Schedule management
    public function indexSchedules()
    {
        $schedules = Schedule::with(['armada', 'route'])->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function createSchedule()
    {
        $armadas = Armada::all();
        $routes = Route::all();
        return view('admin.schedules.form', ['armadas' => $armadas, 'routes' => $routes, 'schedule' => new Schedule]);
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'armada_id' => 'required|exists:armadas,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'price' => 'required|numeric',
        ]);

        Schedule::create($request->only(['armada_id', 'route_id', 'departure_time', 'price']));
        session()->flash('success', 'Schedule created successfully');
        return redirect()->route('admin.schedules.index');
    }

    public function editSchedule(Schedule $schedule)
    {
        $armadas = Armada::all();
        $routes = Route::all();
        $price = $schedule->price;
        return view('admin.schedules.form', compact('armadas', 'routes', 'schedule', 'price'));
    }

    public function updateSchedule(Request $request, Schedule $schedule)
    {
        $request->validate([
            'armada_id' => 'required|exists:armadas,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'price' => 'required|numeric',
        ]);

        $schedule->update($request->only(['armada_id', 'route_id', 'departure_time', 'price']));
        session()->flash('success', 'Schedule updated successfully');
        return redirect()->route('admin.schedules.index');
    }

    public function destroySchedule(Schedule $schedule)
    {
        $schedule->delete();
        session()->flash('success', 'Schedule deleted successfully');
        return redirect()->route('admin.schedules.index');
    }

    // Payment verification
    public function payments()
    {
        $payments = Payment::with(['user', 'schedule.route'])->where('status', 'pending')->get();
        return view('admin.payments', compact('payments'));
    }

    public function verifyPayment(Payment $payment)
    {
        $payment->update(['status' => 'verified']);
        session()->flash('success', 'Payment verified successfully');
        return redirect()->route('admin.payments');
    }

    // View passengers
    public function viewPassengers(Schedule $schedule)
    {
        $payments = Payment::where('schedule_id', $schedule->id)->where('status', 'verified')->with('user')->get();
        return view('admin.schedules.passengers', compact('schedule', 'payments'));
    }
}
