<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Name:');
        $email = $this->ask('Email:');
        $password = $this->ask('Password:');
        $admin = new Admin(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $admin->save();
    }
}