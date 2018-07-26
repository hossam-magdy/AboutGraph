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
        return $this->belongsToMany(Application::class, 'application_products')->limit(Config::get('app.graphql_rel_limit'));
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_products')->limit(Config::get('app.graphql_rel_limit'));
    }
}
