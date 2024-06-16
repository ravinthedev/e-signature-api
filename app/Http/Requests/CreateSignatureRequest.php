<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateSignatureRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to false if authorization logic is needed
    }

    public function rules()
    {
        return [
            'document_id' => 'required|exists:documents,id',
            'signer_id' => 'required|exists:users,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data'    => $validator->errors()
        ], 422));
    }

    public function messages()
    {
        return [
            'document_id.required' => 'Document ID is required',
            'document_id.exists' => 'Document ID must exist in the documents table',
            'signer_id.required' => 'Signer ID is required',
            'signer_id.exists' => 'Signer ID must exist in the users table',
        ];
    }
}
