<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'city' => 'required|string|max:100',
        'county' => 'required|string|max:100',
        'description' => 'nullable|string',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
    ];
}

}
