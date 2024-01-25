<?php

namespace App\Interfaces;

interface ProductSorter
{
    /**
     * Builds a payload for the current configuration of the pending object.
     *
     * @param array $products
     * @param $extraSort
     * @return array
     */
    public function sort(array $products, $extraSort): array;
}
