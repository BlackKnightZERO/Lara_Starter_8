<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate([
            'title' => 'About',
            'slug' => 'about',
            'excerpt' => 'This is about page',
            'body' => '<h1>This is about page</h1>',
            'meta_description' => 'about description',
            'meta_keywords' => 'about, page',
            'status' => true
        ]);
    }
}
