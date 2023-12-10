<?php

namespace Database\Seeders;

use App\Models\Pay_Method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pay_Method::create([
            'name' => "cash",
        ]);

        Pay_Method::create([
            'name' => "card",
        ]);

    }
}
