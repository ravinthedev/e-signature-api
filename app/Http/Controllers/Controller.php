<?php

namespace App\Http\Controllers;
/**
 * @OA\Info(
 *     title="E-Signature API",
 *     version="1.0.0",
 *     description="API documentation for the E-Signature application",
 *     @OA\Contact(
 *         email="support@example.com"
 *     ),
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * @OA\Schema(
 *      schema="User",
 *      type="object",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="John Doe"),
 *      @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2022-01-01T00:00:00Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2022-01-01T00:00:00Z")
 *  )
 * @OA\Schema(
 *      schema="Document",
 *      type="object",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="user_id", type="integer", example=1),
 *      @OA\Property(property="title", type="string", example="Document Title"),
 *      @OA\Property(property="file_path", type="string", example="documents/filename.pdf"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2022-01-01T00:00:00Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2022-01-01T00:00:00Z")
 *  )
 *
 * @OA\Schema(
 *      schema="SignatureRequest",
 *      type="object",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="document_id", type="integer", example=1),
 *      @OA\Property(property="requester_id", type="integer", example=1),
 *      @OA\Property(property="signer_id", type="integer", example=2),
 *      @OA\Property(property="status", type="string", example="pending"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2022-01-01T00:00:00Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2022-01-01T00:00:00Z")
 *  )
 */
abstract class Controller
{
    //
}
