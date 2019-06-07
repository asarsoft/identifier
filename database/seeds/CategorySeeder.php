<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'title' => "Web",
        ]);

         \App\Models\CategoryDetail::create([
            'name' => "Web",
            'description' => "Web Application",
            'language_id' => "1",
            'category_id' => "1",
        ]);
    }
}
