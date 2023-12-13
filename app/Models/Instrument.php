<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $guarded= [];

    /**
     * Get the category that owns the instrument.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the instrument.
     */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
