<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = "reservations";
    public $timestamps = true;
    // Define qué campos se pueden llenar automáticamente
    protected $fillable = [
        'status',
        'user_id',
        'event_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
