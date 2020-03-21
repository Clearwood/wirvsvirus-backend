<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Job\JobCreateRequest;
use App\Http\Requests\Api\Job\JobUpdateRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return JobResource::collection(Job::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JobCreateRequest $request
     *
     * @return JsonResponse|object
     */
    public function create(JobCreateRequest $request)
    {
        $job = Job::create($request->all());
        $job->save();

        return (new JobResource($job->refresh()))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job $job
     *
     * @return JobResource
     */
    public function read(Job $job)
    {
        return new JobResource($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JobUpdateRequest $request
     * @param  \App\Models\Job $job
     *
     * @return JobResource
     */
    public function update(JobUpdateRequest $request, Job $job)
    {
        $job->fill($request->all());
        $job->save();

        return new JobResource($job->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job $job
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Job $job)
    {
        $job->delete();
        return new JsonResponse(['success' => true], 200);
    }
}
