<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = request()->user();

        return $user->role == 'admin' || $user->role == 'moderator';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'tag'         => 'nullable|string|max:100',
            'project_id'  => 'sometimes|required|exists:projects,id',
            'priority'    => 'sometimes|required|in:low,medium,high',
            'from'        => 'sometimes|required|date',
            'to'          => 'sometimes|required|date|after_or_equal:from',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'libellé',
            'from' => 'champ date de début',
            'to' => 'date de fin',
            'priority' => 'priorité'
        ];
    }
}
