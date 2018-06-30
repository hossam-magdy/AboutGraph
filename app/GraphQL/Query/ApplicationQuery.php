<?php

namespace App\GraphQL\Query;

use App\Models\Application;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class ApplicationQuery extends Query
{
    protected $attributes = [
        'name' => 'applications'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Application'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'product' => ['name' => 'product', 'type' => Type::listOf(GraphQL::type('Product'))],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $fields = $info->getFieldSelection(); // TODO use $depth
        $applications = Application::query();
        if (in_array('products', $fields)) {
            $applications->with('products');
        }
        if (isset($args['id'])) {
            return $applications->where('id', $args['id'])->get();
        } else if (isset($args['name'])) {
            return $applications->where('name', $args['name'])->get();
        } else {
            return $applications->get();
        }
    }
}
