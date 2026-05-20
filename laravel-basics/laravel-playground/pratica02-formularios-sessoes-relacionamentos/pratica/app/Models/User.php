<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Override;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    protected $with = ['reserves'];
    public function reserves()
    {
        $this->hasMany(Reserve::class, 'user_id');
    }

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name', 'asc');
        });
    }
}
