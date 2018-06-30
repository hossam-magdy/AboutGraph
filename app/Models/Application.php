<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $url
 * @property $logo_url
 */
class Application extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'application_products');
    }
}
