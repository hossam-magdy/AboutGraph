<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;
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
            ]
        ];
    }
}