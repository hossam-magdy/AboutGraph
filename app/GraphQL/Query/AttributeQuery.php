<?php

namespace App\GraphQL\Query;

use App\Models\Attribute;
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
            'identifier' => ['name' => 'identifier', 'type' => Type::string()],
            'attribute_group_level' => ['name' => 'attribute_group_level', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
//        dump('ResolvingAttributeQuery');
        $query = Attribute::query()->select(['attributes.*']); // to avoid select attGr.id in case if "attribute_group_level" argument

        if (isset($args['id'])) {
            $query->where('attributes.id', $args['id']);
        }
        if (isset($args['name'])) {
            $query->where('attributes.name', 'LIKE', '%'.$args['name'].'%');
        }
        if (isset($args['attribute_group_level'])) {
            $query->leftJoin('attribute_groups AS ag', 'ag.id', '=', 'attributes.attribute_group_id');
            $query->where('ag.level', '=', $args['attribute_group_level']);
        }

        $fields = $info->getFieldSelection();
        foreach ($fields as $field => $key) {
            if ($field === 'attribute_group') {
                $query->with('attributeGroup');
            }
        }

        return $query->get();
    }
}
