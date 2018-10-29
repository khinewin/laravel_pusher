<?php

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
        // $this->call(UsersTableSeeder::class);
        DB::table('posts')->insert([
            'content' => "Of course, manually specifying the attributes for each model seed is cumbersome. Instead, you can use model factories to conveniently generate large amounts of database records. First, review the model factory documentation to learn how to define your factories. Once you have defined your factories, you may use the factory helper function to insert records into your database.",
            'user_id'=>1
        ]);
        DB::table('posts')->insert([
            'content' => "Of course,  for each model seed is cumbersome. Instead, you can use model factories to conveniently generate large amounts of database records. First, review the model factory documentation to learn how to define your factories. Once you have defined your factories, you may use the factory helper function to insert records into your database.",
            'user_id'=>2
        ]);
        DB::table('posts')->insert([
            'content' => "Of course, manually specifying the attributes for each model seed is cumbersome. Instead, you can use model factories to conveniently generate large amounts of database records. First, review the model factory documentation to learn how to define your factories. Once you have defined your factories, you may use the factory helper function to insert records into your database.",
            'user_id'=>1
        ]);
        DB::table('posts')->insert([
            'content' =>"Of course, manually specifying the attributes for each model seed is cumbersome. Instead, you can use model factories to conveniently generate large amounts the model factory documentation to learn how to define your factories. Once you have defined your factories, you may use the factory helper function to insert records into your database.",
            'user_id'=>2
        ]);
    }
}
