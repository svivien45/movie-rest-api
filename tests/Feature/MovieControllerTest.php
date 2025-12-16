<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Studio;
use App\Models\Director;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    /*Lekérdezés*/
    public function test_index_returns_all_movies()
    {
        Movie::factory()->count(3)->create();

        $response = $this->getJson('/api/movies');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'movies' => [
                    '*' => ['id', 'name', 'categories_id', 'description', 'pic_path', 'length', 'release_date', 'director_id', 'studio_id']
                ]
            ]);
    }

    /*Új Movie létrehozása */
    public function test_store_creates_a_new_movie()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $category = Category::factory()->create();
        $director = Director::factory()->create();
        $studio = Studio::factory()->create();

        $movieData = [
            'name' => 'Test Movie',
            'categories_id' => 1,
            'description' => 'Description text',
            'pic_path' => 'img.jpg',
            'length' => '120',
            'release_date' => '2024-01-01',
            'director_id' => Director::factory()->create()->id,
            'studio_id' => Studio::factory()->create()->id
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->postJson('/api/movies', $movieData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Test Movie']);

        $this->assertDatabaseHas('movies', [
            'name' => 'Test Movie'
        ]);
    }

    /*Létező Movie módosítása */
    public function test_update_modifies_existing_movie()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $movie = Movie::factory()->create([
            'name' => 'Old Name'
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->putJson("/api/movies/{$movie->id}", [
            'name' => 'Updated Name'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('movies', [
            'id' => $movie->id,
            'name' => 'Updated Name'
        ]);
    }

    /*Nem létező Movie módosítása */
    public function test_update_returns_404_for_missing_movie()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->putJson('/api/movies/999', [
            'name' => 'Not exist'
        ]);

        $response->assertStatus(404);
    }

    /*Movie törlése */
    public function test_delete_removes_movie()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $movie = Movie::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->deleteJson("/api/movies/{$movie->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Movie deleted successfully']);

        $this->assertDatabaseMissing('movies', [
            'id' => $movie->id
        ]);
    }

    /*Egy film studiója */
    public function index_studio_returns_studio_of_movie()
    {
        $studio = Studio::factory()->create(['name' => 'Test Studio']);
        $movie = Movie::factory()->create(['studio_id' => $studio->id]);

        $response = $this->getJson("/api/movies/{$movie->id}/studio");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Test Studio']);
    }

    /*Színész hozzáadása filmhez */
    public function add_actor_adds_actor_to_movie()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $movie = Movie::factory()->create();
        $actor = Actor::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->postJson("/api/movies/{$movie->id}/add-actor", [
            'actor_id' => $actor->id
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Actor added to movie successfully.']);

        $this->assertDatabaseHas('actor_movie', [
            'movie_id' => $movie->id,
            'actor_id' => $actor->id
        ]);
    }
}

