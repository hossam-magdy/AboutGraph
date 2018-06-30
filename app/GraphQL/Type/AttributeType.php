<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\Type;

/**
 * @author Hossam Magdy <hossam.magdy@aboutyou.de>
 */
class AttributeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Attribute',
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
            'name' => [
                'type' => Type::string(),
            ],
            'attribute_group_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'attribute_group' => [
                'type' => GraphQL::type('AttributeGroup'),
            ],
        ];
    }

    protected function resolveAttributeGroupField($root, $args)
    {
        // TODO: all fields/columns are queried from db regardless the requested/predefined fields
//        dump('resolveAttributeGroupField', $root);
        return $root->attributeGroup;
    }

}