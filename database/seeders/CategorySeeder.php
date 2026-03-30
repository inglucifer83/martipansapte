<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeder and seed 10 Category instances.
     *
     * @return void
     */
    public function run()
    {
        
        
        Category::factory()
        ->count(10)->has(Product::factory()->count(5), 'products')
			->create();
        
    }
}
