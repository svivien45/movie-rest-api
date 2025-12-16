<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Studio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudioControllerTest extends TestCase
{
    use RefreshDatabase;

    /*Lekérdezés*/
    public function test_index_returns_all_studios()
    {
        Studio::factory()->count(3)->create();

        $response = $this->getJson('/api/studios');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'studios');
    }

    /*Új Studio létrehozása */
    public function test_store_creates_new_studio()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $data = [
            'name' => 'New Studio'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson('/api/studios', $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'New Studio']);

        $this->assertDatabaseHas('studios', [
            'name' => 'New Studio'
        ]);
    }

    /*Létező Studio módosítása*/
    public function test_update_modifies_existing_studio()
    {
        $studio = Studio::factory()->create(['name' => 'Old Name']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->putJson("/api/studios/{$studio->id}", [
            'name' => 'Updated Name'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('studios', [
            'id' => $studio->id,
            'name' => 'Updated Name'
        ]);
    }

    /*Nem létező Studio módosítása */
    public function test_update_returns_404_if_not_found()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->putJson('/api/studios/999', ['name' => 'Does not exist']);

        $response->assertStatus(404);
    }

    /*Studio törlése*/
    public function test_delete_removes_studio()
    {
        $studio = Studio::factory()->create(['name' => 'Delete Me']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->deleteJson("/api/studios/{$studio->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Studio deleted successfully']);

        $this->assertDatabaseMissing('studios', [
            'id' => $studio->id
        ]);
    }
}
