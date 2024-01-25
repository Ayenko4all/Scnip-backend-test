<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        $products = json_decode(file_get_contents('database/data/products.json'), true);

        foreach ($products['data'] as $product) {
            Product::firstOrCreate([
                'name' => $product['name'],
                'price' => $product['price'],
                'sales_count' => $product['sales_count'],
                'views_count' => $product['views_count'],
                'created_at' =>  Carbon::parse($product['created']),
            ]);
        }
    }
}
