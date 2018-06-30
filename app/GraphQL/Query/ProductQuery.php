<?php

namespace App\GraphQL\Query;

use App\Models\Application;
use App\Models\Product;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

class ProductQuery extends Query
{
    protected $attributes = [
        'name' => 'products'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Product'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Product::where('id', $args['id'])->get();
        } else if (isset($args['name'])) {
            return Product::where('name', $args['name'])->get();
        } else {
            return Product::all();
        }
    }
}
