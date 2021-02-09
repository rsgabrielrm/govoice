<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Number extends Model
{
    use HasFactory, SoftDeletes;

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

    /**
     * Array with the name of the relations to delete in cascade
     * @var array
     */
    protected static $relationsCascade = ['numberPreferences'];

    protected static function booted()
    {
        static::deleting(function($resource) {
            foreach (static::$relationsCascade as $relation) {
                foreach ($resource->{$relation}()->get() as $item) {
                    $item->delete();
                }
            }
        });
    }
}
