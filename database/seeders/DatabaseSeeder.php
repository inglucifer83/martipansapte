<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        config()->set('database.connections.mysql.strict', false);
        DB::reconnect();
        
		DB::table('langs')->insert([
			['name' => 'English', 'code' => 'en_US', 'default' => 0, 'created_at' => now(), 'updated_at' => now()],
			['name' => 'Italian', 'code' => 'it_IT', 'default' => 1, 'created_at' => now(), 'updated_at' => now()]
		]);

        $this->call([
            PermissionsSeeder::class,
			UserSeeder::class,
			TagSeeder::class,
			AdminSeeder::class,
			CategorySeeder::class,
			CartSeeder::class,
			OrderSeeder::class
        ]);

        config()->set('database.connections.mysql.strict', true);
        DB::reconnect();
    }
}
