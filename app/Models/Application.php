<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $name
 */
class Application extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
