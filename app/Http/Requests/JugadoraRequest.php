<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JugadoraRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'posició' => 'required|in:defensa,migcampista,davantera,porter',
            'equip_id' => 'required|exists:equips,id',
            'data_naixement' => 'required|date|before:today|before:-16 years',
            'foto' => 'nullable|image|mimes:png|max:2048',
        ];
    }
}
