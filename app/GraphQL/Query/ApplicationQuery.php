<?php

namespace App\GraphQL\Query;

use App\Models\Application;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
//        dump('ResolvingApplicationQuery');
        $query = Application::query()->select(['applications.*']);

        if (isset($args['id'])) {
            $query->where('applications.id', $args['id']);
        }
        if (isset($args['name'])) {
            $query->where('applications.name', 'LIKE', '%'.$args['name'].'%');
        }

        $fields = $info->getFieldSelection(2);
        foreach ($fields as $field0 => $keys0) {
            if ($field0 === 'products') {
                $withProducts = function (BelongsToMany $query) {
                    $query->where('products.deleted', '=', 0);
                };
                $query->with(['products' => $withProducts]);
                foreach ($keys0 as $field1 => $keys1) {
                    if ($field1 === 'attributes') {
                        $query->with(['products' => $withProducts, 'products.attributes']);
                        foreach ($keys1 as $field2 => $keys2) {
                            if ($field2 === 'attribute_group') {
                                $query->with(['products' => $withProducts, 'products.attributes.attributeGroup']);
                            }
                        }
                    }
                }
            }
            if ($field0 === 'count_products') {
                $query->addSelect(DB::raw('(SELECT COUNT(*) FROM application_products AS ap LEFT JOIN products AS tmp_p ON tmp_p.id = ap.product_id WHERE ap.application_id = applications.id AND tmp_p.deleted = 0) AS count_products'));
            }
        }

        return $query->get();
    }
}
