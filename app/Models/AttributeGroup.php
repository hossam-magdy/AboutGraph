<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    public $name;

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
