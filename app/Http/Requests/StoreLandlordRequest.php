<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandlordRequest extends FormRequest
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
        'business_name' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'id_number' => 'nullable|string|max:20',
        'tax_pin' => 'nullable|string|max:20',
    ];
}

}
