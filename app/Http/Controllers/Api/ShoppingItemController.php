<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Job\ShoppingItemCreateRequest;
use App\Http\Requests\Api\Job\ShoppingItemUpdateRequest;
use App\Http\Resources\ShoppingItemResource;
use App\Models\ShoppingItem;
use App\Models\ShoppingList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingItemController extends Controller
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
        if ($request->has('shoppingList_id')) {
            $shoppingItems = ShoppingItem::where('shoppingList_id', $request->get('shoppingList_id'))->get();
            return ShoppingItemResource::collection($shoppingItems);
        }
        return ShoppingItemResource::collection(ShoppingItem::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShoppingItemCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(ShoppingItemCreateRequest $request)
    {
        $shoppingItem = ShoppingItem::create($request->all());
        $shoppingItem->shoppingList()->associate(ShoppingList::find($request->input('shoppingList_id')));
        $shoppingItem->save();
        $shoppingItem->refresh();

        /* @var ShoppingList $shoppingList */
        $shoppingList = $shoppingItem->shoppingList;
        $shoppingList->hasCooledProduct = false;
        foreach ($shoppingList->shoppingItems as $shoppingItem) {
            if ($shoppingItem->product->needsCooling) {
                $shoppingList->hasCooledProduct = true;
                break;
            }
        }

        $shoppingItem->save();
        return (new ShoppingItemResource($shoppingItem->refresh()))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingItem $shoppingItem
     *
     * @return ShoppingItemResource
     */
    public function read(ShoppingItem $shoppingItem)
    {
        return new ShoppingItemResource($shoppingItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShoppingItemUpdateRequest $request
     * @param  \App\Models\ShoppingItem $shoppingItem
     *
     * @return ShoppingItemResource
     */
    public function update(ShoppingItemUpdateRequest $request, ShoppingItem $shoppingItem)
    {
        $shoppingItem->fill($request->all());
        $shoppingItem->save();
        $shoppingItem->refresh();

        $shoppingItem->shoppingList->hasCooledProduct = false;
        foreach ($shoppingItem->shoppingList->shoppingItems as $shoppingItem) {
            if ($shoppingItem->product->needsCooling) {
                $shoppingItem->shoppingList->hasCooledProduct = true;
                break;
            }
        }

        $shoppingItem->save();
        return new ShoppingItemResource($shoppingItem->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingItem $shoppingItem
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(ShoppingItem $shoppingItem)
    {
        $shoppingItem->delete();
        return new JsonResponse(['success' => true], 200);
    }
}
