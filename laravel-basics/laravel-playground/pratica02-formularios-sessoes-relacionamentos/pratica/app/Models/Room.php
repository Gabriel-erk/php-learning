<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Override;

class Room extends Model
{
    protected $fillable = [
        'name',
        'capacity'
    ];
    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'room_id'); // cada sala pode ter VÁRIAS reservas ligadas a ela
    }

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name', 'asc');
        });
    }
}
