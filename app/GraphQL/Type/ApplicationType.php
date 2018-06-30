<?php

namespace App\GraphQL\Type;

use App\Models\Application;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * @author Hossam Magdy <hossam.magdy@aboutyou.de>
 */
class ApplicationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Application',
        'description' => 'A shop'
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
//                'description' => 'The id of the application'
            ],
            'name' => [
                'type' => Type::string(),
//                'description' => 'The name of the application'
            ],
            'products' => [
                'type' => Type::listOf(GraphQL::type('Product')),
//                'description' => 'The name of the application'
            ],
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
//    protected function resolveNameField($root, $args)
//    {
//        return strtolower($root->name);
//    }

//    public function resolve($root, $args, $context, ResolveInfo $info)
//    {
////        $fields = $info->getFieldSelection();
//
////        $applications = Application::query();
////
////        foreach ($fields as $field => $keys) {
////            if ($field === 'products') {
////                $applications->with('products');
////            }
////        }
//
//        return Application::all();
//    }
}