<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $frontend_name
 */
class AttributeGroup extends Model
{
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
