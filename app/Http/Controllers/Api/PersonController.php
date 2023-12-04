<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PersonRepository;
use App\Http\Requests\Api\StorePersonRequest;
use App\Http\Requests\Api\UpdatePersonRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;

class PersonController extends Controller
{
    public function __construct(
        private PersonRepository $repository
    )
    {        
    }

    public function index()
    {
        $persons = $this->repository->list();
        return new PersonCollection($persons);
    }

    public function show($id)
    {
        $person = $this->repository->findById($id);
        if ($person) {
            return new PersonResource($person);
        }
        return response()->json([
            'status' => [
                'code' => 404,
                'message' => 'not found'
            ]
        ])->setStatusCode(404);
    }

    public function store(StorePersonRequest $request)
    {
        $data = $request->all();
        $person = $this->repository->save($data);
        return new PersonResource($person);
    }

    public function update($id, UpdatePersonRequest $request)
    {
        $data = $request->all();
        $return = $this->repository->update($id, $data);
        if ($return) {
            return new PersonResource($return);
        }
        return response()->json([
            'status' => [
                'code' => 400,
                'message' => 'error'
            ]
        ])->setStatusCode(400);
    }

    public function destroy($id)
    {
        $result = $this->repository->delete($id);
        if ($result) {
            return response()->json([
                'status' => [
                    'code' => 200,
                    'message' => 'deleted with success'
                ]
            ])->setStatusCode(200);
        }
        return response()->json([
            'status' => [
                'code' => 400,
                'message' => 'error'
            ]
        ])->setStatusCode(400);
    }
}
