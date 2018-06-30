<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $name;

    public function applications()
    {
        return $this->belongsToMany(Application::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
