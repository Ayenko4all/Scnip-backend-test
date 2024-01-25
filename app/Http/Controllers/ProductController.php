<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSortingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ProductSortingService;

class ProductController extends Controller
{
    protected ProductSortingService $sortingService;
    /**
     * @param ProductSortingService $sortingService
     */
    public function __construct(ProductSortingService $sortingService) {
        $this->sortingService = $sortingService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        [$data, $statusCode] = $this->sortingService->sort($request->query('sort'), $request->query('extra_sort'));

        return response()->json($data, $statusCode);
    }
}
