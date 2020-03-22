<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShoppingList\ConsumerCreateRequest;
use App\Http\Requests\Api\ShoppingList\ShoppingListCreateRequest;
use App\Http\Requests\Api\ShoppingList\SupplierCreateRequest;
use App\Http\Resources\ShoppingListResource;
use App\Models\ShoppingList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
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
        if ($request->has('job_id')) {
            $shoppingList = ShoppingList::where('job_id', $request->get('job_id'))->get();
            return ShoppingListResource::collection($shoppingList);
        }
        return ShoppingListResource::collection(ShoppingList::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShoppingListCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(ShoppingListCreateRequest $request)
    {
        $shoppingList = ShoppingList::create($request->all());
        $shoppingList->save();

        return (new ShoppingListResource($shoppingList->refresh()))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingList $shoppingList
     *
     * @return ShoppingListResource
     */
    public function read(ShoppingList $shoppingList)
    {
        return new ShoppingListResource($shoppingList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SupplierCreateRequest     $request
     * @param  \App\Models\ShoppingList $shoppingList
     *
     * @return ShoppingListResource
     */
    public function update(SupplierCreateRequest $request, ShoppingList $shoppingList)
    {
        $shoppingList->fill($request->all());
        $shoppingList->save();

        return new ShoppingListResource($shoppingList->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList $shoppingList
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(ShoppingList $shoppingList)
    {
        $shoppingList->delete();
        return new JsonResponse(['success' => true], 200);
    }
}
