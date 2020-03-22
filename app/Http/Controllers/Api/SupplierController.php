<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShoppingList\SupplierCreateRequest;
use App\Http\Requests\Api\ShoppingList\SupplierUpdateRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        if ($request->has('user_id')) {
            $consumers = Supplier::where('user_id', $request->get('user_id'))->get();
            return SupplierResource::collection($consumers);
        }
        return SupplierResource::collection(Supplier::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SupplierCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(SupplierCreateRequest $request)
    {
        $supplier = Supplier::create($request->all());
        $supplier->save();

        return (new SupplierResource($supplier->refresh()))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier $supplier
     *
     * @return SupplierResource
     */
    public function read(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SupplierUpdateRequest $request
     * @param  \App\Models\Supplier $supplier
     *
     * @return SupplierResource
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        $supplier->fill($request->all());
        $supplier->save();

        return new SupplierResource($supplier->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier $supplier
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Supplier $supplier)
    {
        $supplier->delete();
        return new JsonResponse(['success' => true], 200);
    }
}
