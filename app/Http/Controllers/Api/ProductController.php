<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Job\ProductCreateRequest;
use App\Http\Requests\Api\Job\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->has('name')) {
            return ProductResource::collection(Product::where('name', 'like', "%{$request->input('name')}%")->get());
        }
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(ProductCreateRequest $request)
    {
        $product = Product::create($request->all());
        $product->save();

        return (new ProductResource($product->refresh()))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     *
     * @return ProductResource
     */
    public function read(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param  \App\Models\Product $product
     *
     * @return ProductResource
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->save();

        return new ProductResource($product->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Product $product)
    {
        $product->delete();
        return new JsonResponse(['success' => true], 200);
    }
}
