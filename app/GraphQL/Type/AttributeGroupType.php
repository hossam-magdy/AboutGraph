<?php

namespace App\GraphQL\Type;

use App\Models\Attribute;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;

/**
 * @author Hossam Magdy <hossam.magdy@aboutyou.de>
 */
class AttributeGroupType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Attribute Group',
        'description' => 'An attribute'
    ];

    /*
    * Uncomment following line to make the type input object.
    * http://graphql.org/learn/schema/#input-types
    */
    // protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'attribute_group_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'frontend_name' => [
                'type' => Type::string(),
            ],
            'count_attributes' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'attributes' => [
                'type' => Type::listOf(GraphQL::type('Attribute')),
                'args' => [
                    'id' => ['type' => Type::int()],
                    'name' => ['type' => Type::string()],
                ],
            ],
        ];
    }

    protected function resolveAttributesField($root, $args)
    {
//        dump('resolveAttributesField');
        /** @var Attribute[]|Collection $attributes */
        $attributes = $root->attributes;

        if (isset($args['id'])) {
            return $attributes->where('id', $args['id']);
        }
        if (isset($args['name'])) {
            return $attributes->filter(function (Attribute $product) use ($args) {
                return stristr($product->name, $args['name']) !== false;
            });
        }

        return $attributes;
    }

}