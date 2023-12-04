<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ContactRepository;
use App\Http\Requests\Api\StoreContactRequest;
use App\Http\Requests\Api\UpdateContactRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;

class ContactController extends Controller
{
    public function __construct(
        private ContactRepository $repository
    )
    {        
    }

    public function index()
    {
        $contacts = $this->repository->list();
        return new ContactCollection($contacts);
    }

    public function show($id)
    {
        $contact = $this->repository->findById($id);
        if ($contact) {
            return new ContactResource($contact);
        }
        return response()->json([
            'status' => [
                'code' => 404,
                'message' => 'not found'
            ]
        ])->setStatusCode(404);
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->all();
        $contact = $this->repository->save($data);
        return new ContactResource($contact);
    }

    public function update($id, UpdateContactRequest $request)
    {
        $data = $request->all();
        $return = $this->repository->update($id, $data);
        if ($return) {
            return new ContactResource($return);
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
