<?php

namespace App\GraphQL\Query;

use App\Models\Product;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
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
            'live' => ['name' => 'url', 'type' => Type::boolean()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
//        dump('ResolvingProductQuery');
        $query = Product::query()->where('deleted', '=', 0);

        if (isset($args['id'])) {
            $query->where('id', $args['id'])->get();
        }
        if (isset($args['name'])) {
            $query->where('name', 'LIKE', '%'.$args['name'].'%')->get();
        }

        $fields = $info->getFieldSelection(); // TODO use $depth
        foreach ($fields as $field => $keys) {
            if ($field === 'attributes') {
                $query->with('attributes');
            }
        }

        return $query->get();
    }
}
