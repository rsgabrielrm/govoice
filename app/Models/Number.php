<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Number extends Model
{
    use SoftDeletes;

    const NUMBER_STATUS_OPTIONS = ['active', 'suspended', 'cancelled'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'number',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function numberPreferences()
    {
        return $this->hasMany(NumberPreference::class);
    }
}
