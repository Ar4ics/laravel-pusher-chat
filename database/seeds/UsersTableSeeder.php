<?php

use App\User;
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
        //factory(User::class, 5)->create();
        $faker = Faker\Factory::create();
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => '1@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => '2@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => '3@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
