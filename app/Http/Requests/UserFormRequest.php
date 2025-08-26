<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['string', 'required', 'min:3'],
            'email'     => ['email', 'required', 'unique:users,email'],
            'role'      => ['required', Rule::in(['moderator', 'member'])],
            'service'   => ['required', 'exists:services,id'],
        ];
    }
}
