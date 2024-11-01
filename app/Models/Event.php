<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{

    protected $table = "events";
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'date_start',
        'date_end',
        'location',
        'max_slots',
        'occupied_slots',
        'status'
    ];

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class, 'event_id', 'id');
    }


}
