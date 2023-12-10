<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => "groceries",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "housing",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "transportation",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "entertainment",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "health",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "education",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "bills",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "taxes",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "travel",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "personal care",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "other",
            'type' => "expense"
        ]);
        Category::create([
            'name' => "salary",
            'type' => "income"
        ]);
        Category::create([
            'name' => "investments",
            'type' => "income"
        ]);
        Category::create([
            'name' => "sales",
            'type' => "income"
        ]);
        Category::create([
            'name' => "pensions",
            'type' => "income"
        ]);
        Category::create([
            'name' => "grants",
            'type' => "income"
        ]);
        Category::create([
            'name' => "other sources",
            'type' => "income"
        ]);
    }
}
