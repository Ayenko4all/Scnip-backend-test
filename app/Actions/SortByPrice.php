<?php
namespace App\Actions;

use App\Interfaces\ProductSorter;

class SortByPrice implements ProductSorter {
    public function sort(array $products, $extraSort): array
    {
        usort($products, function($a, $b) use($products, $extraSort){
            return $extraSort === "desc" ? $b['price'] <=> $a['price'] : $a['price'] <=> $b['price'];
        });

        return $products;
    }
}
