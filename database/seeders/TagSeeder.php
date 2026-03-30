<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeder and seed 10 Tag instances.
     *
     * @return void
     */
    public function run()
    {
        
        
        Tag::factory()
        ->count(10)->create();
        
    }
}
