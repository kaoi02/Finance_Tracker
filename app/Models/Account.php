<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'balance',
        'currency_code',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
