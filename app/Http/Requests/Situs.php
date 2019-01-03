<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Situs extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Otorisasi penggunaan FormRequest dibolehkan untuk siapapun
        return true;
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
            'deskripsi' => 'nullable|string|max:255',
            'isi'       => 'nullable|string',
            'foto'      => 'sometimes|image|max:2048',
        ];
    }
}
