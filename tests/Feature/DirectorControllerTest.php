<?php

namespace Tests\Feature;

use App\Models\Director;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DirectorControllerTest extends TestCase
{
    use RefreshDatabase;

    /* Lekérdezés*/

    public function test_index_returns_all_directors()
    {
        Director::factory()->create(['name' => 'Steven Spielberg']);
        Director::factory()->create(['name' => 'Christopher Nolan']);

        $response = $this->getJson('/api/directors');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Steven Spielberg'])
            ->assertJsonFragment(['name' => 'Christopher Nolan']);
    }

    /* Új Director létrehozása*/

    public function test_store_creates_new_director()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $data = [
            'name' => 'James Cameron'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/directors', $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'James Cameron']);

        $this->assertDatabaseHas('directors', ['name' => 'James Cameron']);
    }

    /* Létező Director módosítása*/

    public function test_update_modifies_existing_director()
    {
        $director = Director::factory()->create(['name' => 'Old Name']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->putJson("/api/directors/{$director->id}", [
            'name' => 'New Name'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Name']);

        $this->assertDatabaseHas('directors', [
            'id' => $director->id,
            'name' => 'New Name'
        ]);
    }


    /* Nem létező Director módosítása*/
     
    public function test_update_returns_404_for_missing_director()
    {
        $response = $this->putJson('/api/directors/999', [
            'name' => 'Not exists Director'
        ]);

        $response->assertStatus(404);
    }

    /*Director törlése*/

    public function test_delete_removes_director()
{
    $director = Director::factory()->create(['name' => 'Delete Me']);

    $user = User::factory()->create();
    $token = $user->createToken('TestToken')->plainTextToken;

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->deleteJson("/api/directors/{$director->id}");

    $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Director deleted successfully']);

    $this->assertDatabaseMissing('directors', [
        'id' => $director->id
    ]);
}

}
