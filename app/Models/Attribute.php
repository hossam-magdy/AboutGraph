<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $name;

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }
}
