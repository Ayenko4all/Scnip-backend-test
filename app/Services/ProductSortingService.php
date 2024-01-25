<?php
namespace App\Services;

use App\Actions\SortByPrice;
use App\Actions\SortBySalesPerView;
use App\Interfaces\ProductSorter;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class ProductSortingService {

    protected SortBySalesPerView $sortBySalesPerView;
    protected SortByPrice $sortByPrice;

    /**
     * @param SortBySalesPerView $sortBySalesPerView
     * @param SortByPrice $sortByPrice
     */
    public function __construct(SortBySalesPerView $sortBySalesPerView, SortByPrice $sortByPrice) {
        $this->sortBySalesPerView = $sortBySalesPerView;
        $this->sortByPrice = $sortByPrice;
    }

    /**
     * @param array $products
     * @param ProductSorter $sorter
     * @param $sortTwo
     * @return array
     */
    public function fetchProducts(array $products, ProductSorter $sorter, $sortTwo=null): array {
        return $sorter->sort($products, $sortTwo);
    }

    /**
     * @param $sort
     * @param $extraSort
     * @return array
     * @throws \Exception
     */
    public function sort($sort, $extraSort): array
    {
        try {
            /* This was done in case database was not createed and seeded for running the test */
            if(Schema::hasTable('products')){
                $dbProducts = Product::all();
                $products = $dbProducts->toArray();
            } else {
                $snubProducts = json_decode(file_get_contents('../database/data/products.json'), true);
                $products = $snubProducts['data'];
            }

            /* Sort by price */
            if($sort === "price"){
                $sortedProduct = $this->fetchProducts($products, $this->sortByPrice, $extraSort);
            }

            /*  Sort by sales per view */
            if($sort === "sales_to_view_ratio"){
                $sortedProduct = $this->fetchProducts($products, $this->sortBySalesPerView);
            }

            /* other sort can be added here as it needed */

            return [
                ["status" => "success", "products" => $sortedProduct ?? $products],
                Response::HTTP_OK
            ];
        } catch (\Throwable $exception){
            return [
                ["status" => "failed", "message" => "Error sorting products."],
                Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
