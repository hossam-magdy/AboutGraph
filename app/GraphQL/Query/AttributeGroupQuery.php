<?php

namespace App\GraphQL\Query;

use App\Models\AttributeGroup;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

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
        $query = AttributeGroup::query()->select(['attribute_groups.*']);

        if (isset($args['id'])) {
            $query->where('attribute_groups.id', $args['id'])->get();
        }
        if (isset($args['name'])) {
            $query->where('attribute_groups.name', 'LIKE', '%'.$args['name'].'%')->get();
        }
        if (isset($args['frontend_name'])) {
            $query->where('attribute_groups.frontend_name', 'LIKE', '%'.$args['frontend_name'].'%')->get();
        }
        $fields = $info->getFieldSelection(1);
        foreach ($fields as $field0 => $keys0) {
            if ($field0 === 'count_attributes') {
                $query->addSelect(DB::raw('(SELECT COUNT(*) FROM attributes AS a WHERE a.attribute_group_id = attribute_groups.id) AS count_attributes'));
            }
            if ($field0 === 'attributes') {
                $query->with('attributes');
            }
        }

        return $query->get();
    }
}
