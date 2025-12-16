<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    /*Lekérdezés*/
    public function test_index_returns_all_categories(): void
    {
        Category::factory()->create(['category' => 'Akció']);
        Category::factory()->create(['category' => 'Komédia']);

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonFragment(['category' => 'Akció'])
            ->assertJsonFragment(['category' => 'Komédia']);
    }

    /*Új Category létrehozása*/
    public function test_store_creates_new_category()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $data = [
            'category' => 'Horror'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/categories', $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['category' => 'Horror']);

        $this->assertDatabaseHas('categories', ['category' => 'Horror']);
    }
    /**
     * Category módosítása
     */
    public function test_update_modifies_existing_category()
    {
        $category = Category::factory()->create(['category' => 'Old Category']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->putJson("/api/categories/{$category->id}", [
            'category' => 'New Category'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['category' => 'New Category']);

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'category' => 'New Category']);
    }

    /**
     * Nem létező Category módosítása
     */
    public function test_update_returns_404_for_missing_category()
    {
        $response = $this->putJson('/api/categories/999', [
            'category' => 'Not exists Category'
        ]);

        $response->assertStatus(404);
    }

    /**
     * Category törlése
     */
    public function test_delete_removes_category()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $category = Category::factory()->create(['category' => 'To Be Deleted']);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Category deleted successfully',
            ]);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}

