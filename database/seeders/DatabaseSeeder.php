<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
