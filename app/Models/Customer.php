<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    const CUSTOMER_STATUS_OPTIONS = ['new', 'active', 'suspended', 'cancelled'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'document',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }
}
