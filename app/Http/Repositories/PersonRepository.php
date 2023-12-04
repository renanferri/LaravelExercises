<?php

namespace App\Http\Repositories;

use App\Models\Person;

class PersonRepository
{
    public function __construct(
        private Person $person
    )
    {        
    }

    public function list()
    {
        return $this->person::get();
    }

    public function findById($id)
    {
        return $this->person::find($id);
    }

    public function save($data)
    {
        return $this->person::create($data);
    }

    public function update($id, $data)
    {
        $person = $this->findById($id);
        if ($person) {
            $person->update($data);
            return $person->refresh();
        }
        return false;
    }

    public function delete($id)
    {
        $delete = $this->person::find($id);
        if ($delete) {
            return $delete->delete();
        }
        return false;
    }
}