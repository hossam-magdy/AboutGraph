<?php

namespace App\GraphQL\Query;

use App\Models\Application;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

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
            'products' => ['name' => 'products', 'type' => Type::listOf(GraphQL::type('Product'))],
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

        $fields = $info->getFieldSelection(2); // TODO update $depth for best fit
//        if (in_array('products', $fields)) {
//            $query->with('products');
//        }

        foreach ($fields as $field => $keys) {
            if ($field === 'products') {
//                foreach ($keys as $field => $keys) {
//
//                }
//                $query->leftJoin('application_product AS ap', 'ap.application_id', '=', 'a.id');
//                $query->leftJoin('products AS p', 'ap.product_id', '=', 'p.id');
//                dump($keys);

//                $query->addSelect(DB::raw())
                $query->with('products');
            }
        }

        return $query->get();
    }
}
