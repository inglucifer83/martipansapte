<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder and seed 10 User instances.
     *
     * @return void
     */
    public function run()
    {
        
        
        User::factory()
        ->count(10)->create();
        
    }
}
