<?php

namespace Tests\Unit;

use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateSignatureRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_signature_request()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $document = Document::factory()->create(['user_id' => $user->id]);
        $signer = User::factory()->create();

        $response = $this->postJson('/api/signature-requests', [
            'document_id' => $document->id,
            'signer_id' => $signer->id,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'signature_request' => [
                    'id',
                    'document_id',
                    'requester_id',
                    'signer_id',
                    'created_at',
                    'updated_at',
                ],
            ]);

    }
}
