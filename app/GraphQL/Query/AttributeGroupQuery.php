<?php

namespace App\GraphQL\Query;

use App\Models\AttributeGroup;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class AttributeGroupQuery extends Query
{
    protected $attributes = [
        'name' => 'attribute_groups'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('AttributeGroup'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'frontend_name' => ['name' => 'frontend_name', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $query = AttributeGroup::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id'])->get();
        }
        if (isset($args['name'])) {
            $query->where('name', 'LIKE', '%'.$args['name'].'%')->get();
        }
        if (isset($args['frontend_name'])) {
            $query->where('frontend_name', 'LIKE', '%'.$args['frontend_name'].'%')->get();
        }

        $fields = $info->getFieldSelection(); // TODO use $depth
        if (in_array('attributes', $fields)) {
            $query->with('attributes');
        }

        return $query->get();
    }
}
