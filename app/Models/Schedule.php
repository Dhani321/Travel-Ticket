<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['armada_id', 'route_id', 'departure_time', 'price'];

    protected $dates = ['departure_time'];

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function getDepartureTimeAttribute($value)
    {
        return Carbon::parse($value);
    }
}
