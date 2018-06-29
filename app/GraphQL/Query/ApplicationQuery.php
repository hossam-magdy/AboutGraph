<?php

namespace App\GraphQL\Query;

use App\Models\Application;
use Folklore\GraphQL\Support\Query;
use GraphQL;
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
            'name' => ['name' => 'name', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Application::where('id', $args['id'])->get();
        } else if (isset($args['name'])) {
            return Application::where('name', $args['name'])->get();
        } else {
            return Application::all();
        }
    }
}
