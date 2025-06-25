<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandlordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'business_name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'id_number' => 'sometimes|string|max:20',
            'tax_pin' => 'sometimes|string|max:20',
        ];
    }
}
