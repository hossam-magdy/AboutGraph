<?php

namespace App\GraphQL\Query;

use App\Models\Product;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class AttributeQuery extends Query
{
    protected $attributes = [
        'name' => 'attributes'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Attribute'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
//        dump('ResolvingProductQuery');
        $query = Product::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id'])->get();
        } else if (isset($args['name'])) {
            $query->where('name', 'LIKE', '%'.$args['name'].'%')->get();
        }

        $fields = $info->getFieldSelection(); // TODO use $depth
        if (in_array('attributes', $fields)) {
            $query->with('attributes');
        }

        return $query->get();
    }
}
