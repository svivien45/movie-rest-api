<?php

namespace Tests;

use App\Models\Actor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActorControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Lekérdezés tesztelése
     */
    public function test_index_returns_actors()
    {
        Actor::factory()->create(['name' => 'Tom Hanks', 'gender' => 'M']);
        Actor::factory()->create(['name' => 'Scarlett Johansson', 'gender' => 'F']);

        $response = $this->getJson('/api/actors');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Tom Hanks'])
            ->assertJsonFragment(['name' => 'Scarlett Johansson']);
    }

    /**
     * Új Actor létrehozása
     */
    public function test_store_creates_new_actor()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $actorData = [
            'name' => 'Leonardo DiCaprio',
            'gender' => 'M'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/actors', $actorData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Leonardo DiCaprio']);

        $this->assertDatabaseHas('actors', ['name' => 'Leonardo DiCaprio', 'gender' => 'M']);
    }

    /**
     * Actor módosítása
     */
    public function test_update_modifies_existing_actor()
    {
        $actor = Actor::factory()->create(['name' => 'Old Name', 'gender' => 'M']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->putJson("/api/actors/{$actor->id}", [
            'name' => 'New Name',
            'gender' => 'F'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Name', 'gender' => 'F']);

        $this->assertDatabaseHas('actors', ['id' => $actor->id, 'name' => 'New Name', 'gender' => 'F']);
    }

    /**
     * Nem létező Actor módosítása
     */
    public function test_update_returns_404_for_missing_actor()
    {
        $response = $this->putJson('/api/actors/999', [
            'name' => 'Not exists Actor',
            'gender' => 'M'
        ]);

        $response->assertStatus(404);
    }

    /**
     * Actor törlése
     */
    public function test_delete_removes_actor()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $actor = Actor::factory()->create(['name' => 'To Be Deleted', 'gender' => 'M']);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->deleteJson("/api/actors/{$actor->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Actor deleted successfully', 'id' => (string) $actor->id]);

        $this->assertDatabaseMissing('actors', ['id' => $actor->id]);
    }
}
