<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RoleSeeder');
        $this->call('UserSeeder');
    }

}

class RoleSeeder extends Seeder{
    public function run(){
        DB::table('roles')->insert([ //1
            'name' => "admin",
            'desc' => "",    
        ]);

        DB::table('roles')->insert([ //2
            'name' => "poweruser",
            'desc' => "",    
        ]);

        DB::table('roles')->insert([ //3
            'name' => "user",
            'desc' => "",    
        ]);
    }
}

class UserSeeder extends Seeder{
    public function run(){
        DB::table('users')->insert([ //1
            'name' => "admin",
            'phone_number' => '0000000000',
    
            'first_name' => fake()->name(),
            'last_name'  => fake()->name(),
    
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => "",

            'role_id' => 1,    
        ]);
    }
}

