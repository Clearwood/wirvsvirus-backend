<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShoppingList\ConsumerCreateRequest;
use App\Http\Requests\Api\ShoppingList\ConsumerUpdateRequest;
use App\Http\Resources\ConsumerResource;
use App\Models\Consumer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->has('user_id')) {
            $consumers = Consumer::where('user_id', $request->get('user_id'))->get();
            return ConsumerResource::collection($consumers);
        }
        return ConsumerResource::collection(Consumer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ConsumerCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(ConsumerCreateRequest $request)
    {
        $consumer = Consumer::create($request->all());
        $consumer->save();

        return (new ConsumerResource($consumer->refresh()))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consumer $consumer
     *
     * @return ConsumerResource
     */
    public function read(Consumer $consumer)
    {
        return new ConsumerResource($consumer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConsumerUpdateRequest $request
     * @param  \App\Models\Consumer $consumer
     *
     * @return ConsumerResource
     */
    public function update(ConsumerUpdateRequest $request, Consumer $consumer)
    {
        $consumer->fill($request->all());
        $consumer->save();

        return new ConsumerResource($consumer->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consumer $consumer
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Consumer $consumer)
    {
        $consumer->delete();
        return new JsonResponse(['success' => true], 200);
    }
}
