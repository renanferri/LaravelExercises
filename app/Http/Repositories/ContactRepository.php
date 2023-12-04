<?php

namespace App\Http\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function __construct(
        private Contact $contact
    )
    {        
    }

    public function list()
    {
        return $this->contact::get();
    }

    public function findById($id)
    {
        return $this->contact::find($id);
    }

    public function save($data)
    {
        return $this->contact::create($data);
    }

    public function update($id, $data)
    {
        $contact = $this->findById($id);
        if ($contact) {
            $contact->update($data);
            return $contact->refresh();
        }
        return false;
    }

    public function delete($id)
    {
        $delete = $this->contact::find($id);
        if ($delete) {
            return $delete->delete();
        }
        return false;
    }
}