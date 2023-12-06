<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_if_not_found_is_validated(): void
    {
        $response_get = $this->getJson('/api/persons/1234');        
        
        $response_put = $this->putJson('/api/persons/1234', ['name' => 'name update teste', 'birth_date' => '2000-01-01']); 
        
        $response_delete = $this->deleteJson('/api/persons/1234');
        
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
        $persons = Person::factory(5)->create();
            
        $response = $this->getJson('/api/persons');

        $response->assertStatus(200);
        
        for ($i=0; $i < 5; $i++) { 
            $response->assertJsonFragment([
                'name' => $persons[$i]->name,
                'birth_date' => $persons[$i]->birth_date
            ]);
        }

        $response->assertJsonCount(5);
    }

    public function test_api_returns_if_get_one_record_is_working()
    {   
        $person = Person::factory()->create();
        
        $response = $this->getJson('/api/persons/' . $person->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name' => $person->name,
            'birth_date' => $person->birth_date
        ]);        
    } 

    public function test_api_returns_if_create_record_is_working()
    {   
        $record = json_decode(Person::factory()->create(), true);
        
        $response = $this->postJson('/api/persons/', $record);
        
        $response->assertStatus(201);

        $response->assertJsonFragment([
            'name' => $record['name'],
            'birth_date' => $record['birth_date']
        ]);
    }

    public function test_api_validates_if_creation_is_correcting_validating()
    {
        $record = [];

        $response = $this->postJson('/api/persons/', $record);

        $response->assertStatus(422);
        $response->assertInvalid(['name']);
    }

    public function test_api_returns_if_update_record_is_working()
    {        
        $person = Person::factory()->create();

        $response = $this->putJson('/api/persons/' . $person->id, ['name' => 'TESTE010203']);

        $response->assertStatus(200);

        $response->assertJsonFragment([            
            'name' => 'TESTE010203'
        ]);
    }

    public function test_api_validates_if_updating_is_correcting_validating()
    {
        $person = Person::factory()->create();

        $response = $this->putJson('/api/persons/' . $person->id, ['birth_date' => 'AAAA']);

        $response->assertInvalid(['birth_date']);
    }

    public function test_api_returns_if_delete_record_is_working()
    {
        $persons = Person::factory(2)->create();
        
        $response_list = $this->getJson('/api/persons');
        
        $response_list->assertJsonCount(2);
        
        $response_delete = $this->deleteJson('/api/persons/' . $persons[0]->id);

        $response_delete->assertStatus(200);

        $response_delete->assertJsonFragment([
            'message' => 'deleted with success'
        ]);

        $response_list_again = $this->getJson('/api/persons');
        
        $response_list_again->assertJsonCount(1);

        $response_list_again->assertJsonFragment([
            'name' => $persons[1]->name,
            'birth_date' => $persons[1]->birth_date
        ]);
    }
}
