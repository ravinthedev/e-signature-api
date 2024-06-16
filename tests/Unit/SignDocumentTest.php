<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Document;
use App\Models\SignatureRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class SignDocumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_sign_a_document()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        // Manually create a document
        $documentResponse = $this->postJson('/api/documents', [
            'title' => 'Test Document',
            'document' => UploadedFile::fake()->create('document.pdf', 1000),
        ]);

        $documentResponse->assertStatus(201);

        $documentId = $documentResponse->json('id');

        // Manually create a signature request
        $signatureRequest = SignatureRequest::create([
            'document_id' => $documentId,
            'signer_id' => $user->id,
            'requester_id' => $user->id,
        ]);


        // Send the sign request
        $response = $this->postJson("/api/signature-requests/{$signatureRequest->id}/sign");


        // Check response and status
        $response->assertStatus(200)
            ->assertJsonPath('signature_request.status', 'signed');
    }
}

