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

    /**
     * Array with the name of the relations to delete in cascade
     * @var array
     */
    protected static $relationsCascade = ['numbers'];

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
