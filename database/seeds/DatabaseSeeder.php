<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $applications = factory(\App\Models\Application::class, random_int(5, 10))->create();
        $attributeGroups = factory(\App\Models\AttributeGroup::class, random_int(15, 25))
            ->create()
            ->each(
                function (\App\Models\AttributeGroup $ag) use (&$attributes) {
                    $ag->attributes()->saveMany(
                        factory(\App\Models\Attribute::class, random_int(5, 10))->make()
                    );
                }
            );
        $attributes = \App\Models\Attribute::all();
        $products = factory(\App\Models\Product::class, 50)
            ->create();
        $products->each(function (\App\Models\Product $p) use ($applications, $attributes) {
            $p->applications()->saveMany($applications);
            $count_all = $attributes->count();
            $count = random_int(0, $count_all / 2);
            $offset = random_int(0, $count_all - $count);
            $p->attributes()->saveMany($attributes->slice($offset, $count));
        });

    }
}
