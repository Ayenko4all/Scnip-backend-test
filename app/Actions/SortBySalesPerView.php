<?php

namespace App\Actions;

use App\Interfaces\ProductSorter;

class SortBySalesPerView implements ProductSorter {
    public function sort(array $products, $extraSort): array
    {
        usort($products, function($a, $b) {
            $ratioA = $a['sales_count'] / $a['views_count'];
            $ratioB = $b['sales_count'] / $b['views_count'];
            return $ratioA <=> $ratioB;
        });

        return $products;
    }
}
