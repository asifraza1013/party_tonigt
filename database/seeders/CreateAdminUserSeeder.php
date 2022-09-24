<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Admin',
        	'email' => 'admin@tonightParty.com',
        	'phone' => '03206499263',
        	'status' => 1,
        	'password' => bcrypt('admin')
        ]);
    }
}
