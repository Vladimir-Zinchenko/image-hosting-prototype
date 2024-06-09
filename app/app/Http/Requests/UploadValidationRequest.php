<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UploadValidationRequest
 */
class UploadValidationRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'file.*' => 'required|file|mimes:jpeg,jpg,png',
            'file' => 'max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'file.max' => 'The file field must not be greater than :max files',
        ];
    }
}
