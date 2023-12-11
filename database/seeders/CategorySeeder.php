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
            'icon_url'=>"https://iconos8.es/icon/7621/ingredientes"
        ]);
        Category::create([
            'name' => "housing",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/53382/p%C3%A1gina-principal"
        ]);
        Category::create([
            'name' => "transportation",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/16556/subterr%C3%A1neo"
        ]);
        Category::create([
            'name' => "entertainment",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/62370/palomitas"
        ]);
        Category::create([
            'name' => "gym",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/oRBt2rHxvhPg/fortaleza"
        ]);
        Category::create([
            'name' => "mobile phone",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/79/iphone"
        ]);
        Category::create([
            'name' => "health",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/35583/coraz%C3%B3n-con-pulso"
        ]);
        Category::create([
            'name' => "education",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/37815/pila-de-libros"
        ]);
        Category::create([
            'name' => "bills",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/85646/recibo-y-cambio"
        ]);
        Category::create([
            'name' => "taxes",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/Y694RNOaBIG2/impuesto-sobre-la-renta"
        ]);
        Category::create([
            'name' => "travel",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/2487/despegue"
        ]);
        Category::create([
            'name' => "personal care",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/78801/bienestar"
        ]);
        Category::create([
            'name' => "other",
            'type' => "expense",
            'icon_url'=>"https://iconos8.es/icon/12091/producto"
        ]);
        Category::create([
            'name' => "salary",
            'type' => "income",
            'icon_url'=>"https://iconos8.es/icon/56220/mont%C3%B3n-de-dinero"
        ]);
        Category::create([
            'name' => "investment",
            'type' => "income",
            'icon_url'=>"https://iconos8.es/icon/woBZ9ziilgxi/balance-rendimiento-ventas"
        ]);
        Category::create([
            'name' => "sale",
            'type' => "income",
            'icon_url'=>"https://iconos8.es/icon/xgzck7TcTBcj/recibir-cambio"
        ]);
        Category::create([
            'name' => "pension",
            'type' => "income",
            'icon_url'=>"https://iconos8.es/icon/eNLixBqHsYhd/pension"
        ]);
        Category::create([
            'name' => "savings",
            'type' => "income",
            'icon_url'=>"https://iconos8.es/icon/2975/caja-de-dinero"
        ]);
        Category::create([
            'name' => "other sources",
            'type' => "income",
            'icon_url'=>"https://iconos8.es/icon/2806/dinero"
        ]);
    }
}
