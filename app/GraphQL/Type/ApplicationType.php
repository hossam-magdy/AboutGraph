<?php

namespace App\GraphQL\Type;

use App\Models\Product;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;

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
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'url' => [
                'type' => Type::string(),
            ],
            'logo_url' => [
                'type' => Type::string(),
            ],
            'count_products' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'products' => [
                'type' => Type::listOf(GraphQL::type('Product')),
                'args' => [
                    'name' => ['type' => Type::string()],
                ],
            ],
        ];
    }

    public function resolveProductsField($root, $args)
    {
//        dump('ResolvingProductsField');
        /** @var Product[]|Collection $products */
        $products = $root->products;

        if (isset($args['id'])) {
            return $products->where('id', $args['id']);
        }
        if (isset($args['name'])) {
            return $products->filter(function (Product $product) use ($args) {
                return stristr($product->name, $args['name']) !== false;
            });
        }

        return $products;
    }

}