<?php

namespace App\GraphQL\Query;

use App\Models\Application;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class ApplicationQuery extends Query
{
    protected $attributes = [
        'name' => 'applications'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Application'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'products' => [
                'name' => 'products',
                'type' => Type::listOf(GraphQL::type('Product')),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
//        dump('ResolvingApplicationQuery');
        $query = Application::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        } else if (isset($args['name'])) {
            $query->where('name', 'LIKE', '%'.$args['name'].'%');
        }

        $fields = $info->getFieldSelection(3); // TODO update $depth for best fit
        foreach ($fields as $field0 => $keys) {
            if ($field0 === 'products') {
                $query->with('products');
//                foreach ($keys as $field1 => $keys1) {
////                $query->leftJoin('application_product AS ap', 'ap.application_id', '=', 'a.id');
////                $query->leftJoin('products AS p', 'ap.product_id', '=', 'p.id');
////                dump($keys);
//
////                $query->addSelect(DB::raw())
//                    $query->with(['products' => function (BelongsToMany $products) use ($keys1) {
//                        $products->where('live', '=', 1);
//                        if (!empty($keys1['name'])) {
//                            $products->where('name', 'LIKE', '%'.$keys1['name'].'%');
//                        }
////                    $products->where('live','=', 1); // TODO: dynamic conditions
//                    }]);
//                }
            }
        }

        return $query->get();
    }
}
