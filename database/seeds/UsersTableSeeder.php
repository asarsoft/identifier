<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    \App\User::create([
		    'role_id' => "1",

		    'email' => 'admin@asarsoft.com',
		    'slug' => "admin",

		    'name' => "Admin",

		    'email_verified_at' => \Carbon\Carbon::now(),
		    'confirmed_at' => \Carbon\Carbon::now(),

		    'password' => \Illuminate\Support\Facades\Hash::make('Asar55soft77ware'),
	    ]);

    }
}
