<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Foto extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Otorisasi penggunaan FormRequest
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'      => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255',
            'foto'      => 'required|image|max:2048',
        ];
    }
}