<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_upload_document()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/documents', [
            'title' => 'Test Document',
            'document' => UploadedFile::fake()->create('document.pdf', 1000),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('documents', ['title' => 'Test Document']);
    }
}
