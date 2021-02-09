<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NumberPreference extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_id',
        'auto_attendant',
        'voicemail_enabled',
        'name',
        'value',
    ];

    public function number()
    {
        return $this->belongsTo(Number::class);
    }

}
