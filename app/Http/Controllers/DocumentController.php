<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\DocumentUploadRequest;

class DocumentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/documents",
     *     summary="Upload a new document",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", example="Document Title"),
     *                 @OA\Property(property="document", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Document uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="document", ref="#/components/schemas/Document")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function upload(DocumentUploadRequest $request)
    {
        try {
            $path = $request->file('document')->store('documents');

            $document = Document::create([
                'user_id' => $request->user()->id,
                'title' => $request->title,
                'file_path' => $path,
            ]);

            return response()->json($document, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Document upload failed'], 500);
        }
    }
}
