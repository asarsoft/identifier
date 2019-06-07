<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Language::create([
            'name' => "English",
            'accept_language' => 'en',
            'is_active' => true,
        ]);
    }
}
