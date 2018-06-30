<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $identifier
 * @property $attribute_group_id
 */
class Attribute extends Model
{
    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }
}
