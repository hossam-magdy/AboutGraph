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
class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A product'
    ];

    /*
    * Uncomment following line to make the type input object.
    * http://graphql.org/learn/schema/#input-types
    */
    // protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'name' => ['type' => Type::string()],
            'live' => ['type' => Type::boolean()],
            'attributes' => [
                'type' => Type::listOf(GraphQL::type('Attribute')),
                'args' => [
                    'name' => ['type' => Type::string()],
                ],
//                'privacy' => function () {} // https://github.com/rebing/graphql-laravel/blob/master/docs/advanced.md
            ],
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveAttributesField($root, $args)
    {
        /** @var Attribute[]|Collection $attributes */
        $attributes = $root->attributes;

        if (isset($args['id'])) {
            return $attributes->where('id', $args['id']);
        } else if (isset($args['name'])) {
            return $attributes->filter(function (Attribute $attribute) use ($args) {
                return stristr($attribute->name, $args['name']) !== false;
            });
        } else {
            return $attributes;
        }
    }

    protected function resolveLiveField($root, $args)
    {
        return (bool)($root->live);
    }
}