<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_if_not_found_is_validated(): void
    {
        $response_get = $this->getJson('/api/contacts/1234');        
        
        $response_put = $this->putJson('/api/contacts/1234', ['name' => 'name update teste', 'email' => 'xyz@teste.com']); 
        
        $response_delete = $this->deleteJson('/api/contacts/1234');
        
        $response_get->assertStatus(404);
        $response_get->assertJsonFragment([
            'message' => 'not found'
        ]);

        $response_put->assertStatus(400);
        $response_put->assertJsonFragment([
            'message' => 'error'
        ]);

        $response_delete->assertStatus(400);
        $response_delete->assertJsonFragment([
            'message' => 'error'
        ]);
    }

    public function test_api_returns_if_list_is_working()
    {   
        $contacts = Contact::factory(5)->create();
            
        $response = $this->getJson('/api/contacts');

        $response->assertStatus(200);
        
        for ($i=0; $i < 5; $i++) { 
            $response->assertJsonFragment([
                'name' => $contacts[$i]->name,
                'email' => $contacts[$i]->email
            ]);
        }

        $response->assertJsonCount(5);
    }

    public function test_api_returns_if_get_one_record_is_working()
    {   
        $contact = Contact::factory()->create();
        
        $response = $this->getJson('/api/contacts/' . $contact->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name' => $contact->name,
            'email' => $contact->email
        ]);        
    } 

    public function test_api_returns_if_create_record_is_working()
    {   
        $record = json_decode(Contact::factory()->create(), true);
        
        $response = $this->postJson('/api/contacts/', $record);
        
        $response->assertStatus(201);

        $response->assertJsonFragment([
            'name' => $record['name'],
            'email' => $record['email']
        ]);
    }


    public function test_api_validates_if_creation_is_correcting_validating()
    {
        $record = [];

        $response = $this->postJson('/api/contacts/', $record);

        $response->assertStatus(422);
        $response->assertInvalid(['name']);
    }

    public function test_api_returns_if_update_record_is_working()
    {        
        $contact = Contact::factory()->create();

        $response = $this->putJson('/api/contacts/' . $contact->id, ['name' => 'TESTE010203']);

        $response->assertStatus(200);

        $response->assertJsonFragment([            
            'name' => 'TESTE010203'
        ]);
    }

    public function test_api_validates_if_updating_is_correcting_validating()
    {
        $contact = Contact::factory()->create();

        $response = $this->putJson('/api/contacts/' . $contact->id, ['email' => 'AAAA']);

        $response->assertInvalid(['email']);
    }

    public function test_api_returns_if_delete_record_is_working()
    {
        $contacts = Contact::factory(2)->create();
        
        $response_list = $this->getJson('/api/contacts');
        
        $response_list->assertJsonCount(2);
        
        $response_delete = $this->deleteJson('/api/contacts/' . $contacts[0]->id);

        $response_delete->assertStatus(200);

        $response_delete->assertJsonFragment([
            'message' => 'deleted with success'
        ]);

        $response_list_again = $this->getJson('/api/contacts');
        
        $response_list_again->assertJsonCount(1);

        $response_list_again->assertJsonFragment([
            'name' => $contacts[1]->name,
            'email' => $contacts[1]->email
        ]);
    }
}
