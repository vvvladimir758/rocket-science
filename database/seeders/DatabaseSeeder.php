<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Property;
use App\Models\ProductProperty;
use App\Models\PropertyOption;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $products = Product::factory(10)->create();
        $properties = Property::factory(10)->create();

        foreach ($properties as $property){
          PropertyOption::firstOrCreate([
            'property_id' => $property->id,
            'int_val' => rand(0, 999),
            'text_val' => fake()->word
          ]);
        }

        foreach ($products as $product) {
            ProductProperty::firstOrCreate([
                'product_id' => $product->id,
                'property_option_id' => rand(1, PropertyOption::count())
            ]);
        }
    }
}
