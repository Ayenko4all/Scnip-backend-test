<?php
namespace App\Actions;

use App\Interfaces\ProductSorter;

class SortByPrice implements ProductSorter {
    public function sort(array $products, $extraSort): array
    {
        usort($products, fn($a, $b) => $extraSort === "desc" ? $b['price'] <=> $a['price'] : $a['price'] <=> $b['price']);

        return $products;
    }
}
