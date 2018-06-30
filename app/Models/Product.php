<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $live
 */
class Product extends Model
{
    public function applications()
    {
        return $this->belongsToMany(Application::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_products');
    }
}
