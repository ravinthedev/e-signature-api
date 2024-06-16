<?php

namespace App\Http\Controllers;

use App\Models\SignatureRequest;
use App\Http\Requests\NewSignatureRequest;
use App\Http\Requests\SignDocumentRequest;
use Illuminate\Http\Request;

class SignatureRequestController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/signature-requests",
     *     summary="Get all signature requests for the current user",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of signature requests",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/SignatureRequest"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        try {
            $signatureRequests = SignatureRequest::where('signer_id', $request->user()->id)->get();
            return response()->json($signatureRequests, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch signature requests'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/my-requests",
     *     summary="Get all signature requests created by the current user",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of created signature requests",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/SignatureRequest"))
     *     )
     * )
     */
    public function myRequests(Request $request)
    {
        try {
            $signatureRequests = SignatureRequest::where('requester_id', $request->user()->id)->get();
            return response()->json($signatureRequests, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch signature requests'], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/signature-requests",
     *     summary="Create a new signature request",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"document_id","signer_id"},
     *             @OA\Property(property="document_id", type="integer", example=1),
     *             @OA\Property(property="signer_id", type="integer", example=2)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Signature request created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SignatureRequest")
     *     )
     * )
     */
    public function requestSignature(NewSignatureRequest $request)
    {
        try {
            $signatureRequest = SignatureRequest::create([
                'document_id' => $request->document_id,
                'requester_id' => $request->user()->id,
                'signer_id' => $request->signer_id,
            ]);

            return response()->json(['signature_request' => $signatureRequest], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create signature request'], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/signature-requests/{id}/sign",
     *     summary="Sign a document",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Document signed successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SignatureRequest")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function signDocument(SignDocumentRequest $request, $id)
    {
        try {
            $signatureRequest = SignatureRequest::findOrFail($id);
            if ($signatureRequest->signer_id !== $request->user()->id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $signatureRequest->update(['status' => 'signed']);

            return response()->json(['signature_request' => $signatureRequest], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to sign document'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/signature-requests/{id}/status",
     *     summary="Get the status of a signature request",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status of the signature request",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="pending")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Signature request not found"
     *     )
     * )
     */
    public function showStatus($id, Request $request)
    {
        try {
            $signatureRequest = SignatureRequest::where('id', $id)->first();

            if (!$signatureRequest) {
                return response()->json(['message' => 'Signature request not found'], 404);
            }

            return response()->json(['status' => $signatureRequest->status], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch signature request status'], 500);
        }
    }
}
