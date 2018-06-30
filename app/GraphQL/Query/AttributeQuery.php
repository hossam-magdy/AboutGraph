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
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
//        dump('ResolvingAttributeQuery');
        $query = Attribute::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        } else if (isset($args['name'])) {
            $query->where('name', 'LIKE', '%'.$args['name'].'%');
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
