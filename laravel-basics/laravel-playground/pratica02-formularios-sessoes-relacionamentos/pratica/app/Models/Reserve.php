<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Override;

class Reserve extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'reserve_date',
        'start_time',
        'end_time',
        'observation'
    ];
    protected $with = [
        'room'
    ];
    // cada reserva possui apenas UM usuário, possui vínculo com apenas UM usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // cada reserva possui vínculo com apenas UM quarto room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('start_time', 'asc');
        });
    }
}
