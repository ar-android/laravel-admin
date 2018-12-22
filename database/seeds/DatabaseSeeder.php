<?php

use App\UserRole;
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
    	UserRole::truncate();
    	UserRole::create(['name' => 'Admin']);
    	UserRole::create(['name' => 'Member']);
        // $this->call(UsersTableSeeder::class);
    }
}
