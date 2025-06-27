<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $bg = ['bg-blue-200', 'bg-green-100', 'bg-yellow-100', 'bg-red-200', 'bg-purple-200', 'bg-pink-100'];
        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
            'color' => $bg[random_int(0, count($bg)-1)]
        ]);
        Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'color' => $bg[random_int(0, count($bg)-1)]
        ]);
        Category::create([
            'name' => 'UI/UX Design',
            'slug' => 'ui-ux-design',
            'color' => $bg[random_int(0, count($bg)-1)]
        ]);
        Category::create([
            'name' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
            'color' => $bg[random_int(0, count($bg)-1)]
        ]);
        Category::create([
            'name' => 'Machine Learning',
            'slug' => 'machine-learning',
            'color' => $bg[random_int(0, count($bg)-1)]
        ]);
        Category::create([
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
            'color' => $bg[random_int(0, count($bg)-1)]
        ]);
    }
}
