<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = request()->user();
        
        return $user->role == 'admin' || $user->role == 'moderator' ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'tag' => ['nullable', 'string', 'max:100'],
            'priority' => ['required', 'in:low,medium,high'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date', 'after_or_equal:from'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Libellé',
            'priority' => 'Priorité',
            'from' => 'date de début',
            'to' => 'date de fin'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le libellé du projet est obligatoire.',
            'priority.required' => 'Veuillez choisir un niveau de priorité.',
            'to.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];
    }
}
