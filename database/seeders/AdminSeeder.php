<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeder and seed 11 Admin instances.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
			'name' => 'Admin',
			'email' => 'admin@prettyshop.com',
			'password' => Hash::make('admin')
		]);

		$admin->assignRole('SuperAdmin');

        
        
    }
}
