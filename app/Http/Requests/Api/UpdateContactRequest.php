<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:contacts,email,' . $this->contact,                    
            'whatsapp' => 'sometimes|required|max:20|unique:contacts,whatsapp,' . $this->contact,        
            'person_id' => 'sometimes|required|integer|exists:persons,id',
        ];
    }
}
