<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
        return $this->hasMany(Reserve::class, 'user_id');
    }

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name', 'asc');
        });
    }
}
