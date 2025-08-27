<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return 
            [
                'service_name'      => ['required', 'string', 'min:3'],
                'service_moderator' => ['required', 'exists:users,id']
            ]
        ;
    }

    public function attributes(): array 
    {
        return [
            "service_name"      => "nom du service",
            "service_moderator" => "modérateur du service"
        ];
    }
}
