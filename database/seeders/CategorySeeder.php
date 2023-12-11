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
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/ingredients.png"
        ]);
        Category::create([
            'name' => "housing",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/home-page.png"
        ]);
        Category::create([
            'name' => "transportation",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/subway.png"
        ]);
        Category::create([
            'name' => "entertainment",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/popcorn.png"
        ]);
        Category::create([
            'name' => "gym",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/strength.png"
        ]);
        Category::create([
            'name' => "mobile phone",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/iphone.png"
        ]);
        Category::create([
            'name' => "health",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/heart-with-pulse--v1.png"
        ]);
        Category::create([
            'name' => "education",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/book-stack.png"
        ]);
        Category::create([
            'name' => "bills",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/receipt-and-change.png"
        ]);
        Category::create([
            'name' => "taxes",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/income-tax.png"
        ]);
        Category::create([
            'name' => "travel",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/airplane-take-off.png"
        ]);
        Category::create([
            'name' => "personal care",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/welfare.png"
        ]);
        Category::create([
            'name' => "other",
            'type' => "expense",
            'icon_url'=>"https://img.icons8.com/ios/50/product--v1.png"
        ]);
        Category::create([
            'name' => "salary",
            'type' => "income",
            'icon_url'=>"https://img.icons8.com/ios/50/money-transfer.png"
        ]);
        Category::create([
            'name' => "investment",
            'type' => "income",
            'icon_url'=>"https://img.icons8.com/ios/50/sales-performance-balance.png"
        ]);
        Category::create([
            'name' => "sales",
            'type' => "income",
            'icon_url'=>"https://img.icons8.com/ios/50/sell.png"
        ]);
        Category::create([
            'name' => "pension",
            'type' => "income",
            'icon_url'=>"https://img.icons8.com/external-line512-zulfa-mahendra/50/external-retirement-saving-and-investment-line512-zulfa-mahendra.png"
        ]);
        Category::create([
            'name' => "savings",
            'type' => "income",
            'icon_url'=>"https://img.icons8.com/ios/50/money-box--v1.png"
        ]);
        Category::create([
            'name' => "other sources",
            'type' => "income",
            'icon_url'=>"https://img.icons8.com/ios/50/money--v1.png"
        ]);
    }
}
