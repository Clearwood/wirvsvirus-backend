<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserCreateRequest;
use App\Http\Requests\Api\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(UserCreateRequest $request)
    {
        $user = User::create($request->all());
        $user->password = Hash::make($request->input('password'));
        $user->getLatLong();
        $user->save();

        return (new UserResource($user->refresh()))->response()->setStatusCode(201);
    }

    public function token(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            return new JsonResponse(['token' => $user->id]);
        } else {
            return new JsonResponse(['success' => false, 'error' => 'Incorrect email or password'], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     *
     * @return UserResource
     */
    public function read(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param  \App\User        $user
     *
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->fill($request->all());
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->getLatLong();
        $user->save();
        return new UserResource($user->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(User $user)
    {
        $user->delete();
        return new JsonResponse(['success' => true], 200);
    }
}
